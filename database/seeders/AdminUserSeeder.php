<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('username', 'admin')->exists()){
            $adminUser = User::create([
                'last_name' => 'Admin',
                'middle_name' => 'Admin',
                'first_name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('cmisid'),
                'is_active' => 1
            ]);

            $adminRole = Role::where('name', 'admin')->first();
            if($adminRole){
                $adminUser->roles()->attach($adminRole->id);
            }
        }
    }
}
