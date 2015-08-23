<?php

return [

    'frontpage' => [
        
        'show' => true,
        'paginate' => 3
    ],

    'index' => [
    
        'with' => ['destinations', 'topics'],
        'latest' => 'created_at',
        'paginate' => 24,
    ],

    'edit' => [

        'fields' => [
            'file' => [
                'type' => 'file',
            ],
            'title' => [
                'type' => 'text',
                'title' => 'Title',
            ],
            'body' => [
                'type' => 'textarea',
                'title' => 'Body',
            ],
            'url' => [
                'type' => 'url',
                'title' => 'URL',
            ],
            'submit' => [
                'type' => 'submit',
                'title' => 'Add',
            ]
        ],

        'validate' => [
        
            'title' => 'required',
            'url' => 'url',
            'file' => 'image'
        
        ],

    ]

];