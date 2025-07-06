<?php

namespace Botble\CarRentals\Enums;

use Botble\Base\Supports\Enum;

/**
 * @method static ServicePriceTypeEnum ONCE()
 * @method static ServicePriceTypeEnum PER_DAY()
 */

class ServicePriceTypeEnum extends Enum
{
    public const ONCE = 'once';

    public const PER_DAY = 'per_day';

    public static $langPath = 'plugins/car-rentals::service.form.price_types';
}
