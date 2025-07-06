<?php

namespace Botble\CarRentals\Widgets;

use Botble\Base\Widgets\Card;
use Botble\CarRentals\Enums\BookingStatusEnum;
use Botble\CarRentals\Models\Booking;
use Botble\Payment\Enums\PaymentStatusEnum;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class RevenueCard extends Card
{
    public function getOptions(): array
    {
        $data = Booking::query()
            ->whereDate('created_at', '>=', $this->startDate)
            ->whereDate('created_at', '<=', $this->endDate)
            ->select([
                DB::raw('SUM(COALESCE(amount, 0)) as revenue'),
            ])
            ->selectRaw('count(id) as total, date_format(created_at, "' . $this->dateFormat . '") as period')
            ->groupBy('period')
            ->pluck('revenue')
            ->all();

        return [
            'series' => [
                [
                    'data' => $data,
                ],
            ],
        ];
    }

    public function getViewData(): array
    {
        if (is_plugin_active('payment')) {
            $revenue = Booking::query()
                ->select([
                    DB::raw('SUM(COALESCE(payments.amount, 0) - COALESCE(payments.refunded_amount, 0)) as revenue'),
                    'payments.status',
                ])
                ->join('payments', 'payments.id', '=', 'cr_bookings.payment_id')
                ->whereIn('payments.status', [PaymentStatusEnum::COMPLETED])
                ->whereDate('payments.created_at', '>=', $this->startDate)
                ->whereDate('payments.created_at', '<=', $this->endDate)
                ->groupBy('payments.status')
                ->first();
        } else {
            $revenue = Booking::query()
                ->select([
                    DB::raw('SUM(COALESCE(amount, 0)) as revenue'),
                    'status',
                ])
                ->where('status', BookingStatusEnum::COMPLETED)
                ->whereDate('created_at', '>=', $this->startDate)
                ->whereDate('created_at', '<=', $this->endDate)
                ->groupBy('status')
                ->first();
        }

        $startDate = clone $this->startDate;
        $endDate = clone $this->endDate;

        $currentPeriod = CarbonPeriod::create($startDate, $endDate);
        $previousPeriod = CarbonPeriod::create($startDate->subDays($currentPeriod->count()), $endDate->subDays($currentPeriod->count()));

        $currentRevenue = Booking::query()
            ->where('status', BookingStatusEnum::COMPLETED)
            ->whereDate('created_at', '>=', $currentPeriod->getStartDate())
            ->whereDate('created_at', '<=', $currentPeriod->getEndDate())
            ->select([
                DB::raw('SUM(COALESCE(amount, 0)) as revenue'),
            ])
            ->pluck('revenue')
            ->first();

        $previousRevenue = Booking::query()
            ->where('status', BookingStatusEnum::COMPLETED)
            ->whereDate('created_at', '>=', $previousPeriod->getStartDate())
            ->whereDate('created_at', '<=', $previousPeriod->getEndDate())
            ->select([
                DB::raw('SUM(COALESCE(amount, 0)) as revenue'),
            ])
            ->pluck('revenue')
            ->first();

        $result = $currentRevenue - $previousRevenue;

        $result > 0 ? $this->chartColor = '#4ade80' : $this->chartColor = '#ff5b5b';

        return array_merge(parent::getViewData(), [
            'content' => view(
                'plugins/car-rentals::reports.widgets.revenue-card',
                compact('revenue', 'result')
            )->render(),
        ]);
    }
}
