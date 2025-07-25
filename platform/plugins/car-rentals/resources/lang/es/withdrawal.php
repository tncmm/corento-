<?php

return [
    'name' => 'Retiros',
    'edit' => 'Editar retiro',
    'statuses' => [
        'pending' => 'Pendiente',
        'processing' => 'Procesando',
        'completed' => 'Completado',
        'canceled' => 'Cancelado',
        'refused' => 'Rechazado',
    ],
    'amount' => 'Monto',
    'fee' => 'Comisión',
    'payment_channel' => 'Canal de Pago',
    'transaction_id' => 'ID de Transacción',
    'images' => 'Imágenes',
    'refund_amount' => 'Monto de reembolso',
    'invoice' => [
        'invoice_template_label' => 'Factura de Pago',
        'variables' => [
            'company_logo' => 'Logo de la empresa',
            'company_name' => 'Nombre de la empresa',
            'company_address' => 'Dirección de la empresa',
            'company_state' => 'Estado de la empresa',
            'company_city' => 'Ciudad de la empresa',
            'company_zipcode' => 'Código postal de la empresa',
            'company_phone' => 'Teléfono de la empresa',
            'company_email' => 'Email de la empresa',
            'company_tax_id' => 'ID fiscal de la empresa',
            'withdrawal_id' => 'ID de retiro',
            'withdrawal_created_at' => 'Fecha de creación del retiro',
            'withdrawal_customer_name' => 'Nombre del vendedor',
            'withdrawal_payment_channel' => 'Canal de pago',
            'withdrawal_amount' => 'Monto',
            'withdrawal_fee' => 'Comisión',
            'withdrawal_status' => 'Estado',
            'withdrawal_description' => 'Descripción',
            'withdrawal_bank_info_name' => 'Nombre del banco',
            'withdrawal_bank_info_number' => 'Número de cuenta bancaria',
            'withdrawal_bank_info_full_name' => 'Nombre de la cuenta bancaria',
        ],
    ],
    'forms' => [
        'amount' => 'Monto',
        'amount_with_balance' => 'Monto (Saldo disponible: :balance)',
        'amount_placeholder' => 'Monto que desea retirar',
        'fee' => 'Comisión',
        'fee_helper' => 'Debe pagar una comisión al retirar: :fee',
        'minimum_withdrawal_amount' => 'Monto mínimo de retiro: :amount',
        'you_will_get' => 'Recibirá: :amount',
        'your_bank_info' => 'Su información bancaria',
        'pending_status_helper' => 'Para confirmar su solicitud de retiro, podemos contactarlo por correo electrónico o número de teléfono.',
        'processing_status_helper' => 'Su solicitud de retiro está siendo procesada.',
        'completed_status_helper' => 'Su solicitud de retiro ha sido completada.',
        'canceled_status_helper' => 'Su solicitud de retiro ha sido cancelada.',
        'refused_status_helper' => 'Su solicitud de retiro ha sido rechazada.',
        'information' => 'Información',
        'current_balance' => 'Saldo actual',
        'payment_channel' => 'Canal de Pago',
        'payment_channel_placeholder' => 'Canal de Pago',
        'total_amount' => 'Monto total (Comisión incluida)',
        'bank_info' => 'Información bancaria',
        'bank_name' => 'Nombre del banco',
        'bank_code' => 'Código del banco/IFSC',
        'bank_account_name' => 'Nombre del titular de la cuenta',
        'bank_account_number' => 'Número de cuenta',
        'paypal_id' => 'ID de PayPal',
        'upi_id' => 'ID de UPI',
        'description' => 'Descripción',
        'description_placeholder' => 'Nota para la solicitud',
        'cancel_withdrawal_request' => 'Cancelar solicitud de retiro',
        'withdraw_now' => 'Retirar ahora',
        'amount_min' => 'El monto mínimo de retiro es :min',
    ],
    'vendor_info' => 'Información del vendedor',
    'vendor_name' => 'Nombre del vendedor',
    'vendor_email' => 'Email del vendedor',
    'vendor_phone' => 'Teléfono del vendedor',
    'withdrawal_info' => 'Información del retiro',
    'withdrawal_amount' => 'Monto del retiro',
    'current_balance' => 'Saldo actual',
    'status' => 'Estado',
    'date' => 'Fecha',
    'update_status' => 'Actualizar estado',
    'mark_as_completed' => 'Marcar como completado',
    'total_amount' => 'Monto total (Comisión incluida)',
    'view_vendor' => 'Ver vendedor ":vendor"',
    'payment_info' => 'Información de pago',
    'payout_info' => 'Información de pago',
    'bank_name' => 'Nombre del banco',
    'bank_code' => 'Código del banco',
    'account_number' => 'Número de cuenta',
    'account_holder' => 'Titular de la cuenta',
    'paypal_id' => 'ID de PayPal',
    'upi_id' => 'ID de UPI',
    'withdrawal_method' => 'Método de retiro',
    'balance' => 'Saldo',
    'withdrawal_approval_notification' => 'El vendedor :vendor ha solicitado un retiro de :balance. Por favor revise y apruebe.',
    'customer_name' => 'Nombre del cliente',
];
