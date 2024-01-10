<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            ['name' => 'Acme Corporation', 'email' => 'acme@example.com', 'phone' => '123-456-7890'],
            ['name' => 'Tech Innovations Ltd.', 'email' => 'tech@example.com', 'phone' => '987-654-3210'],
            ['name' => 'Global Solutions Inc.', 'email' => 'global@example.com', 'phone' => '555-123-4567'],
            ['name' => 'Innovate Industries', 'email' => 'innovate@example.com', 'phone' => '777-888-9999'],
            ['name' => 'Digital Ventures LLC', 'email' => 'digital@example.com', 'phone' => '111-222-3333'],
            ['name' => 'Elite Enterprises', 'email' => 'elite@example.com', 'phone' => '444-555-6666'],
            ['name' => 'Synergy Systems', 'email' => 'synergy@example.com', 'phone' => '999-888-7777'],
            ['name' => 'NexGen Technologies', 'email' => 'nexgen@example.com', 'phone' => '222-333-4444'],
            ['name' => 'Future Solutions Co.', 'email' => 'future@example.com', 'phone' => '666-777-8888'],
            ['name' => 'Visionary Ventures', 'email' => 'visionary@example.com', 'phone' => '888-999-0000'],
        ]);
    }
}
