<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\MessageForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Message;

$this->title = 'Messenger';
?>
<div class="site-index">
    <div class="message">
    <?php
    foreach ($messages as $message) {
    ?>
        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <?php
                    if($message->user->isAdmin()) {
                        echo "<span style='color: #8bc040; font-weight: bold'>" . $message->user->username . "</span>";
                    } else {
                        echo $message->user->username;
                    }
                ?>
                <?php
                    if ($message->isCorrect()) {
                        echo "<div style='padding: 10px 20px; border-radius: 10px; border: 1px solid #9d9d9d'>" . $message->text . "</div>";
                    } else {
                        echo "<div style='padding: 10px 20px; border-radius: 10px; border: 1px solid #de5f66'>" . $message->text . "</div>";
                    }
                ?>
                <div class="pull-right" style="margin: 4px 0 0 20px">
                <?php
                    if($user && $user->isAdmin() && $message->isCorrect()) {
                        $form = ActiveForm::begin(['id' => 'MessageUpdateStatusForm']);
                        echo Html::activeHiddenInput($messageModel, 'id', ['value' => $message->id]); 
                        echo Html::activeHiddenInput($messageModel, 'status', ['value' => Message::STATUS_UNCORRECT]);
                        
                        echo Html::submitButton('Ban', ['class' => 'btn btn-warning', 'name' => 'ban-button']);
                        ActiveForm::end();
                    }
                ?>
                </div>
                <p class="pull-right"><?=Yii::$app->formatter->asRelativeTime($message->created_at, 'now') ?></p>
            </div>
            
        </div>
    <?php
    }
    ?>

    <?php
    if (!Yii::$app->user->isGuest) {
    ?>
        <div class="row">
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-message']); ?>

                    <?= $form->field($model, 'text')->textInput(['autofocus' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Send', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    <?php
    }
    ?>
    </div>
</div>
