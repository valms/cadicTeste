<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;

$cakeDescription = 'Cadic - Teste Seletivo (Valmar Júnior)';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?=  $this->fetch('title') ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css"/>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css"/>
    <?= $this->Html->css('home.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>
<body>


<div id="btngrp_2" class="btn-group pull-right">
    <a id="zoom_in" class="btn btn-default navbar-btn" href="#" title="Zoom in"><i class="icon-zoom-in"></i></a>
    <a id="zoom_out" class="btn btn-default navbar-btn" href="#" title="Zoom out"><i class="icon-zoom-out"></i></a>
</div>
<?= $this->Form->create(null); ?>
<div class="row">
    <div class="btn-group pull-left" id="btngrp_3">
        <div class="form-inline col-md-12">
            <div class="col-md-5" style="display:inline">

                <?= $this->Form->input('estado_id', array(
                    'type' => 'select',
                    'id' => 'estados',
                    'empty' => 'selecione um estado'))
                ?>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5" style="display:inline">
                <?= $this->Form->input('cidade_id', array(
                    'type' => 'select',
                    'id' => 'cidades',
                    'empty' => 'selecione uma cidade'))
                ?>
            </div>
        </div>
    </div>
</div>
<?= $this->Form->end(); ?>
<div id="mapZone"></div>

<div id="footer">
    <span id="measure"></span>
    <span id="coords"></span>
    <span id="scale"></span>
    <span id="attribution"></span>
</div>

<?= $this->Html->script('jquery-3.2.1.js') ?>
<?= $this->Html->script('bootstrap.js') ?>
<?= $this->Html->script('build_ol.js') ?>
<?= $this->Html->script('proj4.js') ?>
<?= $this->Html->script('maps.js') ?>
</body>
</html>
