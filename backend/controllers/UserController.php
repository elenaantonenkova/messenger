<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use backend\models\UserUpdateRoleForm;

/**
 * User controller
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $users = User::findExceptIdentity();

        $model = new UserUpdateRoleForm();
     
        if ($model->load(Yii::$app->request->post()) && $model->updateRole()) {  

            return $this->refresh();      
        }

        return $this->render('index', [
            'users' => $users,
            'model' => $model,
        ]);
    }
}