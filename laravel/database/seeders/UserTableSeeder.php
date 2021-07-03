<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'pilot_name' => 'The BOSS',
            'email' => 'admin@themesbrand.com',
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            // 'settings' => 2, // is True
        ]);

        $user->assignRole('supervisor');
    }
}
