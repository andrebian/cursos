<?php

namespace SONUser;

use SONUser\Controller\IndexController;
use SONUser\Controller\UsersController;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'sonuser-register' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/register',
                    'defaults' => [
                        'controller' => 'SONUser\Controller\Index',
                        'action' => 'register'
                    ]
                ]
            ],
            'sonuser-activate' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/register/activate/:key',
                    'defaults' => [
                        'controller' => 'SONUser\Controller\Index',
                        'action' => 'activate'
                    ]
                ]
            ],
            'sonuser-admin' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/admin[/page/:page]',
                    'constraints' => [
                        'page' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => UsersController::class,
                        'action' => 'index'
                    ]
                ]
            ],
            'sonuser-admin-list' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/admin/users[/page/:page]',
                    'defaults' => [
                        'controller' => UsersController::class,
                        'action' => 'index'
                    ],
                    'constraints' => [
                        'page' => '[0-9]+'
                    ]
                ]
            ],
            'sonuser-admin-new' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/admin/users/new',
                    'defaults' => [
                        'controller' => UsersController::class,
                        'action' => 'new'
                    ]
                ]
            ],
            'sonuser-admin-edit' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/admin/users/edit/:id',
                    'defaults' => [
                        'controller' => UsersController::class,
                        'action' => 'edit'
                    ],
                    'constraints' => [
                        'id' => '[0-9]+'
                    ]
                ]
            ],
            'sonuser-admin-delete' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/admin/users/delete/:id',
                    'defaults' => [
                        'controller' => UsersController::class,
                        'action' => 'delete'
                    ],
                    'constraints' => [
                        'id' => '[0-9]+'
                    ]
                ]
            ]
        ]
    ],
    'controllers' => [
        'invokables' => [
            'SONUser\Controller\Index' => IndexController::class,
            UsersController::class => UsersController::class,
        ]
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/register.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [dirname(__DIR__) . '/src/' . __NAMESPACE__ . '/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ],
    ],
    'data-fixture' => [
        __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
    ],
];
