<?php

namespace Botble\CarRentals\Http\Controllers\Vendor;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Botble\CarRentals\Enums\BookingStatusEnum;
use Botble\CarRentals\Forms\Vendor\BookingForm;
use Botble\CarRentals\Http\Requests\UpdateBookingCompletionRequest;
use Botble\CarRentals\Http\Requests\UpdateBookingRequest;
use Botble\CarRentals\Models\Booking;
use Botble\CarRentals\Tables\Vendor\BookingTable;
use Botble\Media\Facades\RvMedia;

class BookingController extends BaseController
{
    public function index(BookingTable $table)
    {
        $this->pageTitle(trans('plugins/car-rentals::booking.name'));

        return $table->renderTable();
    }

    public function edit(Booking $booking)
    {
        if ($booking->vendor_id != auth('customer')->id()) {
            abort(403);
        }

        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $booking->car->car_name]));

        return BookingForm::createFromModel($booking)->renderForm();
    }

    public function update(Booking $booking, UpdateBookingRequest $request)
    {
        if ($booking->vendor_id != auth('customer')->id()) {
            abort(403);
        }

        BookingForm::createFromModel($booking)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('car-rentals.bookings.index'))
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Booking $booking): DeleteResourceAction
    {
        if ($booking->vendor_id != auth('customer')->id()) {
            abort(403);
        }

        return DeleteResourceAction::make($booking);
    }

    public function updateCompletion(Booking $booking, UpdateBookingCompletionRequest $request)
    {
        if ($booking->vendor_id != auth('customer')->id()) {
            abort(403);
        }

        $data = $request->validated();

        // Handle damage images upload
        if ($request->hasFile('completion_damage_images')) {
            $uploadedImages = [];
            foreach ($request->file('completion_damage_images') as $file) {
                $result = RvMedia::handleUpload($file, 0, 'car-rentals/completion-images');
                if ($result['error'] === false) {
                    $uploadedImages[] = $result['data']->url;
                }
            }

            // Merge with existing images if any
            $existingImages = $request->input('existing_damage_images', []);
            $data['completion_damage_images'] = array_merge($existingImages, $uploadedImages);
        } else {
            // Keep only existing images
            $data['completion_damage_images'] = $request->input('existing_damage_images', []);
        }

        // Set completion timestamp if not already set
        if (! $booking->completed_at && $booking->status == BookingStatusEnum::COMPLETED) {
            $data['completed_at'] = now();
        }

        $booking->update($data);

        return $this
            ->httpResponse()
            ->setMessage(trans('plugins/car-rentals::booking.completion_details_updated_successfully'));
    }
}
