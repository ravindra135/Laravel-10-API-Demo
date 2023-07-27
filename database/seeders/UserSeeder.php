<?php

namespace Database\Seeders;

use Database\Seeders\Traits\ToggleForeignChecks;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use ToggleForeignChecks, TruncateTable;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // SQL Statement to set foreign checks off
        $this->disableCheck();

        // Remove Old Data from Users table
        $this->truncate('users');

        // Running Users Facotry to create `10` Users.
        $users = \App\Models\User::factory(10)->create();

        // Settings Foreign checks back to on
        $this->enableCheck();

    }
}
