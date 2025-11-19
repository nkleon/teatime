<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->description = 'System administrator';
        $admin->save();

        $owner = new Role();
        $owner->name = 'owner';
        $owner->description = 'Tea farm owner';
        $owner->save();

        $picker = new Role();
        $picker->name = 'picker';
        $picker->description = 'Tea picker';
        $picker->save();
    }
}