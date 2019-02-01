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
 */

$cakeDescription = 'Simple CRM system (test task)';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css') ?>
    <?= $this->Html->css('../fontawesome/css/all.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->script('jquery-3.3.1.min.js') ?>
    <?= $this->Html->script('bootstrap.min.js') ?>
    <?= $this->Html->script('parsley.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="wrapper">
        <div class="row">
            <aside class="col-lg-1">
                <ul>
                    <li>
                        <?= $this->Html->link('Главная', '/', ['class' => 'button']); ?>
                    </li>
                    <li>
                        <?= $this->Html->link('Клиенты', '/clients', ['class' => 'button']); ?>
                    </li>
                    <li>
                        <?= $this->Html->link('Интересы клиента', '/interests', ['class' => 'button']); ?>
                    </li>
                </ul>
            </aside>            
            <div class="content col-lg-11">
                <?= $this->fetch('content') ?>
            </div>
        </div>        
    </div>
    <footer>
        SIMPLE CRM SYSTEM FOOTER
    </footer>
    <?= $this->Html->script('main.js') ?>
</body>
</html>
