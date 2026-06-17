<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsSeeder extends Seeder
{
    public function run()
    {
        // Projects Data
        $projects = [
            // Synthetic Track Project
            [
                'title' => 'WAC Subroto Park, Synthetic Track',
                'description' => 'Desan International has constructed a running track at WAC Subroto Park using the RIDOFLEX material, which is a product of Desan International\'s parent company. This project was completed in 2024. The running track is built with RIDOFLEX material, known for its innovation and high quality. Through this project, the company has introduced a new way to promote fitness and sports, providing people with better and modern facilities.',
                'images' => json_encode([
                  'images\wetrans\outdoor\Synthetic Track\Wac Subroto Park 56.jpg',
                    'images\wetrans\outdoor\Synthetic Track\Wac Subroto Park 46.jpg',
                    'images\wetrans\outdoor\Synthetic Track\Wac Subroto Park 47.jpg',
                    'images\wetrans\outdoor\Synthetic Track\Wac Subroto Park 48.jpg',
                    'images\wetrans\outdoor\Synthetic Track\Wac Subroto Park 53.jpg',
                    'images\wetrans\outdoor\Synthetic Track\Wac Subroto Park 54.jpg'
                ]),
                'subservice_id' => 75, // Adjust this based on your actual subservice ID for tracks
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Jogging Track Project
            [
                'title' => 'DDA Rohini, Jogging Track',
                'description' => 'Desan International constructed a state-of-the-art jogging track at DDA Rohini in 2023, using Ridoflex materials. The track featured a cutting-edge sandwich system, showcasing innovation and quality craftsmanship. This project not only exemplifies the company’s expertise but also underscores their commitment to excellence and advancement in the field of construction.',
                'images' => json_encode([
                    'images\wetrans\outdoor\Jogging Track\DDA Rohini 1.6.jpg',
                    'images\wetrans\outdoor\Jogging Track\DDA Rohini 1.1.jpg',
                    'images\wetrans\outdoor\Jogging Track\DDA Rohini 1.2.jpg',
                    'images\wetrans\outdoor\Jogging Track\DDA Rohini 1.3.jpg',
                    'images\wetrans\outdoor\Jogging Track\DDA Rohini 1.4.jpg',
                    'images\wetrans\outdoor\Jogging Track\DDA Rohini 1.5.jpg'
                ]),
                'subservice_id' => 79, // Adjust this based on your actual subservice ID for jogging tracks
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Kid Play Area Project
            [
                'title' => 'Destination Health Artech Lifespaces, Kid Play Area',
                'description' => 'Desan International undertook a remarkable project at Destination Health Artech Lifespaces in Akkulam, Trivandrum in 2022, where they created a vibrant kid play area featuring 36mm EPDM flooring. This innovative and engaging space not only showcases Desan\'s expertise in crafting recreational zones but also emphasizes their commitment to using high-quality materials for safety and durability. The completion of this project in 2022 further solidifies the company\'s reputation as a leader in creating engaging and safe environments for children.',
                'images' => json_encode([
                    'images\wetrans\outdoor\Kids Play Area\Destination Health Artech Lifespaces.jpeg',
                    'images\wetrans\outdoor\Kids Play Area\Destination Health Artech Lifespaces 1.2.jpg',
                    'images\wetrans\outdoor\Kids Play Area\Destination Health Artech Lifespaces 1.3.jpg',
                    'images\wetrans\outdoor\Kids Play Area\Destination Health Artech Lifespaces 1.4.jpg',
                    'images\wetrans\outdoor\Kids Play Area\Destination Health Artech Lifespaces 1.5.jpg'
                ]),
                'subservice_id' => 80, // Adjust this based on your actual subservice ID for kid play areas
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Indoor PU Flooring Project
            [
                'title' => 'BITS Pilani, Indoor PU Flooring',
                'description' => 'Desan International has utilized RIDOFLEX PU material to construct indoor badminton courts at BITS Pilani and completed the project in 2024. This project showcases the quality of PU sports flooring, providing an excellent playing surface for indoor flooring that offers optimal grip, shock absorption, and durability. The use of RIDOFLEX PU material demonstrates Desan International\'s expertise in creating top-notch sports facilities that prioritize quality and enhance the indoor playing experience.',
                'images' => json_encode([
                    'images\wetrans\indoor\indoor_pu\BITS, Pilani 1.4.jpg',
                    'images\wetrans\indoor\indoor_pu\BITS Pilani.jpg',
                    'images\wetrans\indoor\indoor_pu\BITS, Pilani 1.1.jpg',
                    'images\wetrans\indoor\indoor_pu\BITS, Pilani 1.2.jpg'
                ]),
                'subservice_id' => 82, // Adjust this based on your actual subservice ID for PU flooring
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the projects data into the database
        DB::table('projects')->insert($projects);
    }
}
