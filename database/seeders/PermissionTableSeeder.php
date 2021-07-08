<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
//            'role-list',
//            'role-create',
//            'role-edit',
//            'role-delete',
//            'news-list',
//            'news-create',
//            'news-edit',
//            'news-delete',
//             'language-list',
//            'language-create',
//            'language-edit',
//            'language-delete'
        'edit-translations'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
