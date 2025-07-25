<?php

return [
    'name' => 'Car Rentals',
    'currency' => [
        'title' => 'Currency',
        'description' => 'Manage currency settings for Car Rentals.',
    ],
    'general' => [
        'title' => 'General',
        'description' => 'Manage general settings for Car Rentals.',
        'forms' => [
            'enabled_multi_vendor' => 'Enable multi-vendor',
            'enabled_multi_vendor_helper' => 'When it is enabled, visitor can register as a vendor and submit their cars to your site for sale/rent.',
            'enabled_car_rental_feature' => 'Enable car rental booking',
            'enabled_car_rental_feature_helper' => 'When it is enabled, the car rental booking feature will be available on the website.',
            'enabled_car_rental' => 'Enable car rental',
            'enabled_car_rental_helper' => 'When it is enabled, cars can be listed for rental.',
            'enabled_post_approval' => 'Enable post approval?',
            'enabled_post_approval_helper' => 'When it is enabled, cars which posted by a vendor will need to be approved by an admin before they are published and display on your site.',
            'enabled_car_sale' => 'Enable car sale',
            'enabled_car_sale_helper' => 'When it is enabled, cars can be listed for sale.',
            'booking_number_format' => [
                'title' => 'Booking Number Format (optional)',
                'description' => 'The default booking number starts at a specific number. You can customize the starting and ending numbers for the booking number. For example, the booking number will be displayed as #:format.',
                'start_with' => 'Starting Number',
                'end_with' => 'Ending Number',
            ],
        ],
    ],
    'review' => [
        'title' => 'Review',
        'description' => 'Manage review settings for Car Rentals.',
        'forms' => [
            'enabled_review' => 'Enable review?',
        ],
    ],
    'car_filter' => [
        'title' => 'Car Filter',
        'description' => 'Manage car filter settings for Car Rentals.',
        'forms' => [
            'filter_cars_by' => 'Filter cars by:',
            'locations' => 'Locations',
            'prices' => 'Prices',
            'categories' => 'Categories',
            'colors' => 'Colors',
            'types' => 'Types',
            'transmissions' => 'Transmissions',
            'fuels' => 'Fuels',
            'review_scores' => 'Review scores',
            'addresses' => 'Addresses',
            'vehicle_condition' => 'Vehicle condition',
            'enable_car_filter' => 'Enable car filter?',
        ],
    ],
    'customer' => [
        'title' => 'Customer',
        'description' => 'View and update your customer settings',
        'forms' => [
            'enabled_customer_registration' => 'Enable customer registration?',
            'verify_customer_email' => 'Verify customer’s email',
            'verify_customer_email_helper' => "When it's enabled, a verification link will be sent to customer's email, customers need to click on this link to verify their email before they can log in.",
            'enabled_customer_registration_helper' => 'When enabled, visitors can register as customers on your website to book cars.',
            'show_terms_checkbox' => 'Show terms and policy checkbox',
            'show_terms_checkbox_helper' => 'When it\'s enabled, customers need to agree to the terms and policy before they can register',
            'max_upload_filesize' => 'Max upload filesize (MB)',
            'max_upload_filesize_placeholder' => 'Default: :size',
            'max_upload_filesize_helper' => 'This setting controls the maximum file size (in MB) that vendors can upload for car images.',
            'max_post_images_upload_by_vendor' => 'Max number of images for each car',
            'max_post_images_upload_by_vendor_helper' => 'This setting controls the maximum number of images that vendors can upload for each car.',
            'default_avatar' => 'Default avatar',
            'default_avatar_helper' => 'Default avatar for customer when they do not have an avatar. If you do not select any image, it will be generated using the first character of customer name.',
        ],
    ],
    'invoice' => [
        'title' => 'Invoice',
        'description' => 'Manage invoice settings for Car Rentals.',
        'forms' => [
            'company_name' => 'Company name',
            'company_name_placeholder' => 'Enter your company name',
            'company_name_helper' => 'This will appear on all invoices as the company name.',
            'company_address' => 'Company address',
            'company_address_placeholder' => 'Enter your company address',
            'company_address_helper' => 'Full company address that will be displayed on invoices.',
            'company_email' => 'Company email',
            'company_email_placeholder' => 'company@example.com',
            'company_email_helper' => 'Contact email address for invoice inquiries.',
            'company_phone' => 'Company phone',
            'company_phone_placeholder' => '+1 (555) 123-4567',
            'company_phone_helper' => 'Contact phone number for invoice inquiries.',
            'company_logo' => 'Company logo',
            'company_logo_helper' => 'Logo that will appear on invoices. Recommended size: 200x80px.',
            'using_custom_font_for_invoice' => 'Using custom font for invoice?',
            'using_custom_font_for_invoice_helper' => 'Enable this to use a custom Google Font for invoices.',
            'invoice_font_family' => 'Invoice font family (Only work for Latin language)',
            'invoice_font_family_helper' => 'Select a Google Font to use for invoice text.',
            'enable_invoice_stamp' => 'Enable invoice stamp?',
            'enable_invoice_stamp_helper' => 'Add a stamp/watermark to invoices for authenticity.',
            'invoice_support_arabic_language' => 'Support Arabic language in invoice?',
            'invoice_support_arabic_language_helper' => 'Enable support for Arabic text in invoices.',
            'invoice_code_prefix' => 'Invoice code prefix',
            'invoice_code_prefix_placeholder' => 'INV-',
            'invoice_code_prefix_helper' => 'Prefix that will be added to all invoice numbers (e.g., INV-001).',
            'add_language_support' => 'Add language support',
            'add_language_support_helper' => 'Choose the language support level for invoice generation.',
            'only_latin_languages' => 'Only Latin languages',
            'invoice_processing_library' => 'Invoice processing library',
            'invoice_processing_library_helper' => 'Choose the PDF processing library. DomPDF is faster, mPDF supports more features.',
            'date_format' => 'Date format',
            'date_format_helper' => 'Format for displaying dates on invoices.',
        ],
    ],
    'invoice_template' => [
        'title' => 'Invoice Template',
        'description' => 'Settings for Invoice template',
        'setting_content' => 'Content',
        'forms' => [
            'confirm_reset' => 'Confirm reset invoice template?',
            'confirm_message' => 'Do you really want to reset this invoice template to default?',
            'continue' => 'Continue',
        ],
    ],
    'email' => [
        'templates' => [
            'booking_confirm' => [
                'booking_confirmation_title' => 'Car Rental Booking Confirmation',
                'booking_confirmation_description' => 'Send email to customer when their booking is confirmed',
                'booking_code' => 'Booking code',
                'customer_name' => 'Customer name',
                'customer_phone' => 'Customer phone',
                'customer_email' => 'Customer email',
                'payment_method' => 'Payment method',
                'car_name' => 'Car name',
                'pickup_address' => 'Pickup address',
                'return_address' => 'Return address',
                'rental_start_date' => 'Rental start date',
                'rental_end_date' => 'Rental end date',
                'amount' => 'Amount',
                'note' => 'Note',
            ],
            'booking_notice_title' => 'Send notice to administrator',
            'booking_notice_description' => 'Email template to send notice to administrator when system get new booking',
            'booking_success_title' => 'Send email to guest',
            'booking_success_description' => 'Email template to send email to guest to confirm booking',
            'booking_status_changed_title' => 'Send email to customer when booking status changed',
            'booking_status_changed_description' => 'Email template to send email to customer when booking status changed',
        ],
    ],
    'tax' => [
        'name' => 'Taxes',
        'description' => 'View and update your taxes settings',
        'tax_setting' => 'Tax settings',
        'tax_setting_description' => 'Configure tax settings',
        'tax_management' => 'Taxes management',
        'tax_management_description' => 'View and manage your taxes',
        'forms' => [
            'enable_tax' => 'Enable taxes?',
            'apply_tax' => 'Apply taxes',
        ],
    ],
    'commission' => [
        'title' => 'Commission',
        'description' => 'Configure commission settings for car rentals',
        'default_commission_fee' => 'Default commission fee',
        'commission_fee_type' => 'Commission fee type',
        'enable_commission_fee_for_each_category' => 'Enable commission fee for each category?',
        'commission_fee' => 'Commission fee',
        'categories' => 'Categories',
        'select_categories' => 'Select categories',
        'add_new' => 'Add new',
        'commission_fee_each_category_fee_name' => 'Commission fee for item :key',
        'commission_fee_each_category_name' => 'Categories for item :key',
    ],
];
