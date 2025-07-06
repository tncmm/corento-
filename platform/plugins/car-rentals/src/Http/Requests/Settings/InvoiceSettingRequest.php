<?php

namespace Botble\CarRentals\Http\Requests\Settings;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Rules\EmailRule;
use Botble\Base\Rules\OnOffRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class InvoiceSettingRequest extends Request
{
    public function rules(): array
    {
        $googleFonts = config('core.base.general.google_fonts', []);

        $customGoogleFonts = config('core.base.general.custom_google_fonts');

        if ($customGoogleFonts) {
            $googleFonts = array_merge($googleFonts, explode(',', $customGoogleFonts));
        }

        return [
            'company_name_for_invoicing' => ['nullable', 'string', 'max:255'],
            'company_address_for_invoicing' => ['nullable', 'string', 'max:255'],
            'company_email_for_invoicing' => ['nullable', 'max:60', 'min:6', new EmailRule()],
            'company_phone_for_invoicing' => 'nullable|' . BaseHelper::getPhoneValidationRule(),
            'company_logo_for_invoicing' => ['nullable', 'string', 'max:255'],
            'using_custom_font_for_invoice' => [new OnOffRule()],
            'invoice_support_arabic_language' => [new OnOffRule()],
            'invoice_code_prefix' => ['nullable', 'string', 'max:255'],
            'invoice_font_family' => ['nullable', 'required_if:using_custom_font_for_invoice,1', 'string', Rule::in($googleFonts)],
            'enable_invoice_stamp' => [new OnOffRule()],
            'invoice_language_support' => ['required', 'string', Rule::in(['default', 'arabic', 'bangladesh', 'chinese'])],
            'invoice_processing_library' => ['required', 'string', Rule::in(['dompdf', 'mpdf'])],
            'invoice_date_format' => ['required', 'string', 'max:255'],
        ];
    }
}
