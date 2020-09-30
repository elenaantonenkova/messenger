<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */

$this->title = 'Users';
?>
<div class="site-index">

    <div class="body-content">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Register</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($users as $user) {
                $model->role = $user->role;
            ?>
                <tr>
                    <th scope="row"><?= $user->username ?></th>
                    <td><?= $user->email; ?></td>
                    <td>
                            
                        <?php $form = ActiveForm::begin([]); ?>
                        <?= Html::activeHiddenInput($model, 'id', ['value' => $user->id]) ?>
                        <?= $form->field($model, 'role')->dropDownList(User::roles())->label(false) ?>
                        
                        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                        <?php ActiveForm::end(); ?>
                    </td>
                    <td><?= Yii::$app->formatter->asDateTime($user->created_at, 'medium') ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>

    </div>
</div>
