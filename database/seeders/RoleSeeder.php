<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        collect([
            ['name' => 'admin'],
            ['name' => 'moderator'],
        ])->each(fn ($user) => \App\Models\Role::create($user));
    }
}
