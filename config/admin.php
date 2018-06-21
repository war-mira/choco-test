<?php

return [

    'sidebar_links' =>
        [
            'admin.dashboard' =>
                [
                    'name' => 'Dashboard',
                    'icon' => 'home'
                ],
            'admin.callbacks.' =>
                [
                    'default' => 'table',
                    'name' => 'Заявки',
                    'icon' => 'import'
                ],
            'admin.orders.' =>
                [
                    'default' => 'table',
                    'name' => 'Заказы',
                    'icon' => 'saved'
                ],
            'admin.notifications.' =>
                [
                    'default' => 'forDate',
                    'name' => 'Уведомления',
                    'icon' => 'phone'
                ],
            'admin.doctors.' =>
                [
                    'default' => 'table',
                    'name' => 'Врачи',
                    'icon' => 'list'
                ],
            'admin.medcenters.' =>
                [
                    'default' => 'table',
                    'name' => 'Медцентры',
                    'icon' => 'list'
                ],
            'admin.skills.' =>
                [
                    'default' => 'table',
                    'name' => 'Специализации',
                    'icon' => 'list'
                ],
            'admin.posts.' =>
                [
                    'default' => 'table',
                    'name' => 'Посты',
                    'icon' => 'text-background'
                ],
            'admin.banner.' =>
                [
                    'name' => 'Баннера',
                    'icon' => 'picture',
                    'children' => [
                        'admin.banner.list' =>
                            [
                                'name' => 'Редактировать',
                                'icon' => 'tasks'
                            ],
                        'admin.banner.statistics' =>
                            [
                                'name' => 'Статистика',
                                'icon' => 'tasks'
                            ],
                    ]
                ],
            'admin.comments.' =>
                [
                    'name' => 'Отзывы',
                    'default' => 'table',
                    'icon' => 'comment',
                    'children' => [
                        'admin.comments.table' => [
                            'name' => 'Список',
                            'icon' => 'tasks'],
                        'admin.comments.statistics.all' => [
                            'name' => 'Общая статистика',
                            'icon' => 'tasks'],
                        'admin.comments.statistics.skills' => [
                            'name' => 'Статистика по спец',
                            'icon' => 'tasks'],
                        'admin.comments.statistics.doctors' => [
                            'name' => 'Статистика по врачам',
                            'icon' => 'tasks'],
                        'admin.comments.statistics.medcenters' => [
                            'name' => 'Статистика по медцентрам',
                            'icon' => 'tasks']
                    ]
                ],
            'admin.page_notifications.' =>
                [
                    'default' => 'table',
                    'name' => 'Оповещения',
                    'icon' => 'bell'
                ],
            'admin.report' =>
                [
                    'icon' => 'signal',
                    'children' => [
                        'admin.report.daily' =>
                            [
                                'name' => 'За день',
                                'icon' => 'tasks'
                            ],
                        'admin.report.doctor' =>
                            [
                                'name' => 'Для врачей',
                                'icon' => 'tasks'
                            ],
                        'admin.medcenter-reports.table' =>
                            [
                                'name' => 'Для медцентров',
                                'icon' => 'tasks'
                            ],
                        'admin.report.monthForm' =>
                            [
                                'name' => 'За месяц',
                                'icon' => 'tasks'
                            ],],
                    'name' => 'Отчет',

                ]

        ]
];