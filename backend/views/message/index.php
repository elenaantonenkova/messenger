<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Message;

/* @var $this yii\web\View */

$this->title = 'Messages';
?>
<div class="site-index">

    <div class="body-content">
        <table class="table">
            <tbody>
            <?php foreach($messages as $message) {
            ?>
                <tr>
                    <th scope="row"><?= $message->text ?></th>
                    <td>
                            
                        <?php $form = ActiveForm::begin([]); ?>
                        <?= Html::activeHiddenInput($model, 'id', ['value' => $message->id]) ?>
                        <?= Html::activeHiddenInput($model, 'status', ['value' => Message::STATUS_CORRECT]) ?>
                        
                        <?= Html::submitButton('Correct', ['class' => 'btn btn-primary']) ?>
                        <?php ActiveForm::end(); ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>
