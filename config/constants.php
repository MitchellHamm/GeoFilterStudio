<?php
return [
    'place_order' => [
        'required_fields' => [
            ['label' => 'What type of event are you having?', 'name' => 'event_type', 'value' => '', 'rows' => 3],
            ['label' => 'What is the theme?', 'name' => 'event_theme', 'value' => '', 'rows' => 3],
            ['label' => 'What text would you like on the filter?', 'name' => 'filter_text', 'value' => '', 'rows' => 3],
            ['label' => 'What colors would you like the filter to be?', 'name' => 'filter_colors', 'value' => '', 'rows' => 3],
        ],

        'optional_fields' => [
            ['checkbox' => [
                'label' => 'I would like to add custom imagery', 'name' => 'filter_imagery_toggle'],
             'textArea' => [
                 'label' => 'What imagery?', 'name' => 'filter_imagery', 'value' => '', 'rows' => 3
            ]],
        ],

        'additional_comments' => ['label' => 'Additional comments?', 'name' => 'additional_comments', 'value' => '', 'rows' => 4],

        'field_constraints' => [
            'user_id'           => 'Required',
            'event_type'        => 'Required|Min:2|Max:255',
            'event_theme'       => 'Required|Min:2|Max:255',
            'filter_text'       => 'Required|Min:2|Max:255',
            'filter_colors'     => 'Required|Min:2|Max:255',
            'filter_imagery'    => 'Min:2|Max:255',
        ],

        'referrals' => [
            ['name' => 'facebook_referral', 'label' => 'Facebook'],
            ['name' => 'google_referral', 'label' => 'Google'],
            ['name' => 'instagram_referral', 'label' => 'Instagram'],
            ['name' => 'friend_referral', 'label' => 'Friend'],
            ['name' => 'reddit_referral', 'label' => 'Reddit'],
            ['name' => 'pintrest_referral', 'label' => 'Pintrest'],
            ['name' => 'pet_referral', 'label' => 'My Pet'],
            ['name' => 'twitter_referral', 'label' => 'Twitter'],
            ['name' => 'weddingwire_referral', 'label' => 'Wedding Wire'],
            ['name' => 'other_referral', 'label' => 'Other'],
        ],
    ],
    'create_account' => [
        'required_fields' => [
            ['label' => 'Email', 'input_type' => 'email', 'placeholder' => 'example@domain.com', 'name' => 'email', 'value' => ''],
            ['label' => 'Password', 'input_type' => 'password', 'placeholder' => '*********', 'name' => 'password', 'value' => ''],
        ],

        'field_constraints' => [
            'email'     => 'Required|Between:3,64|Email|Unique:users',
            'password'  => 'Required|Between:8,64',
        ],
    ],

    'login' => [
        'required_fields' => [
            ['label' => 'Email', 'input_type' => 'email', 'placeholder' => 'example@domain.com', 'name' => 'email', 'value' => ''],
            ['label' => 'Password', 'input_type' => 'password', 'placeholder' => '*********', 'name' => 'password', 'value' => ''],
        ],
    ],

    'my_team' => [
        'field_constraints' => [
            'name' => 'Required|Min:3|Max:255',
        ],
    ],

    'account' => [
        //Tabs available to every user
        'tabs' => [

            /*'change-password' => [
                'name' => 'Change Password', 'route' => 'account.index', 'route_params' => 'change-password', 'class' => 'list-group-item'
            ],*/
        ],
        
        'user_tabs' => [
            'home' => [
                'name' => 'Home', 'route' => 'account.index', 'route_params' => 'home', 'class' => 'list-group-item'
            ],
            'order' => [
                'name' => 'Order Geofilter', 'route' => 'account.index', 'route_params' => 'order', 'class' => 'list-group-item'
            ],
            'existing-orders' => [
                'name' => 'Existing Orders', 'route' => 'account.index', 'route_params' => 'existing-orders', 'class' => 'list-group-item'
            ],
        ],
        'designer_tabs' => [
            'home' => [
                'name' => 'Home', 'route' => 'account.index', 'route_params' => 'home', 'class' => 'list-group-item'
            ],
            'my-designs' => [
                'name' => 'My Designs', 'route' => 'account.index', 'route_params' => 'my-designs', 'class' => 'list-group-item'
            ],
        ],
        'manager_tabs' => [
            'home' => [
                'name' => 'Home', 'route' => 'account.index', 'route_params' => 'home', 'class' => 'list-group-item'
            ],
            'assign-designs' => [
                'name' => 'Assign Designs', 'route' => 'account.index', 'route_params' => 'assign-designs', 'class' => 'list-group-item'
            ],
            'my-team' => [
                'name' => 'My Team', 'route' => 'account.index', 'route_params' => 'my-team', 'class' => 'list-group-item'
            ],
            'designer-reports' => [
                'name' => 'Designer Reports', 'route' => 'account.index', 'route_params' => 'designer-reports', 'class' => 'list-group-item'
            ],
        ],
        'admin_tabs' => [
            'home' => [
                'name' => 'Home', 'route' => 'account.index', 'route_params' => 'home', 'class' => 'list-group-item'
            ],
            'user-roles' => [
                'name' => 'User Roles', 'route' => 'account.index', 'route_params' => 'user-roles', 'class' => 'list-group-item'
            ],
            'designer-reports' => [
                'name' => 'Designer Reports', 'route' => 'account.index', 'route_params' => 'designer-reports', 'class' => 'list-group-item'
            ],
        ],
        'developer_tabs' => [
            'home' => [
                'name' => 'Home', 'route' => 'account.index', 'route_params' => 'home', 'class' => 'list-group-item'
            ],
            'order' => [
                'name' => 'Order Geofilter', 'route' => 'account.index', 'route_params' => 'order', 'class' => 'list-group-item'
            ],
            'existing-orders' => [
                'name' => 'Existing Orders', 'route' => 'account.index', 'route_params' => 'existing-orders', 'class' => 'list-group-item'
            ],
            'my-designs' => [
                'name' => 'My Designs', 'route' => 'account.index', 'route_params' => 'my-designs', 'class' => 'list-group-item'
            ],
            'assign-designs' => [
                'name' => 'Assign Designs', 'route' => 'account.index', 'route_params' => 'assign-designs', 'class' => 'list-group-item'
            ],
            'my-team' => [
                'name' => 'My Team', 'route' => 'account.index', 'route_params' => 'my-team', 'class' => 'list-group-item'
            ],
            'designer-reports' => [
                'name' => 'Designer Reports', 'route' => 'account.index', 'route_params' => 'designer-reports', 'class' => 'list-group-item'
            ],
            'user-roles' => [
                'name' => 'User Roles', 'route' => 'account.index', 'route_params' => 'user-roles', 'class' => 'list-group-item'
            ],
        ],
    ],

    'user' => [
        'attributes' => [
            ['label' => 'First Name', 'input_type' => 'text', 'placeholder' => 'First Name', 'name' => 'first_name', 'value' => ''],
            ['label' => 'Last Name', 'input_type' => 'text', 'placeholder' => 'Last Name', 'name' => 'last_name', 'value' => ''],
            ['label' => 'Phone Number', 'input_type' => 'text', 'placeholder' => '555-555-5555', 'name' => 'phone_number', 'value' => ''],
            ['label' => 'Email', 'input_type' => 'email', 'placeholder' => 'example@domain.com', 'name' => 'email', 'value' => ''],
        ],
    ],
];