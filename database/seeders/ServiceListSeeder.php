<?php

namespace Database\Seeders; // Add this line
use Illuminate\Database\Seeder;
use App\Models\ServiceList;

class ServiceListSeeder extends Seeder
{
    public function run()
    {
        // Main Services
        $outdoorSportsFlooring = ServiceList::create([
            'name' => 'Outdoor Sports Flooring',
            'slug' => 'outdoor-sports-flooring',
            'parent_id' => null, // This is a main service, no parent
        ]);

        $indoorSportsFlooring = ServiceList::create([
            'name' => 'Indoor Sports Flooring',
            'slug' => 'indoor-sports-flooring',
            'parent_id' => null, // This is a main service, no parent
        ]);

        // Sub-services for Outdoor Sports Flooring
        ServiceList::create([
            'name' => 'Synthetic Athletic Tracks (WA/IAAF)',
            'slug' => 'synthetic-athletic-tracks',
            'parent_id' => $outdoorSportsFlooring->id,
        ]);

        ServiceList::create([
            'name' => 'Basketball Court Flooring',
            'slug' => 'basketball-flooring',
            'parent_id' => $outdoorSportsFlooring->id,
        ]);

        ServiceList::create([
            'name' => 'Tennis Courts (ITF Approved)',
            'slug' => 'tennis-courts',
            'parent_id' => $outdoorSportsFlooring->id,
        ]);

        ServiceList::create([
            'name' => 'Badminton Court (BWF Approved)',
            'slug' => 'badminton-courts',
            'parent_id' => $outdoorSportsFlooring->id,
        ]);

        ServiceList::create([
            'name' => 'Activity Tracks (Jogging/Walking track)',
            'slug' => 'activity-tracks',
            'parent_id' => $outdoorSportsFlooring->id,
        ]);

        ServiceList::create([
            'name' => 'Kids Play Flooring',
            'slug' => 'kids-play-flooring',
            'parent_id' => $outdoorSportsFlooring->id,
        ]);

        ServiceList::create([
            'name' => 'Artificial Grass Sports Flooring (FIFA Preferred)',
            'slug' => 'artificial-grass-sports-flooring',
            'parent_id' => $outdoorSportsFlooring->id,
        ]);

        // Sub-services for Indoor Sports Flooring
        ServiceList::create([
            'name' => 'Indoor Polyurethane Flooring',
            'slug' => 'indoor-pu',
            'parent_id' => $indoorSportsFlooring->id,
        ]);

        ServiceList::create([
            'name' => 'Wooden Flooring',
            'slug' => 'wooden',
            'parent_id' => $indoorSportsFlooring->id,
        ]);
    }
}
