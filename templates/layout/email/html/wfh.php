<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
?>

<html>
    <head>
        <title>WFH Record: Health Status changed</title>
    </head>
    <body>
        <p>
            <?= "-------------WFH Records Application--------------" ?>
            <?= "<br>" ?>
            <?= "-------------------------------------------------------------" ?>
            <?= "<br>" ?>
            <?= "<br>" ?>
            <?= "Dear Sirs/Madams," ?>
            <?= "<br>" ?>
            <?= $this->fetch('content') ?>
            <?= "<br>" ?>
            <?= "______________________________________" ?>
            <?= "<br>" ?>
            <?= "------Developed by Luton (2023)------" ?>
        </p>
    </body>
</html>