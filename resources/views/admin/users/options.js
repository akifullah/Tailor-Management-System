const options = {
    pant: {
        fields: [
            {
                label: "Waist",
                name: 'pant_Waist',
                input_type: 'input'
            },
            {
                label: "Seat / Hip",
                name: 'pant_seat_hip',
                input_type: 'input'
            },
            {
                label: "Bottom",
                name: 'pant_Bottom',
                input_type: 'input'
            },
            {
                label: "Length",
                name: 'pant_Length',
                input_type: 'input'
            },
            {
                label: "Fit",
                name: 'pant_Fit',
                input_type: 'select',
                options: ['Slim', 'Regular', 'Loose'
                ]
            },
            {
                label: "Pocket Style",
                name: 'pant_pocket_style',
                input_type: 'select',
                options: ['Cross', 'Straight'
                ]
            }
        ]
    },

    shirt: {
        fields: [
            {
                label: "Neck",
                name: 'shirt_Neck',
                input_type: 'input'
            },
            {
                label: "Chest",
                name: 'shirt_Chest',
                input_type: 'input'
            },
            {
                label: "Waist",
                name: 'shirt_Waist',
                input_type: 'input'
            },
            {
                label: "Shoulder",
                name: 'shirt_Shoulder',
                input_type: 'input'
            },
            {
                label: "Sleeve",
                name: 'shirt_Sleeve',
                input_type: 'input'
            },
            {
                label: "Cuff",
                name: 'shirt_Cuff',
                input_type: 'input'
            },
            {
                label: "Shirt Length",
                name: 'shirt_length',
                input_type: 'input'
            },
            {
                label: "Fit",
                name: 'shirt_Fit',
                input_type: 'select',
                options: ['Slim', 'Regular'
                ]
            },
            {
                label: "Collar",
                name: 'shirt_collar',
                input_type: 'select',
                options: ['Spread', 'Button-down', 'Mandarin'
                ]
            },
            {
                label: "Cuffs",
                name: 'shirt_Cuffs',
                input_type: 'select',
                options: ['Single', 'Double'
                ]
            },
            {
                label: "Pocket",
                name: 'shirt_Pocket',
                input_type: 'select',
                options: ['0', '1', '2'
                ]
            },
            {
                label: "Daman",
                name: 'shirt_Daman',
                input_type: 'select',
                options: ['Gool', 'Sada'
                ]
            }
        ]
    },



    waistcoat: {
        fields: [
            {
                label: "Chest",
                name: 'waistcoat_Chest',
                input_type: 'input'
            },
            {
                label: "Waist",
                name: 'waistcoat_Waist',
                input_type: 'input'
            },
            {
                label: "Shoulder",
                name: 'waistcoat_Shoulder',
                input_type: 'input'
            },
            {
                label: "Length",
                name: 'waistcoat_Length',
                input_type: 'input'
            },
            {
                label: "Neck Depth",
                name: 'waistcoat_Neck_Depth',
                input_type: 'input'
            },
            {
                label: "Buttons",
                name: 'waistcoat_Buttons',
                input_type: 'select',
                options: ['1', '2', '3', '4', '5'
                ]
            },
            {
                label: "Style",
                name: 'waistcoat_Style',
                input_type: 'select',
                options: ['Simple', 'Design'
                ]
            }
        ]
    },


    shirt_pant: {
        combine: ['shirt', 'pant'
        ]
    },

    kameez_shalwar: {
        combine: [
            "kameez",
            "shalwar"
        ]
    },
};
