<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'organization-list',
            'organization-create',
            'organization-edit',
            'organization-delete',
            'location-list',
            'location-create',
            'location-edit',
            'location-delete',
            'event-list',
            'event-create',
            'event-edit',
            'event-delete',
            'event-registration',
            'event-checkin',
            'race_team-list',
            'race_team-create',
            'race_team-edit',
            'race_team-delete',
            'registration-signup',
            'registration-edit',
        ];

        // Create all permission based on the list above
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        /**
         * Supervisor is defined in AuthServiceProvider
         */
        Role::create(['name' => 'supervisor']);

        /**
         * Manager
         */
        $manager = Role::create(['name' => 'manager'])
            ->givePermissionTo(['user-list','role-list','organization-list','organization-create','organization-edit','organization-delete',
            'location-list','location-create','location-edit','location-delete','event-list','event-create','event-edit','event-delete','event-registration',
            'event-checkin', 'race_team-list', 'race_team-create', 'race_team-edit', 'race_team-delete','registration-signup','registration-edit']);

        /**
         * Organizer
         */
        $organizer = Role::create(['name' => 'organizer'])
            ->givePermissionTo(['organization-list','location-list','location-create','location-edit','location-delete','event-list','event-create',
            'event-edit','event-delete','event-registration','event-checkin','registration-signup','registration-edit']);

        /**
         * Racer
         */
        $racer = Role::create(['name' => 'racer'])
            ->givePermissionTo(['registration-signup','registration-edit']);

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        app()['cache']->forget('spatie.permission.cache');
    }
}