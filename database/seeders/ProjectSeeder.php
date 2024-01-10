<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'title' => 'Website Redesign',
                'description' => 'Redesign of corporate website for Acme Corporation.',
                'platform' => 'Web',
                'status' => 'Active',
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'client_id' => 1, // Assume client with ID 1 exists (Acme Corporation)
            ],
            [
                'title' => 'Mobile App Development',
                'description' => 'Development of a mobile app for Tech Innovations Ltd.',
                'platform' => 'Mobile',
                'status' => 'Inactive',
                'start_date' => now(),
                'end_date' => now()->addDays(45),
                'client_id' => 2, // Assume client with ID 2 exists (Tech Innovations Ltd.)
            ],
            [
                'title' => 'Global Marketing Campaign',
                'description' => 'Launch of a global marketing campaign for Global Solutions Inc.',
                'platform' => 'Marketing',
                'status' => 'Pending',
                'start_date' => now(),
                'end_date' => now()->addDays(60),
                'client_id' => 3, // Assume client with ID 3 exists (Global Solutions Inc.)
            ],
            [
                'title' => 'Innovate ERP System',
                'description' => 'Implementation of an ERP system for Innovate Industries.',
                'platform' => 'Enterprise',
                'status' => 'Active',
                'start_date' => now(),
                'end_date' => now()->addDays(90),
                'client_id' => 4, // Assume client with ID 4 exists (Innovate Industries)
            ],
            [
                'title' => 'Digital Marketing Strategy',
                'description' => 'Development of a comprehensive digital marketing strategy for Digital Ventures LLC.',
                'platform' => 'Marketing',
                'status' => 'Active',
                'start_date' => now(),
                'end_date' => now()->addDays(45),
                'client_id' => 5, // Assume client with ID 5 exists (Digital Ventures LLC)
            ],
            [
                'title' => 'Elite E-commerce Platform',
                'description' => 'Creation of an e-commerce platform for Elite Enterprises.',
                'platform' => 'E-commerce',
                'status' => 'Pending',
                'start_date' => now(),
                'end_date' => now()->addDays(120),
                'client_id' => 6, // Assume client with ID 6 exists (Elite Enterprises)
            ],
            [
                'title' => 'Synergy CRM Implementation',
                'description' => 'Implementation of a CRM system for Synergy Systems.',
                'platform' => 'Enterprise',
                'status' => 'Active',
                'start_date' => now(),
                'end_date' => now()->addDays(60),
                'client_id' => 7, // Assume client with ID 7 exists (Synergy Systems)
            ],
            [
                'title' => 'NexGen AI Project',
                'description' => 'Development of an artificial intelligence project for NexGen Technologies.',
                'platform' => 'AI',
                'status' => 'Pending',
                'start_date' => now(),
                'end_date' => now()->addDays(150),
                'client_id' => 8, // Assume client with ID 8 exists (NexGen Technologies)
            ],
            [
                'title' => 'Future Solutions Mobile App',
                'description' => 'Development of a mobile app for Future Solutions Co.',
                'platform' => 'Mobile',
                'status' => 'Active',
                'start_date' => now(),
                'end_date' => now()->addDays(30),
                'client_id' => 9, // Assume client with ID 9 exists (Future Solutions Co.)
            ],
            [
                'title' => 'Visionary Ventures Blockchain Project',
                'description' => 'Implementation of a blockchain project for Visionary Ventures.',
                'platform' => 'Blockchain',
                'status' => 'Pending',
                'start_date' => now(),
                'end_date' => now()->addDays(180),
                'client_id' => 10, // Assume client with ID 10 exists (Visionary Ventures)
            ],
        ]);
    }
}
