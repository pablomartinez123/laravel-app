<?php

namespace Database\Seeders;

use App\Models\Gateway;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GatewayValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* @var Gateway $gateway */
        $gateway = Gateway::where('code', Gateway::STRIPE)->first();

        DB::table('gateway_values')->insert([
            'gateway_id' => $gateway->getId(),
            'code' => 'primaryKey',
            'name' => 'Primary key',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('gateway_values')->insert([
            'gateway_id' => $gateway->getId(),
            'code' => 'secondaryKey',
            'name' => 'Secondary key',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
