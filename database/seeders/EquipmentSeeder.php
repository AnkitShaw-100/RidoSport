<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('equipment')->insert([
            [
                'name' => 'Football Goal Post',
                'description' => 'Introducing our premier football goal post, meticulously engineered to elevate your game experience to new heights. Crafted with precision and durability in mind, our goal post boasts a range of features designed to enhance performance and withstand the rigors of intense play, ensuring long-lasting durability and resilience against adverse weather conditions. Within this framework, MS tubes are utilized for durable welding purposes, while the front fascia is crafted using 5’’ MS round tubes (4mm W.T.).',
                'image' => 'images/products/product_res/Football System/Football Goal Post.png',
                'sports_equipment_id' => 4, // Adjust based on your actual sports equipment id
            ],
            [
                'name' => 'Moveable Handball Goal Posts',
                'description' => 'Handball goal post poles, intended for mobility, have dimensions of 3 meters in width and 2 meters in height. The front fascia is constructed with an 80mm diameter M.S. pipe, with a wall thickness of 3.2mm ± 0.1mm. Furthermore, rear pipes with a 40mm diameter feature hooks to fasten nets at the rear. Each element is coated with primer and epoxy paint to achieve a refined appearance.',
                'image' => 'images/products/product_res/Handball System/handball_goal_post.png',
                'sports_equipment_id' => 6, // Adjust based on your actual sports equipment id
            ],
            [
                'name' => 'Hockey System',
                'description' => 'Hockey goal post featuring an aluminum fascia, M.S. pipe structure, and a wooden backboard reinforced with rubber coating, all designed in accordance with international standards.',
                'image' => 'images/products/product_res/Hockey System/hoockey.png',
                'sports_equipment_id' => 5, // Adjust based on your actual sports equipment id
            ],
            [
                'name' => 'Lawn Tennis System',
                'description' => 'Introducing our meticulously crafted Tennis Net System, designed to set the standard for excellence on the court & Constructed from MS tubes. Our Net Pole includes a user-friendly wire tensioning system, allowing for quick and precise adjustment of the net tension to meet individual preferences and playing conditions.',
                'image' => 'images/products/product_res/Tennis System/lawn_tennis.png',
                'sports_equipment_id' => 8, // Adjust based on your actual sports equipment id
            ],
            [
                'name' => 'Tennis Backstop Unit (Movable)',
                'description' => 'Introducing our meticulously crafted Tennis Net System, designed to set the standard for excellence on the court & Constructed from MS tubes. Our goal post includes a user-friendly tensioning system, allowing for quick and precise adjustment of the net tension to meet individual preferences and playing conditions. The system is equipped with large wheels to allow easy manoeuvring.',
                'image' => 'images/products/product_res/Tennis System/st_final.png',
                'sports_equipment_id' => 8, // Adjust based on your actual sports equipment id
            ],
            [
                'name' => 'Basic Volleyball Net Pole System',
                'description' => 'Volleyball pole made of round MS tube 94mm outer Dia (3mm W.T.) with an overlapping of MS tube 98mm inner Dia (3mm W.T.), provided with two handles on each side for height adjustment, pulley and socket system for net tightening, epoxy painted, a basic design featuring a system for height adjustment. This system is installed using 750mm of grouting for stability and support.',
                'image' => 'images/products/product_res/Volleyball System/2.png',
                'sports_equipment_id' => 9, // Adjust based on your actual sports equipment id
            ],
            [
                'name' => 'Volleyball Net Pole System (Heavy Duty)',
                'description' => 'Volleyball poles designed for heavy-duty use, installed securely in grout, featuring an integrated height adjustment with the help of a rack and gear system, net wire tightening mechanism with the help of an integrated gearbox fixed outside the main pole, epoxy painted, detachable/grouted in the floor, compliant with international standards.',
                'image' => 'images/products/product_res/Volleyball System/3.png',
                'sports_equipment_id' => 9, // Adjust based on your actual sports equipment id
            ],
        ]);
    }
}
