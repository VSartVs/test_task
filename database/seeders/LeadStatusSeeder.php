<?php

namespace Database\Seeders;

use App\Enums\LeadStatusEnum;
use App\Models\LeadStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = LeadStatusEnum::cases();
        foreach ($statuses as $status) {
            LeadStatus::create([
                'title' => $status->value,
            ]);
        }
    }
}
