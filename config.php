<?php
/**
 * Ambika Decoration & Party Plot - Core Configuration
 */

// Business Core Details
define('SITE_NAME', 'Ambika Decoration & Party Plot');
define('SITE_TAGLINE', 'Royal Event Decorators & Open Lawn Venue');
// Primary Contact Line 1
define('BUSINESS_PHONE_1', '+91 75670 49869');
define('BUSINESS_PHONE_1_RAW', '+917567049869');
define('WHATSAPP_NUMBER_1', '917567049869');

// Secondary Contact Line 2
define('BUSINESS_PHONE_2', '+91 99248 37197');
define('BUSINESS_PHONE_2_RAW', '+919924837197');
define('WHATSAPP_NUMBER_2', '919924837197');

// Default fallbacks
define('BUSINESS_PHONE', BUSINESS_PHONE_1);
define('BUSINESS_PHONE_RAW', BUSINESS_PHONE_1_RAW);
define('WHATSAPP_NUMBER', WHATSAPP_NUMBER_1);

define('INSTAGRAM_HANDLE_1', '@ambika_decoration');
define('INSTAGRAM_URL_1', 'https://instagram.com');

define('INSTAGRAM_HANDLE_2', '@pooja_farm_ambika');
define('INSTAGRAM_URL_2', 'https://instagram.com');

define('INSTAGRAM_HANDLE', INSTAGRAM_HANDLE_1);
define('INSTAGRAM_URL', INSTAGRAM_URL_1);
define('LOCATION_TEXT', 'Ambika Party Plot & Lawn, Main Ring Road');
define('OFFICE_HOURS', '10:00 AM – 10:00 PM (Open All 7 Days)');

// Dynamic Metrics
$metrics = [
    ['number' => 500, 'label' => 'Grand Weddings Managed'],
    ['number' => 2500, 'label' => 'Guest Capacity Lawn'],
    ['number' => 10, 'label' => 'Years of Decor Excellence']
];

// Catering Menu Categories & Items
$catering_menu = [
    'gujarati' => [
        'title' => 'Royal Gujarati & Rajasthani',
        'icon' => 'fa-solid fa-bowl-food',
        'items' => [
            ['name' => 'Kaju Draksh Undhiyu & Puri', 'desc' => 'Traditional winter dish cooked with mixed winter veggies, dry fruits, and aromatic spices.', 'tag' => 'Pure Veg'],
            ['name' => 'Gujarati Kadhi & Saffron Pulav', 'desc' => 'Sweet and tangy tempered yogurt kadhi served with basmati saffron rice.', 'tag' => 'Pure Veg'],
            ['name' => 'Dal Baati Churma (Rajasthani)', 'desc' => 'Baked wheat balls dipped in pure desi ghee served with spicy panchmel dal and sweet churma.', 'tag' => 'Pure Veg'],
            ['name' => 'Khandvi & Patra Farsan Platter', 'desc' => 'Freshly tempered gram flour rolls with mustard seeds, sesame, and fresh coconut garnishing.', 'tag' => 'Pure Veg']
        ]
    ],
    'north-indian' => [
        'title' => 'North Indian & Chinese',
        'icon' => 'fa-solid fa-fire-burner',
        'items' => [
            ['name' => 'Paneer Lababdar / Shahi Paneer', 'desc' => 'Cottage cheese cubes simmered in creamy tomato onion gravy with butter and kasturi methi.', 'tag' => 'Pure Veg'],
            ['name' => 'Dal Makhani (24-Hour Slow Cooked)', 'desc' => 'Rich black lentils slow-cooked overnight with cream, white butter, and aromatic spices.', 'tag' => 'Pure Veg'],
            ['name' => 'Live Tandoori Roti & Naan Counter', 'desc' => 'Butter Naan, Garlic Naan, Missi Roti, and Laccha Paratha served fresh from clay oven.', 'tag' => 'Live Counter'],
            ['name' => 'Hakka Noodles & Manchurian Dry', 'desc' => 'Wok-tossed noodles with crisp vegetables and vegetable dumpling balls in tangy sauce.', 'tag' => 'Indo-Chinese']
        ]
    ],
    'live-counters' => [
        'title' => 'Live Food Counters',
        'icon' => 'fa-solid fa-shop',
        'items' => [
            ['name' => 'Delhi Dahi Bhalla & Pani Puri Counter', 'desc' => '5 flavors of mineral water pani puri with soft creamy dahi vada and pomegranate seeds.', 'tag' => 'Live Counter'],
            ['name' => 'Woodfired Italian Pizza & Pasta Bar', 'desc' => 'Custom pasta (Penne/Fettuccine) in Alfredo/Arrabbiata sauce with exotic veggies.', 'tag' => 'Live Counter'],
            ['name' => 'Live Pav Bhaji & Tawa Pulav', 'desc' => 'Hot buttery bhaji on big iron tawa served with soft toasted pavs and lemon wedges.', 'tag' => 'Live Counter'],
            ['name' => 'South Indian Dosa & Uttapam Station', 'desc' => 'Crispy Masala Dosa, Paper Dosa, and Onion Uttapam served with 3 coconut chutneys and sambar.', 'tag' => 'Live Counter']
        ]
    ],
    'sweets-beverages' => [
        'title' => 'Sweets & Mocktails',
        'icon' => 'fa-solid fa-ice-cream',
        'items' => [
            ['name' => 'Live Jalebi & Rabdi Counter', 'desc' => 'Crispy hot saffron jalebis fried in pure ghee paired with thick chilled rabdi.', 'tag' => 'Signature Sweet'],
            ['name' => 'Sitaphal & Kesar Pista Basundi', 'desc' => 'Rich condensed milk dessert infused with real custard apple pulp and saffron pista shavings.', 'tag' => 'Signature Sweet'],
            ['name' => 'Exotic Welcome Drinks & Mocktails', 'desc' => 'Blue Lagoon, Virgin Mojito, Mango Mastani, Fresh Guava Chilli, and Roasted Masala Chaas.', 'tag' => 'Live Beverage'],
            ['name' => 'Ice Cream Sundae & Dryfruit Counter', 'desc' => 'Assorted gourmet ice creams topped with chocolate fountains, nuts, and fresh berries.', 'tag' => 'Dessert Station']
        ]
    ]
];
