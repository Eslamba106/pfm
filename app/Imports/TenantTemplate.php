<?php
namespace App\Imports;

use App\Models\Tenant;
use App\Models\LiveWith;
use App\Models\CountryMaster;
use App\Models\BusinessActivity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TenantTemplate implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            // Log::info($row);
            Tenant::updateOrCreate(
                [
                    'name'         => $row['tenant_name'] ?? null,
                    'company_name' => $row['company_name'] ?? null,
                ],
                [
                    'type'                 => $row['tenant_type'] ?? 'individual',
                    'gender'               => $row['gender'] ?? null,
                    'country_id'           => $this->getCountryId($row['country_name']),
                    'live_with_id'         => $this->getLiveWithId($row['live_with'] ?? null),
                    'business_activity_id' => $this->getBusinessActivityId($row['business_activity'] ?? null),
                    'id_number'            => $row['id_number'] ?? null,
                    'registration_no'      => $row['registration_no'] ?? null,
                    'nick_name'            => $row['nick_name'] ?? null,
                    'group_company_name'   => $row['group_company_name'] ?? null,
                    'contact_person'       => $row['contact_person'] ?? null,
                    'designation'          => $row['designation'] ?? null,
                    'contact_no'           => $row['contact_no'] ?? null,
                    'whatsapp_no'          => $row['whatsapp_no'] ?? null,
                    'fax_no'               => $row['fax_no'] ?? null,
                    'telephone_no'         => $row['telephone_no'] ?? null,
                    'other_contact_no'     => $row['other_contact_no'] ?? null,
                    'address1'             => $row['address_1'] ?? null,
                    'address2'             => $row['address_2'] ?? null,
                    'address3'             => $row['address_3'] ?? null,
                    'state'                => $row['state'] ?? null,
                    'city'                 => $row['city'] ?? null,
                    'nationality_id'       => $this->getNationalityId($row['nationality'] ?? null),
                    'passport_no'          => $row['passport_no'] ?? null,
                    'email1'               => $row['email_1'] ?? null,
                    'email2'               => $row['email_2'] ?? null,
                    'document'             => null,
                ]
            );
        }
    }

private function getCountryId($name)
{
    if (!$name) {
        return null;
    }

    $country = CountryMaster::whereHas('country', function ($c) use ($name) {
        $c->where('name', 'like', "%{$name}%");
    })->first();

    return $country?->id; // PHP 8+ safe navigation operator
}

    private function getLiveWithId($name)
    {
        return $name ? LiveWith::firstOrCreate(['name' => $name])->id : null;
    }

    private function getBusinessActivityId($name)
    {
        return $name ? BusinessActivity::firstOrCreate(['name' => $name])->id : null;
    }

    private function getNationalityId($name)
    {
        if (!$name) {
        return null;
    }

    $country = CountryMaster::whereHas('country', function ($c) use ($name) {
        $c->where('name', 'like', "%{$name}%");
    })->first();

    return $country?->id;
    }
}
