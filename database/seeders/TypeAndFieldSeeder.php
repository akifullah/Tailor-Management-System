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

        // Define all field options (nested structure)
        $options = [
            'pant' => [
                'pant' => [
                    'fields' => [
                        ['label' => 'Waist', 'name' => 'pant_Waist', 'input_type' => 'input'],
                        ['label' => 'Seat / Hip', 'name' => 'pant_Seat_Hip', 'input_type' => 'input'],
                        ['label' => 'Bottom', 'name' => 'pant_Bottom', 'input_type' => 'input'],
                        ['label' => 'Length', 'name' => 'pant_Length', 'input_type' => 'input'],
                        ['label' => 'Fit', 'name' => 'pant_Fit', 'input_type' => 'select', 'options' => ['Slim', 'Regular', 'Loose']],
                        ['label' => 'Pocket Style', 'name' => 'pant_Pocket_Style', 'input_type' => 'select', 'options' => ['Cross', 'Straight']],
                    ]
                ]
            ],

            'shirt' => [
                'shirt' => [
                    'fields' => [
                        ['label' => 'Neck', 'name' => 'shirt_Neck', 'input_type' => 'input'],
                        ['label' => 'Chest', 'name' => 'shirt_Chest', 'input_type' => 'input'],
                        ['label' => 'Waist', 'name' => 'shirt_Waist', 'input_type' => 'input'],
                        ['label' => 'Shoulder', 'name' => 'shirt_Shoulder', 'input_type' => 'input'],
                        ['label' => 'Sleeve', 'name' => 'shirt_Sleeve', 'input_type' => 'input'],
                        ['label' => 'Cuff', 'name' => 'shirt_Cuff', 'input_type' => 'input'],
                        ['label' => 'Shirt Length', 'name' => 'shirt_Length', 'input_type' => 'input'],
                        ['label' => 'Fit', 'name' => 'shirt_Fit', 'input_type' => 'select', 'options' => ['Slim', 'Regular']],
                        ['label' => 'Collar', 'name' => 'shirt_Collar', 'input_type' => 'select', 'options' => ['Spread', 'Button-down', 'Mandarin']],
                        ['label' => 'Cuffs', 'name' => 'shirt_Cuffs', 'input_type' => 'select', 'options' => ['Single', 'Double']],
                        ['label' => 'Pocket', 'name' => 'shirt_Pocket', 'input_type' => 'select', 'options' => ['0', '1', '2']],
                        ['label' => 'Daman', 'name' => 'shirt_Daman', 'input_type' => 'select', 'options' => ['Gool', 'Sada']],
                    ]
                ]
            ],

            'kameez' => [
                'kameez' => [
                    'fields' => [
                        ['label' => 'Length', 'name' => 'kameez_Length', 'input_type' => 'input'],
                        ['label' => 'Sleeve', 'name' => 'kameez_Sleeve', 'input_type' => 'input'],
                        ['label' => 'Collar', 'name' => 'kameez_Collar', 'input_type' => 'select', 'options' => ['Collar', 'Short Collar', 'Nokdar Collar']],
                        ['label' => 'Bann', 'name' => 'kameez_Bann', 'input_type' => 'select', 'options' => ['Full Ban Cut', 'Full Ban Gool', 'Half Ban Cut', 'Half Ban Gool', 'Kabali Ban', 'Design Ban']],
                        ['label' => 'Cuff', 'name' => 'kameez_Cuff', 'input_type' => 'select', 'options' => ['Sada', 'Gool', 'Sada Cut', 'Studd Kaag Gool', 'Studd Kaag Sada', 'Studd Double', 'Cuff 2 Kaag', 'Chk Patae Kaag', 'Bagair Chk Patae', 'Chk Patae 2 Kaag']],
                        ['label' => 'Stitching', 'name' => 'kameez_Stitching', 'input_type' => 'select', 'options' => ['Simple', 'Chamak', 'Double Chamak', 'Double Simple', 'Conquer Stitch']],
                        ['label' => 'Pocket', 'name' => 'kameez_Pocket', 'input_type' => 'select', 'options' => ['Side 1 Pocket', 'Side 2 Pocket', 'Front 1 Pocket', 'Front 2 Pocket', 'Front 2 Pocket Tash']],
                        ['label' => 'Daman', 'name' => 'kameez_Daman', 'input_type' => 'select', 'options' => ['Sada', 'Gool']],
                        ['label' => 'Asteen', 'name' => 'kameez_Asteen', 'input_type' => 'select', 'options' => ['No Palet', 'One Palet', 'Two Palet']],
                        ['label' => 'Buttons', 'name' => 'kameez_Buttons', 'input_type' => 'select', 'options' => ['1', '2', '3', '4', '5']],
                        ['label' => 'Button Style', 'name' => 'kameez_Button_Style', 'input_type' => 'select', 'options' => ['Simple', 'Design']],
                    ]
                ]
            ],

            'shalwar' => [
                'shalwar' => [
                    'fields' => [
                        ['label' => 'Length', 'name' => 'shalwar_Length', 'input_type' => 'input'],
                        ['label' => 'Pancha', 'name' => 'shalwar_Pancha', 'input_type' => 'input'],
                        ['label' => 'Shalwar Type', 'name' => 'shalwar_Type', 'input_type' => 'select', 'options' => ['Kundo Wala', 'Bagair Kundo Wala']],
                        ['label' => 'Asin Width', 'name' => 'shalwar_Asin_Width', 'input_type' => 'input'],
                        ['label' => 'Shalwar Pockets', 'name' => 'shalwar_Shalwar_Pockets', 'input_type' => 'select', 'options' => ['One', 'Two']],
                        ['label' => 'Paint Pocket', 'name' => 'shalwar_Paint_Pocket', 'input_type' => 'input'],
                    ]
                ]
            ],

            'coat' => [
                'coat' => [
                    'fields' => [
                        ['label' => 'Chest', 'name' => 'coat_Chest', 'input_type' => 'input'],
                        ['label' => 'Waist', 'name' => 'coat_Waist', 'input_type' => 'input'],
                        ['label' => 'Hip', 'name' => 'coat_Hip', 'input_type' => 'input'],
                        ['label' => 'Shoulder', 'name' => 'coat_Shoulder', 'input_type' => 'input'],
                        ['label' => 'Sleeve', 'name' => 'coat_Sleeve', 'input_type' => 'input'],
                        ['label' => 'Half Back', 'name' => 'coat_Half_Back', 'input_type' => 'input'],
                        ['label' => 'Chok', 'name' => 'coat_Chok', 'input_type' => 'select', 'options' => ['None', 'Single', 'Double']],
                        ['label' => 'Fit', 'name' => 'coat_Fit', 'input_type' => 'select', 'options' => ['Slim', 'Regular']],
                        ['label' => 'Buttons', 'name' => 'coat_Buttons', 'input_type' => 'select', 'options' => ['1', '2', '3']],
                    ]
                ]
            ],

            'waistcoat' => [
                'waistcoat' => [
                    'fields' => [
                        ['label' => 'Chest', 'name' => 'waistcoat_Chest', 'input_type' => 'input'],
                        ['label' => 'Waist', 'name' => 'waistcoat_Waist', 'input_type' => 'input'],
                        ['label' => 'Shoulder', 'name' => 'waistcoat_Shoulder', 'input_type' => 'input'],
                        ['label' => 'Length', 'name' => 'waistcoat_Length', 'input_type' => 'input'],
                        ['label' => 'Neck Depth', 'name' => 'waistcoat_Neck_Depth', 'input_type' => 'input'],
                        ['label' => 'Buttons', 'name' => 'waistcoat_Buttons', 'input_type' => 'select', 'options' => ['1', '2', '3', '4', '5']],
                        ['label' => 'Style', 'name' => 'waistcoat_Style', 'input_type' => 'select', 'options' => ['Simple', 'Design']],
                    ]
                ]
            ],
        ];

        // Combine shirt_pant and kameez_shalwar
        $options['shirt_pant'] = [
            'shirt' => $options['shirt']['shirt'],
            'pant' => $options['pant']['pant'],
        ];

        $options['kameez_shalwar'] = [
            'kameez' => $options['kameez']['kameez'],
            'shalwar' => $options['shalwar']['shalwar'],
        ];

        // Insert all fields into DB
        foreach ($options as $type => $sections) {
            foreach ($sections as $sectionName => $section) {
                foreach ($section['fields'] as $field) {
                    DB::table('fields')->insert([
                        'type_id' => $typeIds[$type] ?? null,
                        'name' => strtolower($field['name']),
                        'label' => strtolower($field['label']),
                        'input_type' => $field['input_type'],
                        'options' => isset($field['options']) ? json_encode($field['options']) : null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
