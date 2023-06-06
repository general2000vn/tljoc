<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application's default view class
 *
 * @link https://book.cakephp.org/4/en/views.html#the-app-view
 */
class AppView extends View
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->loadHelper('Authentication.Identity');
        
        //$this->loadHelper('Form', [
        //    'templates' => 'form_template',
        //]);
        

        /*  ---- SASH icing ------
        $this->loadHelper('Icings/Menu.Menu', [
            'templates' => //Menu add level 1
                [
                    'menu' => '<ul class="side-menu {{extra_class}}" {{attrs}}>{{items}}</ul>',
                    'nest' => '<ul class="slide-menu {{nest_extra_class}}" {{attrs}}>{{items}}</ul>',
                    'item' => '<li class="slide" {{attrs}}>{{link}}{{nest}}</li>',
                    'link' => '<a class="side-menu__item {{link_extra_class}}" data-bs-toggle="slide" href="{{url}}" {{attrs}}><i class="side-menu__icon {{icon}}"></i><span class="side-menu__label">{{label}}</span><i class="angle fe fe-chevron-right"></i></a>',
                    'text' => '<span class="side-menu__label" {{attrs}}>{{label}}</span>'
                ],
            'currentClass' => 'active current',
            'ancestorClass' => 'active ancestor is-expanded',
            
        ]);
        */

        /* ----- BootStrap icing ----- */
        $this->loadHelper('Icings/Menu.Menu', [
            'templates' => //Menu add level 1
                [
                    'menu' => '<ul class="left-menu" {{attrs}}>{{items}}</ul>',
                    'nest' => '<ul class="collapse"{{attrs}}>{{items}}</ul>',
                    'item' => '<li{{attrs}}>{{link}}{{nest}}</li>',
                    'link' => '<a href="{{url}}"{{attrs}}>{{label}}</a>',
                    'text' => '<span{{attrs}}>{{label}}</span>'
                ],
            'currentClass' => 'active',
            'ancestorClass' => 'active',
            //'branchClass' => '',
            //'leafClass' => '',
            
        ]);


    }
}
