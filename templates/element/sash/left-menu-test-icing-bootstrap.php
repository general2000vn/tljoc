<?php

use App\Model\Table\RolesTable; ?>

<div class="main-sidemenu">
    <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
        </svg></div>

    <?php

    /* ----------START - template-----------

    $menu['level-1']->addChild('level-2-leaf',
                        ['uri' => ['controller' => 'Ctrller', 'action' => 'act'],
                        'templates' => [
                            'item' => '<li {{attrs}}>{{link}}</li>',
                            'link' => '<a class="slide-item {{extra_class}}" href="{{url}}" {{attrs}}>{{tag_before}}{{label}}{{tag_after}}</a>',
                            ]
                    ]);
    $menu['level-1']->addChild('level-2-branch',
                    ['uri' => ['controller' => 'Ctrller', 'action' => 'act'],
                    'templates' => [
                        'item' => '<li class="sub-slide {{extra_class}}" {{attrs}}>{{link}}</li>',
                        'link' => '<a class="sub-side-menu__item {{extra_class}}" data-bs-toggle="sub-slide" href="{{url}}"><span class="sub-side-menu__label">{{label}}</span><i class="sub-angle fe fe-chevron-right"></i></a>',
                        'nest' => '<ul class="sub-slide-menu {{extra_class}}" {{attrs}}>{{items}}</ul>',
                        ]
                ]);

    $menu['level-2-branch']->addChild('level-3-leaf',
                ['uri' => ['controller' => 'Ctrller', 'action' => 'act'],
                'templates' => [
                    'item' => '<li {{attrs}}>{{link}}</li>',
                    'link' => '<a class="sub-slide-item {{extra_class}}" href="{{url}}" {{attrs}}>{{tag_before}}{{label}}{{tag_after}}</a>',
                    ]
            ]);

    
    $menu->addChild('Category-Separater',['templates' => ['item' => '<li class="sub-category"><h3>{{label}}</h3></li>']]);

    $menu->addChild('level-1-leaf',['uri' => ['controller' => 'Ctrller', 'action' => 'act']
                                    ,'templateVars' => ['link_extra_class' => 'has-link', 'icon' => 'fe fe-layers']
    ]);

    $menu->addChild('level-1-branch',['uri' => ['controller' => 'Ctrller', 'action' => 'act']
                                    ,'templateVars' => ['icon' => 'fe fe-layers']
    ]);

----------END - template----------- */



    $menu = $this->Menu->create('main', []);
    $menu->addChild('e-Offce', []); //separeter

    $menu->addChild('Test1.1', [
        'uri' => 'javascript:void(0)'
    ]);

    $menu->addChild('HR', []); //separeter

    $menu->addChild('Test1.2', [
        'uri' => 'javascript:void(0)',
        'linkAttributes' => [
            // 'data-bs-toggle' => 'collapse',
            // 'data-bs-target' => '#menu-pts',
            // 'role' => 'button',
        ],
        'nestAttributes' => [
            //'id' => 'menu-pts',
        ]
    ]);

    $menu['Test1.2']->addChild(
        'Test1.2.1',
        [
            'uri' => ['controller' => 'HrPts', 'action' => 'add'],
        ]
    );
    $menu['Test1.2']->addChild(
        'Test1.2.2',
        [
            'uri' => ['controller' => 'HrPts', 'action' => 'draft'],
        ]
    );

    $menu['Test1.2']->addChild(
        'Test1.2.3',
        [
            'uri' => ['controller' => 'HrPts', 'action' => 'related'],

        ]
    );


    $menu->addChild('Test1.3', [
        'uri' => 'javascript:void(0)', 'templateVars' => ['icon' => 'fe fe-layers']
    ]);


    $menu['Test1.3']->addChild(
        'Test1.3.1',
        [
            'uri' => ['controller' => 'abc-campaigns', 'action' => 'add'],

        ]
    );

    $menu['Test1.3']->addChild(
        'Test1.3.2',
        [
            'uri' => ['controller' => 'abc-forms', 'action' => 'my'],

        ]
    );
    $menu['Test1.3']['Test1.3.2']->addChild(
        'Test1.3.2.1',
        [
            'uri' => ['controller' => 'abc-forms', 'action' => 'my'],

        ]
    );
    $menu['Test1.3']['Test1.3.2']->addChild(
        'Test1.3.2.2',
        [
            'uri' => ['controller' => 'abc-forms', 'action' => 'my'],

        ]
    );

    $menu['Test1.3']->addChild(
        'Test1.3.3',
        [
            'uri' => ['javascript:void(0)'], 'templateVars' => ['icon' => 'fe fe-layers']
        ]
    );

    $menu['Test1.3']['Test1.3.3']->addChild(
        'Test1.3.3.1',
        [
            'uri' => ['controller' => 'order-reqs', 'action' => 'test2'],

        ]
    );

    $menu['Test1.3']['Test1.3.3']['Test1.3.3.1']->addChild(
        'Test1.3.3.1.1',
        [
            'uri' => ['controller' => 'order-reqs', 'action' => 'test'],

        ]
    );

    $menu['Test1.3']['Test1.3.3']['Test1.3.3.1']->addChild(
        'Test1.3.3.1.2',
        [
            'uri' => ['controller' => 'abc-campaigns', 'action' => 'incomplete'],

        ]
    );

    $menu->addChild('Test1.4', [
        'uri' => 'javascript:void(0)'
    ]);

    echo $this->Menu->render();
    ?>

    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
        </svg></div>
</div>