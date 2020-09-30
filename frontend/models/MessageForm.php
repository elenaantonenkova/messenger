<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Message;

/**
 * MessageForm is the model behind the message form.
 */
class MessageForm extends Model
{
    public $text;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // text are required
            ['text', 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'text' => 'Your message',
        ];
    }

    /**
     * Send message.
     *
     * @return bool whether the message was sent
     */
    public function send()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $message = new Message();
        $message->text = $this->text;
        $message->user_id = Yii::$app->user->id;

        return $message->save();

    }
}
