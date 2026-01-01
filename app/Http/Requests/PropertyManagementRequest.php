<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyManagementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name"                                  => "required",
            "code"                                  => "required",
            "ownership_id"                          => "required",
            // "property_type_id"                      => "required",
            "building_no"                           => "required",
            // "road"                                  => "required",
            // "location"                              => "required",
            // "city"                                  => "required",
            "country_master_id"                     => "required",
            // "established_on"                        => "required",
            // "registration_on"                       => "required",
            // "tax_no"                                => "required",
            // "municipality_no"                       => "required",
            // "electricity_no"                        => "required",
            // "land_lord_name"                        => "required",
            // "bank_name"                             => "required",
            // "bank_no"                               => "required",
            // "contact_person"                        => "required",
            // "dail_code_telephone"                   => "required",
            // "telephone"                             => "required",
            // "dail_code_mobile"                      => "required",
            // "mobile"                                => "required",
            // "email"                                 => "required",
            // "dail_code_fax"                         => "required",
            // "fax"                                   => "required",
            // "total_area"                            => "required",
            // "insurance_provider"                    => "required",
            // "insurance_period_from"                 => "required",
            // "insurance_period_to"                   => "required",
            // "insurance_type"                        => "required",
            // "insurance_policy_no"                   => "required",
            // "insurance_holder"                      => "required",
            // "premium_amount"                        => "required",
            // "status"                                => "required",
        ];
    }
    public function messages(): array
    {
        return [
            "name.required"                                  => __('general.required'),
            "code.required"                                  => __('general.required'),
            "ownership_id.required"                          => __('general.required'),
            "property_type_id.required"                      => __('general.required'),
            "building_no.required"                           => __('general.required'),
            "road.required"                                  => __('general.required'),
            "location.required"                              => __('general.required'),
            "city.required"                                  => __('general.required'),
            "country_master_id.required"                     => __('general.required'),
            "established_on.required"                        => __('general.required'),
            "registration_on.required"                       => __('general.required'),
            "tax_no.required"                                => __('general.required'),
            "municipality_no.required"                       => __('general.required'),
            "electricity_no.required"                        => __('general.required'),
            "land_lord_name.required"                        => __('general.required'),
            "bank_name.required"                             => __('general.required'),
            "bank_no.required"                               => __('general.required'),
            "contact_person.required"                        => __('general.required'),
            "dail_code_telephone.required"                   => __('general.required'),
            "telephone.required"                             => __('general.required'),
            "dail_code_mobile.required"                      => __('general.required'),
            "mobile.required"                                => __('general.required'),
            "email.required"                                 => __('general.required'),
            "dail_code_fax.required"                         => __('general.required'),
            "fax_no.required"                                => __('general.required'),
            "total_area.required"                            => __('general.required'),
            "insurance_provider.required"                    => __('general.required'),
            "insurance_period_from.required"                 => __('general.required'),
            "insurance_period_to.required"                   => __('general.required'),
            "insurance_type.required"                        => __('general.required'),
            "insurance_policy_no.required"                   => __('general.required'),
            "insurance_holder.required"                      => __('general.required'),
            "premium_amount.required"                        => __('general.required'),
            "status.required"                                => __('general.required'),
        ];
    }
}
