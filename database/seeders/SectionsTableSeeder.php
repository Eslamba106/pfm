<?php
namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Dashboards 1 - 2
        Section::updateOrCreate(['id' => 1], ['name' => 'admin_general_dashboard', 'caption' => 'General_Dashboard']);
        Section::updateOrCreate(['id' => 2], ['name' => 'admin_general_dashboard_show', 'section_group_id' => 1, 'caption' => "General_Dashboard_page"]);

        // Roles 3 - 7
        Section::updateOrCreate(['id' => 3], ['name' => 'admin_roles', 'caption' => 'admin_roles']);
        Section::updateOrCreate(['id' => 4], ['name' => 'show_admin_roles', 'section_group_id' => 3, 'caption' => 'show_admin_roles']);
        Section::updateOrCreate(['id' => 5], ['name' => 'create_admin_roles', 'section_group_id' => 3, 'caption' => 'create_admin_roles']);
        Section::updateOrCreate(['id' => 6], ['name' => 'edit_admin_roles', 'section_group_id' => 3, 'caption' => 'edit_admin_roles']);
        Section::updateOrCreate(['id' => 7], ['name' => 'update_admin_roles', 'section_group_id' => 3, 'caption' => 'update_admin_roles']);
        Section::updateOrCreate(['id' => 8], ['name' => 'delete_admin_roles', 'section_group_id' => 3, 'caption' => 'delete_admin_roles']);

        // Company Management 9 - 13
        Section::updateOrCreate(['id' => 9], ['name' => 'company_management', 'caption' => 'company_management']);
        Section::updateOrCreate(['id' => 10], ['name' => 'all_companies', 'section_group_id' => 9, 'caption' => 'all_companies']);
        Section::updateOrCreate(['id' => 11], ['name' => 'create_company', 'section_group_id' => 9, 'caption' => 'create_company']);
        Section::updateOrCreate(['id' => 12], ['name' => 'edit_company', 'section_group_id' => 9, 'caption' => 'edit_company']);
        Section::updateOrCreate(['id' => 13], ['name' => 'delete_company', 'section_group_id' => 9, 'caption' => 'delete_company']);

        // Region 14 - 13
        Section::updateOrCreate(['id' => 14], ['name' => 'regions', 'caption' => 'regions']);
        Section::updateOrCreate(['id' => 15], ['name' => 'all_regions', 'section_group_id' => 14, 'caption' => 'all_regions']);
        Section::updateOrCreate(['id' => 16], ['name' => 'create_region', 'section_group_id' => 14, 'caption' => 'create_region']);
        Section::updateOrCreate(['id' => 17], ['name' => 'edit_region', 'section_group_id' => 14, 'caption' => 'edit_region']);
        Section::updateOrCreate(['id' => 18], ['name' => 'delete_region', 'section_group_id' => 14, 'caption' => 'delete_region']);

        // Countries 19 - 22
        Section::updateOrCreate(['id' => 19], ['name' => 'countries', 'caption' => 'countries']);
        Section::updateOrCreate(['id' => 20], ['name' => 'all_countries', 'section_group_id' => 19, 'caption' => 'all_countries']);
        Section::updateOrCreate(['id' => 21], ['name' => 'create_country', 'section_group_id' => 19, 'caption' => 'create_country']);
        Section::updateOrCreate(['id' => 22], ['name' => 'edit_country', 'section_group_id' => 19, 'caption' => 'edit_country']);
        Section::updateOrCreate(['id' => 23], ['name' => 'delete_country', 'section_group_id' => 19, 'caption' => 'delete_country']);

        // Groups 24 - 28
        Section::updateOrCreate(['id' => 24], ['name' => 'groups', 'caption' => 'groups']);
        Section::updateOrCreate(['id' => 25], ['name' => 'all_groups', 'section_group_id' => 24, 'caption' => 'all_groups']);
        Section::updateOrCreate(['id' => 26], ['name' => 'create_group', 'section_group_id' => 24, 'caption' => 'create_group']);
        Section::updateOrCreate(['id' => 27], ['name' => 'edit_group', 'section_group_id' => 24, 'caption' => 'edit_group']);
        Section::updateOrCreate(['id' => 28], ['name' => 'delete_group', 'section_group_id' => 24, 'caption' => 'delete_group']);

        // Groups 29 - 33
        Section::updateOrCreate(['id' => 29], ['name' => 'ledgers', 'caption' => 'ledgers']);
        Section::updateOrCreate(['id' => 30], ['name' => 'all_ledgers', 'section_group_id' => 29, 'caption' => 'all_ledgers']);
        Section::updateOrCreate(['id' => 31], ['name' => 'create_ledger', 'section_group_id' => 29, 'caption' => 'create_ledger']);
        Section::updateOrCreate(['id' => 32], ['name' => 'edit_ledger', 'section_group_id' => 29, 'caption' => 'edit_ledger']);
        Section::updateOrCreate(['id' => 33], ['name' => 'delete_ledger', 'section_group_id' => 29, 'caption' => 'delete_ledger']);

        // Cost Center Category 34 - 38
        Section::updateOrCreate(['id' => 34], ['name' => 'cost_center_categories', 'caption' => 'cost_center_categories']);
        Section::updateOrCreate(['id' => 35], ['name' => 'all_cost_center_categories', 'section_group_id' => 34, 'caption' => 'all_cost_center_categories']);
        Section::updateOrCreate(['id' => 36], ['name' => 'create_cost_center_category', 'section_group_id' => 34, 'caption' => 'create_cost_center_category']);
        Section::updateOrCreate(['id' => 37], ['name' => 'edit_cost_center_category', 'section_group_id' => 34, 'caption' => 'edit_cost_center_category']);
        Section::updateOrCreate(['id' => 38], ['name' => 'delete_cost_center_category', 'section_group_id' => 34, 'caption' => 'delete_cost_center_category']);

        // Cost Center  39 - 43
        Section::updateOrCreate(['id' => 39], ['name' => 'cost_center', 'caption' => 'cost_center']);
        Section::updateOrCreate(['id' => 40], ['name' => 'all_cost_center', 'section_group_id' => 39, 'caption' => 'all_cost_center']);
        Section::updateOrCreate(['id' => 41], ['name' => 'create_cost_center', 'section_group_id' => 39, 'caption' => 'create_cost_center']);
        Section::updateOrCreate(['id' => 42], ['name' => 'edit_cost_center', 'section_group_id' => 39, 'caption' => 'edit_cost_center']);
        Section::updateOrCreate(['id' => 43], ['name' => 'delete_cost_center', 'section_group_id' => 39, 'caption' => 'delete_cost_center']);

        // Char Of Accounts 44 - 45
        Section::updateOrCreate(['id' => 44], ['name' => 'chart_of_accounts', 'caption' => 'chart_of_accounts']);
        Section::updateOrCreate(['id' => 45], ['name' => 'all_chart_of_accounts', 'section_group_id' => 44, 'caption' => 'all_chart_of_accounts']);

        // Receipt Settings  46 - 43
        Section::updateOrCreate(['id' => 46], ['name' => 'receipt_settings', 'caption' => 'receipt_settings']);
        Section::updateOrCreate(['id' => 47], ['name' => 'all_receipt_settings', 'section_group_id' => 46, 'caption' => 'all_receipt_settings']);
        Section::updateOrCreate(['id' => 48], ['name' => 'create_receipt_settings', 'section_group_id' => 46, 'caption' => 'create_receipt_settings']);
        Section::updateOrCreate(['id' => 49], ['name' => 'edit_receipt_settings', 'section_group_id' => 46, 'caption' => 'edit_receipt_settings']);
        Section::updateOrCreate(['id' => 50], ['name' => 'delete_receipt_settings', 'section_group_id' => 46, 'caption' => 'delete_receipt_settings']);

        // Ownerships  51 - 55
        Section::updateOrCreate(['id' => 51], ['name' => 'ownerships', 'caption' => 'ownerships']);
        Section::updateOrCreate(['id' => 52], ['name' => 'all_ownerships', 'section_group_id' => 51, 'caption' => 'all_ownerships']);
        Section::updateOrCreate(['id' => 53], ['name' => 'create_ownership', 'section_group_id' => 51, 'caption' => 'create_ownership']);
        Section::updateOrCreate(['id' => 54], ['name' => 'edit_ownership', 'section_group_id' => 51, 'caption' => 'edit_ownership']);
        Section::updateOrCreate(['id' => 55], ['name' => 'delete_ownership', 'section_group_id' => 51, 'caption' => 'delete_ownership']);

        // Invoice Settings  56 - 60
        Section::updateOrCreate(['id' => 56], ['name' => 'invoice_settings', 'caption' => 'invoice_settings']);
        Section::updateOrCreate(['id' => 57], ['name' => 'all_invoice_settings', 'section_group_id' => 56, 'caption' => 'all_invoice_settings']);
        Section::updateOrCreate(['id' => 58], ['name' => 'create_invoice_settings', 'section_group_id' => 56, 'caption' => 'create_invoice_settings']);
        Section::updateOrCreate(['id' => 59], ['name' => 'edit_invoice_settings', 'section_group_id' => 56, 'caption' => 'edit_invoice_settings']);
        Section::updateOrCreate(['id' => 60], ['name' => 'delete_invoice_settings', 'section_group_id' => 56, 'caption' => 'delete_invoice_settings']);

        // Property Type  61 - 65
        Section::updateOrCreate(['id' => 61], ['name' => 'property_types', 'caption' => 'property_types']);
        Section::updateOrCreate(['id' => 62], ['name' => 'all_property_types', 'section_group_id' => 61, 'caption' => 'all_property_types']);
        Section::updateOrCreate(['id' => 63], ['name' => 'create_property_type', 'section_group_id' => 61, 'caption' => 'create_property_type']);
        Section::updateOrCreate(['id' => 64], ['name' => 'edit_property_type', 'section_group_id' => 61, 'caption' => 'edit_property_type']);
        Section::updateOrCreate(['id' => 65], ['name' => 'delete_property_type', 'section_group_id' => 61, 'caption' => 'delete_property_type']);

        // Services  66 - 70
        Section::updateOrCreate(['id' => 66], ['name' => 'services', 'caption' => 'services']);
        Section::updateOrCreate(['id' => 67], ['name' => 'all_services', 'section_group_id' => 66, 'caption' => 'all_services']);
        Section::updateOrCreate(['id' => 68], ['name' => 'create_service', 'section_group_id' => 66, 'caption' => 'create_service']);
        Section::updateOrCreate(['id' => 69], ['name' => 'edit_service', 'section_group_id' => 66, 'caption' => 'edit_service']);
        Section::updateOrCreate(['id' => 70], ['name' => 'delete_service', 'section_group_id' => 66, 'caption' => 'delete_service']);

        // Blocks  71 - 75
        Section::updateOrCreate(['id' => 71], ['name' => 'blocks', 'caption' => 'blocks']);
        Section::updateOrCreate(['id' => 72], ['name' => 'all_blocks', 'section_group_id' => 71, 'caption' => 'all_blocks']);
        Section::updateOrCreate(['id' => 73], ['name' => 'create_block', 'section_group_id' => 71, 'caption' => 'create_block']);
        Section::updateOrCreate(['id' => 74], ['name' => 'edit_block', 'section_group_id' => 71, 'caption' => 'edit_block']);
        Section::updateOrCreate(['id' => 75], ['name' => 'delete_block', 'section_group_id' => 71, 'caption' => 'delete_block']);

        // Floors  76 - 80
        Section::updateOrCreate(['id' => 76], ['name' => 'floors', 'caption' => 'floors']);
        Section::updateOrCreate(['id' => 77], ['name' => 'all_floors', 'section_group_id' => 76, 'caption' => 'all_floors']);
        Section::updateOrCreate(['id' => 78], ['name' => 'create_floor', 'section_group_id' => 76, 'caption' => 'create_floor']);
        Section::updateOrCreate(['id' => 79], ['name' => 'edit_floor', 'section_group_id' => 76, 'caption' => 'edit_floor']);
        Section::updateOrCreate(['id' => 80], ['name' => 'delete_floor', 'section_group_id' => 76, 'caption' => 'delete_floor']);

        
        // Users Management 80 - 8
        Section::updateOrCreate(['id' => 81], ['name' => 'user_management', 'caption' => 'user_management']);
        Section::updateOrCreate(['id' => 82], ['name' => 'all_users', 'section_group_id' => 81, 'caption' => 'show_all_users']);
        Section::updateOrCreate(['id' => 83], ['name' => 'change_users_role', 'section_group_id' => 81, 'caption' => 'change_users_role']);
        Section::updateOrCreate(['id' => 84], ['name' => 'change_users_status', 'section_group_id' => 81, 'caption' => 'change_users_status']);
        Section::updateOrCreate(['id' => 85], ['name' => 'delete_user', 'section_group_id' => 81, 'caption' => 'delete_user']);
        Section::updateOrCreate(['id' => 86], ['name' => 'edit_user', 'section_group_id' => 81, 'caption' => 'edit_user']);
        Section::updateOrCreate(['id' => 87], ['name' => 'create_user', 'section_group_id' => 81, 'caption' => 'create_user']);
 
 
        /* Run Panel Sections */
        $this->runPanelSections();
    }
    private function runPanelSections()
    {

        // // Organization Instructors 1 - 9
        // $this->createPanelSection(['id' => 1], ['name' => 'panel_organization_instructors', 'caption' => 'Organization Instructors']);
        // $this->createPanelSection(['id' => 2], ['name' => 'panel_organization_instructors_lists', 'section_group_id' => 1, 'caption' => 'Lists']);
        // $this->createPanelSection(['id' => 3], ['name' => 'panel_organization_instructors_create', 'section_group_id' => 1, 'caption' => 'Create']);
        // $this->createPanelSection(['id' => 4], ['name' => 'panel_organization_instructors_edit', 'section_group_id' => 1, 'caption' => 'Edit']);
        // $this->createPanelSection(['id' => 5], ['name' => 'panel_organization_instructors_delete', 'section_group_id' => 1, 'caption' => 'Delete']);

    }

    private function createPanelSection($arr1, $arr2)
    {
        $prefixId     = 100000;
        $arr2['type'] = "panel";

        if (! empty($arr2['section_group_id'])) {
            $arr2['section_group_id'] = $prefixId + $arr2['section_group_id'];
        }

        Section::updateOrCreate([
            'id' => $prefixId + $arr1['id'],
        ], $arr2);
    }
}
