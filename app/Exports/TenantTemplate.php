<?php

namespace App\Exports;

use App\Models\Tenant;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TenantTemplate implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Tenant::with(['country_master' ])
            ->get()
            ->map(function ($tenant) {
                return [
                    'Tenant Type'         => $tenant->type,
                    'Tenant Name'         => $tenant->name,
                    'Gender'              => $tenant->gender,
                    'Company Name'        => $tenant->company_name,
                    'Country Name'        => $tenant->country_master?->country?->name ?? '',
                    'Live With'           => $tenant->liveWith->name ?? '',
                    'Business Activity'   => $tenant->businessActivity->name ?? '',
                    'Tax Registration'    => $tenant->tax_registration,
                    'VAT No'              => $tenant->vat_no,
                    'ID Number'           => $tenant->id_number,
                    'Registration No'     => $tenant->registration_no,
                    'Nick Name'           => $tenant->nick_name,
                    'Group Company Name'  => $tenant->group_company_name,
                    'Contact Person'      => $tenant->contact_person,
                    'Designation'         => $tenant->designation,
                    'Contact No'          => $tenant->contact_no,
                    'Whatsapp No'         => $tenant->whatsapp_no,
                    'Fax No'              => $tenant->fax_no,
                    'Telephone No'        => $tenant->telephone_no,
                    'Other Contact No'    => $tenant->other_contact_no,
                    'Address 1'           => $tenant->address1,
                    'Address 2'           => $tenant->address2,
                    'Address 3'           => $tenant->address3,
                    'State'               => $tenant->state,
                    'City'                => $tenant->city,
                    'Nationality'         => $tenant->country_master->nationality_of_owner ?? '',
                    'Passport No'         => $tenant->passport_no,
                    'Email 1'             => $tenant->email1,
                    'Email 2'             => $tenant->email2,
                ];
            });
    }

    public function headings(): array
    {
        return [
            "Tenant Type",
            "Tenant Name",
            "Gender",
            "Company Name",
            "Country Name",
            "Live With",
            "Business Activity",
            "Tax Registration",
            "VAT No",
            "ID Number",
            "Registration No",
            "Nick Name",
            "Group Company Name",
            "Contact Person",
            "Designation",
            "Contact No",
            "Whatsapp No",
            "Fax No",
            "Telephone No",
            "Other Contact No",
            "address 1",
            "address 2",
            "address 3",
            "state",
            "city",
            "Nationality",
            "Passport No",
            "email 1",
            "email 2",
        ];
    }
}
