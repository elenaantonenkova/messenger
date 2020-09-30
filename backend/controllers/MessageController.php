<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Message;
use common\models\MessageUpdateStatusForm;

/**
 * User controller
 */
class MessageController extends Controller
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
        $messages = Message::findUncorrect();

        $model = new MessageUpdateStatusForm();
     
        if ($model->load(Yii::$app->request->post()) && $model->updateStatus()) {  

            return $this->refresh();      
        }

        return $this->render('index', [
            'messages' => $messages,
            'model' => $model,
        ]);
    }
}