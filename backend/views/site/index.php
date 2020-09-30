<?php
use yii\helpers\Html;



/* @var $this yii\web\View */

$this->title = 'Messenger';
?>
<div class="site-index">

    <div class="body-content">
        <h1><?= Html::a('Users', ['user/index']) ?></h1>
        <h1><?= Html::a('Messages', ['message/index']) ?></h1>
    </div>
</div>
