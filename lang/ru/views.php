<?php

return [
    'task' => [
        'fields' => [
            'name' => 'Имя',
            'description' => 'Описание задачи',
            'status_id' => 'Статус задачи',
            'assigned_to_id' => 'Исполнитель',
            'labels' => 'Метки',
        ],
        'pages' => [
            'create' => [
                'submit' => 'Создать задачу',
                'title' => 'Создать задачу',
            ],
            'edit' => [
                'submit' => 'Изменить задачу',
                'title' => 'Изменить задачу',
            ]
        ]
    ],
    'status' => [
        'fields' => [
            'name' => 'Имя',
            'description' => 'Описание статуса',
        ],
        'pages' => [
            'create' => [
                'submit' => 'Создать статус',
                'title' => 'Создать статус',
            ],
            'edit' => [
                'submit' => 'Изменить статус',
                'title' => 'Изменить статус',
            ]
        ]
    ],
    'label' => [
        'fields' => [
            'name' => 'Имя',
            'description' => 'Описание метки',
        ],
        'pages' => [
            'create' => [
                'submit' => 'Создать статус',
                'title' => 'Создать статус',
            ],
            'edit' => [
                'submit' => 'Изменить статус',
                'title' => 'Изменить статус',
            ],
        ],
    ],
];