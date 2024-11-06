<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(["name" => "pustakawan"]);
        Permission::create(['name' => 'edit_users']);
        Role::create(["name" => "mahasiswa"]);
        Permission::create(['name' => 'view_book']);
        
    }
}
