<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;

class SeedRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed user roles into the roles table';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('roles')->insert([
            ['id' => '1', 'role' => 'User'],
            ['id' => '2', 'role' => 'Designer'],
            ['id' => '3', 'role' => 'Manager'],
            ['id' => '4', 'role' => 'Admin'],
            ['id' => '5', 'role' => 'Developer'],
        ]);
    }
}
