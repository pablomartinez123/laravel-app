<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gateways')->insert([
            'display_name' => 'Stripe',
            'code' => 'stripe',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
