<?php

declare(strict_types=1);

namespace Upmind\ProvisionProviders\Seo\Data;

use Upmind\ProvisionBase\Provider\DataSet\DataSet;
use Upmind\ProvisionBase\Provider\DataSet\Rules;

/**
 * @property-read mixed $customer_id Id of the customer in the billing system
 * @property-read string $customer_email Email address of the customer
 * @property-read string|null $customer_name Name of the customer
 * @property-read string $domain Domain name the account is for
 * @property-read string $package_identifier Service package identifier, if any
 * @property-read string[]|null $promo_codes Optional array of promo codes applied to the order
 * @property-read mixed[]|null $extra Any extra data to pass to the service endpoint
 */
class CreateParams extends DataSet
{
    public static function rules(): Rules
    {
        return new Rules([
            'customer_id' => ['required'],
            'customer_email' => ['required', 'email'],
            'customer_name' => ['nullable', 'string'],
            'domain' => ['required', 'string', 'alpha-dash-dot'],
            'package_identifier' => ['required', 'string'],
            'promo_codes' => ['nullable', 'array'],
            'promo_codes.*' => ['string'],
            'extra' => ['nullable', 'array'],
        ]);
    }
}
