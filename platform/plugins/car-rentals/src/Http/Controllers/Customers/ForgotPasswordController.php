<?php

namespace Botble\CarRentals\Http\Controllers\Customers;

use Botble\ACL\Traits\SendsPasswordResetEmails;
use Botble\Base\Http\Controllers\BaseController;
use Botble\CarRentals\Forms\Fronts\Auth\ForgotPasswordForm;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Theme\Facades\Theme;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends BaseController
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('customer.guest');
    }

    public function showLinkRequestForm()
    {
        SeoHelper::setTitle(__('Forgot Password'));

        Theme::breadcrumb()
            ->add(__('Login'), route('customer.password.reset'));

        return Theme::scope(
            'car-rentals.customers.passwords.email',
            ['form' => ForgotPasswordForm::create()],
            'plugins/car-rentals::themes.customers.passwords.email'
        )->render();
    }

    public function broker(): PasswordBroker
    {
        return Password::broker('customers');
    }
}
