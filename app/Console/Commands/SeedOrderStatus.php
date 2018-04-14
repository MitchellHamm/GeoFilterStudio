<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;

class SeedOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed-order-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed order status into the order_status table';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::table('order_status')->insert([
            ['id' => '1', 'status' => 'Unassigned'],
            ['id' => '2', 'status' => 'Assigned'],
            ['id' => '3', 'status' => 'In Progress'],
            ['id' => '4', 'status' => 'Complete'],
        ]);
    }
}
