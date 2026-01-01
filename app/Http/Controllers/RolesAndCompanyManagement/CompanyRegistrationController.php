<?php
namespace App\Http\Controllers\RolesAndCompanyManagement;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Schema;
use App\Models\Company;
use App\Mail\SendInvoice;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Mail\SendCompanyInfo;
use App\Models\CountryMaster;
use App\Events\CompanyCreated;
use App\Models\ScheduleCompany;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CompanyRegistrationController extends Controller
{

    public function index(Request $request)
    {
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $companies = Company::where('code', 'request')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })->select('id', 'company_id', 'created_at', 'name', 'countryName', 'code', 'request_status')
            ->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $companies = Company::where('code', 'request')->orderBy('created_at', 'asc')->select('id', 'company_id', 'created_at', 'name', 'countryName', 'code', 'request_status')
                ->paginate(10);
        }
        $users = (new User())->setConnection('mysql')->select('company_id', 'user_name')->get();
        $data  = [
            'companies' => $companies,
            'search'    => $search,
            'users'     => $users,
        ];
        return view("super_admin.companies.all_companies", $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'            => 'required|string|max:255',
            'phone_dial_code' => 'nullable|string|max:5',
            'phone'           => 'nullable|string|max:15',
            'username'        => 'required|string|max:50',
            'password'        => 'nullable|string|min:5',
            'country'         => 'required|integer',
        ]);

        DB::beginTransaction();
        try {
            $company_id   = company_id();
            $country_main = CountryMaster::find($request->country);
            $company      = (new Company())->setConnection('mysql')->create([
                'name'            => $request->name ?? 0,
                'company_id'      => $company_id ?? 0,
                'domain'          => $company_id . '.' . $request->getHost(),
                'user_count'      => $request->user_count ?? 10,
                'branches_count'  => 1,
                'building_count'  => $request->building_count ?? 3,
                'units_count'     => $request->units_count ?? 10,
                'creation_date'   => now(),
                'countryid'       => $request->country,
                'status'          => 'inactive',
                'phone'           => $request->phone ?? null,
                'phone_dail_code' => $request->phone_dial_code ?? null,
                'countryName'     => $country_main->country?->name ?? null,
                'countryCode'     => $country_main->country_code ?? null,
                'region'          => $country_main->region_id ?? null,
                'decimals'        => $country_main->no_of_decimals ?? null,
                'currency'        => $country_main->currency_name ?? null,
                'symbol'          => $country_main->currency_symbol ?? null,
                'currency_code'   => $country_main->international_currency_code ?? null,
                'denomination'    => $country_main->denomination_name ?? null,
                'email'           => $request->email1 ?? null,
                'code'            => 'request',
                'request_status'  => 'pending',
                'schema_id'       => $request->schema_id ?? null,
            ]);
            (new User())->setConnection('mysql')->create([
                'name'            => $request->name ?? null,
                'user_name'       => $request->username ?? null,
                'password'        => Hash::make($request->password),
                'my_name'         => $request->password,
                'role_name'       => 'admin',
                'role_id'         => 2,
                'company_id'      => $company->id,
                'branch_id'       => 1,
                'phone'           => $request->phone ?? null,
                'phone_dail_code' => $request->phone_dial_code ?? null,
                'email'           => $request->email1 ?? null,
            ]);

            Mail::to($request->email1)->send(new WelcomeMail([
                'name'  =>$request->name
            ]));

            // Mail::to($request->email1)->send(new SendInvoice([
            //     'users_count' => $request->user_count,
            //     'users_cost' => $request->monthly_subscription_user,
            //     'buildings_count' => $request->building_count,
            //     'buildings_cost' => $request->monthly_subscription_building,
            //     'units_count' => $request->units_count,
            //     'units_cost' => $request->monthly_subscription_units,
            //     'branches_count' => $request->branches_count,
            //     'branches_cost' => $request->monthly_subscription_branches,
            //     'setup_cost' => $request->setup_cost,
            //     'country_master' => $country_main,
            //     'company' => $company,
            // ]));

            DB::commit();
            //event(new CompanyCreated($company));
            return redirect()->route('login-page')->with("success", ui_change('registration_successfully_we_will_connect_with_you'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function confirm($id)
    {
        $company        = (new Company())->setConnection('mysql')->findOrFail($id);
        $user           = (new User())->setConnection('mysql')->where('company_id', $id)->first();
        $country        = CountryMaster::get();
        $dail_code_main = DB::table('dial_code_table')->select('id', 'dial_code')->get();

        $data = [
            'company'        => $company,
            'country'        => $country,
            'dail_code_main' => $dail_code_main,
            'user'           => $user,
        ];
        return view("super_admin.companies.confirm", $data);
    }

    public function ApproveConfirm(Request $request, $id)
    {

        // dd($request->all());
        $validatedData = $request->validate([
            'name'             => 'required|string|max:255',
            'phone_dail_code'  => 'nullable|string|max:5',
            'phone'            => 'nullable|string|max:15',
            'fax_dail_code'    => 'nullable|string|max:5',
            'fax'              => 'nullable|string|max:15',
            'user_name'        => 'required|string|max:50',
            'password'         => 'nullable|string|min:5',
            'address1'         => 'nullable|string|max:255',
            'address2'         => 'nullable|string|max:255',
            'address3'         => 'nullable|string|max:255',
            'countryid'        => 'required|integer|exists:countries,id',
            'email'            => 'nullable|email|max:255',
            'state'            => 'nullable|string|max:255',
            'city'             => 'nullable|string|max:255',
            'location'         => 'nullable|string|max:255',
            'mobile_dail_code' => 'nullable|string|max:5',
            'mobile'           => 'nullable|string|max:15',
            'vat_no'           => 'nullable|string|max:50',
            'group_vat_no'     => 'nullable|string|max:50',
            'tax_reg_date'     => 'nullable|date',
            // 'tax_type' => 'in:exempted,taxable,zero_rated,non_taxable',
        ]);
        // dd($request->all());
        DB::beginTransaction();
        try {
            $country_main                                        = CountryMaster::find($request->countryid);
            ($request->tax_reg_date != null) ? $tax_reg_date     = Carbon::createFromFormat('d/m/Y', $request->tax_reg_date)->format('Y-m-d') : $tax_reg_date     = null;
            ($request->book_begining != null) ? $book_begining   = Carbon::createFromFormat('d/m/Y', $request->book_begining)->format('Y-m-d') : $book_begining   = null;
            ($request->financial_year != null) ? $financial_year = Carbon::createFromFormat('d/m/Y', $request->financial_year)->format('Y-m-d') : $financial_year = null;
            // dd($book_begining );
            $company = (new Company())->setConnection('mysql')->findOrFail($id);
            $oldData = $company->only([
                'id',
                'user_count',
                'branches_count',
                'building_count',
                'units_count',
                'setup_cost',
                'monthly_subscription_user',
                'monthly_subscription_building',
                'monthly_subscription_units',
                'monthly_subscription_branches',
                'creation_date',
                'company_applicable_date',
            ]);
            $newData = [
                'company_id'                    => $company->id ?? 10,
                'user_count'                    => $request->user_count ?? 10,
                'branches_count'                => $request->branches_count ?? 2,
                'building_count'                => $request->buildings_count ?? 3,
                'units_count'                   => $request->units_count ?? 10,
                'setup_cost'                    => $request->setup_cost ?? 0,
                'monthly_subscription_user'     => $request->monthly_subscription_user ?? 0,
                'monthly_subscription_building' => $request->monthly_subscription_building ?? 0,
                'monthly_subscription_units'    => $request->monthly_subscription_units ?? 0,
                'monthly_subscription_branches' => $request->monthly_subscription_branches ?? 0,
                'creation_date'                 => $request->creation_date ?? 0,
                'company_applicable_date'       => $request->company_applicable_date ?? 0,
            ];

            $company->update([
                'name'                          => $request->name ?? 0,
                'company_id'                    => $request->company_id ?? 0,
                'domain'                        => $request->company_id . '.' . $request->getHost(),
                'user_count'                    => $request->user_count ?? 10,
                'branches_count'                => $request->branches_count ?? 2,
                'building_count'                => $request->buildings_count ?? 3,
                'units_count'                   => $request->units_count ?? 10,
                'setup_cost'                    => $request->setup_cost ?? 0,
                'monthly_subscription_user'     => $request->monthly_subscription_user ?? 0,
                'monthly_subscription_building' => $request->monthly_subscription_building ?? 0,
                'monthly_subscription_units'    => $request->monthly_subscription_units ?? 0,
                'monthly_subscription_branches' => $request->monthly_subscription_branches ?? 0,
                'creation_date'                 => $request->creation_date ?? 0,
                'company_applicable_date'       => $request->company_applicable_date ?? 0,
                'domain_code'                   => $request->domain_code ?? 0,
                'countryid'                     => $request->countryid,
                'common'                        => $request->common ?? 0,
                'status'                        => $request->status ?? 'active',
                'book_begining'                 => $book_begining ?? null,
                'financial_year'                => $financial_year ?? null,
                'phone'                         => $request->phone ?? null,
                'phone_dail_code'               => $request->phone_dail_code ?? null,
                'fax'                           => $request->fax ?? null,
                'fax_dail_code'                 => $request->fax_dail_code ?? null,
                'location'                      => $request->location ?? null,
                'pin'                           => $request->pin ?? null,
                'code'                          => $request->code ?? null,
                'state'                         => $request->state ?? null,
                'vat_tin_no'                    => $request->vat_tin_no ?? null,
                'tax_type'                      => (int) $request->tax_type ?? 0,
                'tax_rate'                      => $request->tax_rate ?? null,
                'group_vat_no'                  => $request->group_vat_no ?? null,
                'vat_no'                        => $request->vat_no ?? null,
                'countryName'                   => $country_main->country->name ?? null,
                'countryCode'                   => $request->countryCode ?? null,
                'region'                        => $request->region ?? null,
                'decimals'                      => $request->decimals ?? null,
                'currency'                      => $request->currency ?? null,
                'symbol'                        => $request->symbol ?? null,
                'currency_code'                 => $request->international_currency_code ?? null,
                'denomination'                  => $request->denomination ?? null,
                'address1'                      => $request->address1 ?? null,
                'address2'                      => $request->address2 ?? null,
                'address3'                      => $request->address3 ?? null,
                'mobile_dail_code'              => $request->mobile_dail_code ?? null,
                'mobile'                        => $request->mobile ?? null,
                'city'                          => $request->city ?? null,
                'email'                         => $request->email ?? null,
                'opening_time'                  => $request->opening_time ?? null,
                'closing_time'                  => $request->closing_time ?? null,
                'reg_tax_status'                => $request->reg_tax_status ?? 0,
                'tax_reg_date'                  => $tax_reg_date ?? null,
                'signature'                     => $request->signature,
                'request_status'                => 'waiting_for_payment',

            ]);
            (new User())->setConnection('mysql')->where('company_id', $company->id)->first()->update([
                'user_name'       => $request->user_name ?? null,
                'password'        => Hash::make($request->password),
                'my_name'         => $request->password,
                'phone'           => $request->phone ?? null,
                'phone_dail_code' => $request->phone_dail_code ?? null,
                'email'           => $request->email ?? null,

            ]);

            $schedule_company = (new ScheduleCompany())->setConnection('mysql')->create([
                'company_id'                    => $company->id,
                'user_count'                    => $request->user_count ?? 10,
                'branches_count'                => $request->branches_count ?? 2,
                'building_count'                => $request->buildings_count ?? 3,
                'units_count'                   => $request->units_count ?? 10,
                'setup_cost'                    => $request->setup_cost ?? 0,
                'monthly_subscription_user'     => $request->monthly_subscription_user ?? 0,
                'monthly_subscription_building' => $request->monthly_subscription_building ?? 0,
                'monthly_subscription_units'    => $request->monthly_subscription_units ?? 0,
                'monthly_subscription_branches' => $request->monthly_subscription_branches ?? 0,
                'creation_date'                 => $request->creation_date ?? 0,
                'company_applicable_date'       => $request->company_applicable_date ?? 0,
            ]);
            $company->update([
                'domain_code' => $schedule_company->id,
            ]);
            Mail::to($request->email)->send(new SendCompanyInfo([
                'user name'  => $request->user_name,
                'password'   => $request->password,
                'domain'     => $request->getHost(),
                'company_id' => $request->company_id,
            ]));

            Mail::to($request->email)->send(new SendInvoice([
                'users_count'     => $request->user_count,
                'users_cost'      => $request->monthly_subscription_user,
                'buildings_count' => $request->buildings_count,
                'buildings_cost'  => $request->monthly_subscription_building,
                'units_count'     => $request->units_count,
                'units_cost'      => $request->monthly_subscription_units,
                'branches_count'  => $request->branches_count,
                'branches_cost'   => $request->monthly_subscription_branches,
                'setup_cost'      => $request->setup_cost,
                'country_master'  => $country_main,
                'company'         => $company,
            ]));

            DB::commit();
            // event(new CompanyCreated($company));
            return redirect()->route('admin.companies')->with("success", __('property_master.confirmed_successfully'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function createCompany()
    {
        $country        = CountryMaster::with('country')->get();
        $dail_code_main = DB::table('dial_code_table')->select('id', 'dial_code')->get();
        $schema         = Schema::where('display', 'active')->where('status', 'active')->get();

        if ($schema->isNotEmpty()) {
            $data = [
                'country'        => $country,
                'dail_code_main' => $dail_code_main,
                'schema'         => $schema,
            ];
            return view('auth.schema', $data);
        }
        $data = [
            'country'        => $country,
            'dail_code_main' => $dail_code_main,
        ];
        return view('auth.register', $data);
    }
    public function createCompanyWithSchema($id)
    {
        $country        = CountryMaster::with('country')->get();
        $dail_code_main = DB::table('dial_code_table')->select('id', 'dial_code')->get();
        $schema         = Schema::where('id', $id)->first();

        $data = [
            'country'        => $country,
            'dail_code_main' => $dail_code_main,
            'schema'         => $schema,
        ];

        return view('auth.register', $data);
    }
}
