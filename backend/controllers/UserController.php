<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
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

        $query = User::find(['status' => User::STATUS_ACTIVE])
            ->where(['<>','id', Yii::$app->user->getIdentity()->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'username' => SORT_ASC, 
                ]
            ],
        ]);


        $formModel = new UserUpdateRoleForm();

        if(\Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();
            
            $formModel->id = $data['id'];
            $formModel->role = $data['role'];
      

            if ($formModel->updateRole()) {
                return $this->refresh();
            }
            
        }
   

        return $this->render('index', [
            'formModel' => $formModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}