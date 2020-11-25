<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'browse_admin',
            'browse_bread',
            'browse_database',
            'browse_media',
            'browse_compass',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('menus');

        Permission::generateFor('roles');

        Permission::generateFor('users');

        Permission::generateFor('settings');

        /*
         * CUSTOM, NON-VOYAGER TABLES
         */

        Permission::generateFor('projects');
        Permission::generateFor('project_types');
        Permission::generateFor('items');
        Permission::generateFor('annotations');
        Permission::generateFor('annotation_types');
        Permission::generateFor('annotation_attributes');
        Permission::generateFor('annotation_values');
        Permission::generateFor('annotation_attribute_values');
        Permission::generateFor('view_types');
        Permission::generateFor('points');
        Permission::generateFor('shapes');
    }
}
