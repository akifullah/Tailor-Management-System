<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeAndFieldSeeder extends Seeder
{
    public function run(): void
    {
        // Define all types
        $types = [
            'pant',
            'shirt',
            'kameez',
            'shalwar',
            'coat',
            'waistcoat',
            'shirt_pant',
            'kameez_shalwar'
        ];

        // Insert types and store their IDs
        $typeIds = [];
        foreach ($types as $type) {
            $prefix = strtolower(trim(str_replace(' ', '_', $type)));
            $typeIds[$type] = DB::table('types')->insertGetId([
                'name' => strtolower($type),
                'name_prefix' => $prefix . "_",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Define all field options
        $options = [
            'pant' => [
                ['label' => 'Waist', 'name' => 'pant_waist', 'type' => 'input'],
                ['label' => 'Seat / Hip', 'name' => 'pant_seat_hip', 'type' => 'input'],
                ['label' => 'Bottom', 'name' => 'pant_bottom', 'type' => 'input'],
                ['label' => 'Length', 'name' => 'pant_length', 'type' => 'input'],
                ['label' => 'Fit', 'name' => 'pant_fit', 'type' => 'select', 'options' => ['Slim', 'Regular', 'Loose']],
                ['label' => 'Pocket Style', 'name' => 'pant_pocket_style', 'type' => 'select', 'options' => ['Cross', 'Straight']],
            ],

            'shirt' => [
                ['label' => 'Neck', 'name' => 'shirt_neck', 'type' => 'input'],
                ['label' => 'Chest', 'name' => 'shirt_chest', 'type' => 'input'],
                ['label' => 'Waist', 'name' => 'shirt_waist', 'type' => 'input'],
                ['label' => 'Shoulder', 'name' => 'shirt_shoulder', 'type' => 'input'],
                ['label' => 'Sleeve', 'name' => 'shirt_sleeve', 'type' => 'input'],
                ['label' => 'Cuff', 'name' => 'shirt_cuff', 'type' => 'input'],
                ['label' => 'Shirt Length', 'name' => 'shirt_length', 'type' => 'input'],
                ['label' => 'Fit', 'name' => 'shirt_fit', 'type' => 'select', 'options' => ['Slim', 'Regular']],
                ['label' => 'Collar', 'name' => 'shirt_collar', 'type' => 'select', 'options' => ['Spread', 'Button-down', 'Mandarin']],
                ['label' => 'Cuffs', 'name' => 'shirt_cuffs', 'type' => 'select', 'options' => ['Single', 'Double']],
                ['label' => 'Pocket', 'name' => 'shirt_pocket', 'type' => 'select', 'options' => ['0', '1', '2']],
                ['label' => 'Daman', 'name' => 'shirt_daman', 'type' => 'select', 'options' => ['Gool', 'Sada']],
            ],

            'kameez' => [
                ['label' => 'Length', 'name' => 'kameez_length', 'type' => 'input'],
                ['label' => 'Sleeve', 'name' => 'kameez_sleeve', 'type' => 'input'],
                ['label' => 'Collar', 'name' => 'kameez_collar', 'type' => 'select', 'options' => ['Collar', 'Short Collar', 'Nokdar Collar']],
                ['label' => 'Bann', 'name' => 'kameez_bann', 'type' => 'select', 'options' => ['Full Ban Cut', 'Full Ban Gool', 'Half Ban Cut', 'Half Ban Gool', 'Kabali Ban', 'Design Ban']],
                ['label' => 'Cuff', 'name' => 'kameez_cuff', 'type' => 'select', 'options' => ['Sada', 'Gool', 'Sada Cut', 'Studd Kaag Gool', 'Studd Kaag Sada', 'Studd Double', 'Cuff 2 Kaag', 'Chk Patae Kaag', 'Bagair Chk Patae', 'Chk Patae 2 Kaag']],
                ['label' => 'Stitching', 'name' => 'kameez_stitching', 'type' => 'select', 'options' => ['Simple', 'Chamak', 'Double Chamak', 'Double Simple', 'Conquer Stitch']],
                ['label' => 'Pocket', 'name' => 'kameez_pocket', 'type' => 'select', 'options' => ['Side 1 Pocket', 'Side 2 Pocket', 'Front 1 Pocket', 'Front 2 Pocket', 'Front 2 Pocket Tash']],
                ['label' => 'Daman', 'name' => 'kameez_daman', 'type' => 'select', 'options' => ['Sada', 'Gool']],
                ['label' => 'Asteen', 'name' => 'kameez_asteen', 'type' => 'select', 'options' => ['No Palet', 'One Palet', 'Two Palet']],
                ['label' => 'Buttons', 'name' => 'kameez_buttons', 'type' => 'select', 'options' => ['1', '2', '3', '4', '5']],
                ['label' => 'Button Style', 'name' => 'kameez_button_style', 'type' => 'select', 'options' => ['Simple', 'Design']],
            ],

            'shalwar' => [
                ['label' => 'Length', 'name' => 'shalwar_length', 'type' => 'input'],
                ['label' => 'Pancha', 'name' => 'shalwar_pancha', 'type' => 'input'],
                ['label' => 'Shalwar Type', 'name' => 'shalwar_type', 'type' => 'select', 'options' => ['Kundo Wala', 'Bagair Kundo Wala']],
                ['label' => 'Asin Width', 'name' => 'shalwar_asin_width', 'type' => 'input'],
                ['label' => 'Shalwar Pockets', 'name' => 'shalwar_shalwar_pockets', 'type' => 'select', 'options' => ['One', 'Two']],
                ['label' => 'Paint Pocket', 'name' => 'shalwar_paint_pocket', 'type' => 'input'],
            ],

            'coat' => [
                ['label' => 'Chest', 'name' => 'coat_chest', 'type' => 'input'],
                ['label' => 'Waist', 'name' => 'coat_waist', 'type' => 'input'],
                ['label' => 'Hip', 'name' => 'coat_hip', 'type' => 'input'],
                ['label' => 'Shoulder', 'name' => 'coat_shoulder', 'type' => 'input'],
                ['label' => 'Sleeve', 'name' => 'coat_sleeve', 'type' => 'input'],
                ['label' => 'Half Back', 'name' => 'coat_half_back', 'type' => 'input'],
                ['label' => 'Chok', 'name' => 'coat_chok', 'type' => 'select', 'options' => ['None', 'Single', 'Double']],
                ['label' => 'Fit', 'name' => 'coat_fit', 'type' => 'select', 'options' => ['Slim', 'Regular']],
                ['label' => 'Buttons', 'name' => 'coat_buttons', 'type' => 'select', 'options' => ['1', '2', '3']],
            ],

            'waistcoat' => [
                ['label' => 'Chest', 'name' => 'waistcoat_chest', 'type' => 'input'],
                ['label' => 'Waist', 'name' => 'waistcoat_waist', 'type' => 'input'],
                ['label' => 'Shoulder', 'name' => 'waistcoat_shoulder', 'type' => 'input'],
                ['label' => 'Length', 'name' => 'waistcoat_length', 'type' => 'input'],
                ['label' => 'Neck Depth', 'name' => 'waistcoat_neck_depth', 'type' => 'input'],
                ['label' => 'Buttons', 'name' => 'waistcoat_buttons', 'type' => 'select', 'options' => ['1', '2', '3', '4', '5']],
                ['label' => 'Style', 'name' => 'waistcoat_style', 'type' => 'select', 'options' => ['Simple', 'Design']],
            ],
        ];

        // Insert fields
        foreach ($options as $type => $fields) {
            foreach ($fields as $field) {
                DB::table('fields')->insert([
                    'type_id' => $typeIds[$type] ?? null,
                    'name' => strtolower($field['name']),
                    'label' => strtolower($field['label']),
                    'input_type' => $field['type'],
                    'options' => isset($field['options']) ? json_encode($field['options']) : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
