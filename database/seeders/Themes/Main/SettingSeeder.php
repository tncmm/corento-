<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Models\Category;
use Botble\Blog\Models\Post;
use Botble\Slug\Facades\SlugHelper;
use Botble\Slug\Models\Slug;

class SettingSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('general');

        $settings = [
            'admin_logo' => 'general/logo-dark.png',
            'admin_favicon' => 'general/favicon.png',
            SlugHelper::getPermalinkSettingKey(Post::class) => 'news',
            SlugHelper::getPermalinkSettingKey(Category::class) => 'news',

            'payment_cod_status' => 1,
            'payment_cod_description' => 'Please pay money directly to the postman, if you choose cash on delivery method (COD).',
            'payment_bank_transfer_status' => 1,
            'payment_bank_transfer_description' => 'Please send money to our bank account: ACB - 69270 213 19.',
            'payment_stripe_payment_type' => 'stripe_checkout',
            'language_switcher_display' => 'dropdown',
            'car_rentals_company_name_for_invoicing' => 'Carento',
            'car_rentals_company_logo_for_invoicing' => 'general/logo.png',
            'car_rentals_company_address_for_invoicing' => '123, My Street, Kingston, New York',
            'car_rentals_company_email_for_invoicing' => 'contact@botble.com',
            'car_rentals_company_phone_for_invoicing' => '123456789',
            'car_rentals_enabled_review' => true,
            'car_rentals_enabled_multi_vendor' => 1,
        ];

        $this->saveSettings($settings);

        Slug::query()->where('reference_type', Post::class)->update(['prefix' => 'news']);
        Slug::query()->where('reference_type', Category::class)->update(['prefix' => 'news']);
    }
}
