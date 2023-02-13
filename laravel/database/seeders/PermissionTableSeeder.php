<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $permissions = [
            'user-read',
            'user-create',
            'user-update',
            'user-delete',
            'role-read',
            'role-create',
            'role-update',
            'role-delete',
            'organization-read',
            'organization-create',
            'organization-update',
            'organization-delete',
            'location-read',
            'location-create',
            'location-update',
            'location-delete',
            'event-read',
            'event-create',
            'event-update',
            'event-delete',
            'event-registration',
            'event-checkin',
            'race_team-read',
            'race_team-create',
            'race_team-update',
            'race_team-delete',
            'registration-signup',
            'registration-update',
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
            ->givePermissionTo(['user-read', 'role-read', 'organization-read', 'organization-create', 'organization-update', 'organization-delete',
                'location-read', 'location-create', 'location-update', 'location-delete', 'event-read', 'event-create', 'event-update', 'event-delete', 'event-registration',
                'event-checkin', 'race_team-read', 'race_team-create', 'race_team-update', 'race_team-delete', 'registration-signup', 'registration-update', ]);

        /**
         * Organizer
         */
        $organizer = Role::create(['name' => 'organizer'])
            ->givePermissionTo(['organization-read', 'location-read', 'location-create', 'location-update', 'location-delete', 'event-read', 'event-create',
                'event-update', 'event-delete', 'event-registration', 'event-checkin', 'registration-signup', 'registration-update', ]);

        /**
         * Racer
         */
        $racer = Role::create(['name' => 'racer'])
            ->givePermissionTo(['registration-signup', 'registration-update']);

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        app()['cache']->forget('spatie.permission.cache');
    }
}
