<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;

/* @var $this yii\web\View */

$this->title = 'Users';
?>
<div class="site-index">

    <div class="body-content">

<?php
        echo yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'username',
                    'format' => 'raw',
                    'filter' => function ($model) {
                        return $model::roles();
                    },
                    'value' => function ($model, $key, $index, $column) {
                        $admin = $model->role === User::ROLE_ADMIN;
                        return \yii\helpers\Html::tag(
                            'span',
                            $model->username,
                            [
                                'class' => 'label label-' . ($admin ? 'danger' : 'success'),
                            ]
                        );

                    }
                ],
                'email',
                'created_at:datetime:Register',
                [
                    'attribute' => 'role',
                    'format' => 'raw',
                    'filter' => function ($model) {
                        return $model::roles();
                    },
                    'filterInputOptions' => [
                        'class' => 'form-control',
                        'prompt' => 'Select'
                    ],
                    'value' => function ($model, $key) {
                        return Html::dropDownList('role', $model->role, $model::roles(),
                            ['onchange' => "
                                $.ajax({
                                    url: \"index\",
                                    type: \"post\",
                                    data: {id: $model->id, role: $(this).val()}, 
                                    success: function(res){
                                        console.log(res);
                                    },
                                });"
                            ]
                        );
                    }
                ],
            ],
        ]);
?>
       
    </div>
</div>
