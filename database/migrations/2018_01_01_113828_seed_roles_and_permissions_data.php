<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedRolesAndPermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Clear cache
        app()['cache']->forget('spatie.permission.cache');

        // Create permissions
        Permission::create(['name' => 'manage_settings']);
        Permission::create(['name' => 'manage_users']);
        Permission::create(['name' => 'manage_contents']);
        Permission::create(['name' => 'read_articles']);
        Permission::create(['name' => 'write_articles']);

        // Superadmin
        $superadmin = Role::create(['name' => 'Superadmin']);
        $superadmin->givePermissionTo('manage_settings');
        $superadmin->givePermissionTo('manage_users');
        $superadmin->givePermissionTo('manage_contents');
        $superadmin->givePermissionTo('read_articles');
        $superadmin->givePermissionTo('write_articles');

        // Admin
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo('manage_contents');

        // Writer
        $writer = Role::create(['name' => 'Writer']);
        $writer->givePermissionTo('write_articles');

        // Subscriber
        $subscriber = Role::create(['name' => 'Subscriber']);
        $subscriber->givePermissionTo('read_articles');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Clear cache
        app()['cache']->forget('spatie.permission.cache');

        $tableNames = config('permission.table_names');

        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}
