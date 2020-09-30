<?php

namespace common\models;

use Yii;
use yii\base\Model;
use common\models\Message;

/**
 * MessageUpdateStatusForm is the model behind the user form.
 */
class MessageUpdateStatusForm extends Model
{
    public
        $id,
        $status;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id', 'required'],
            ['status', 'required'],
        ];
    }


    /**
     * UpdateStatus.
     *
     * @return bool whether the message was sent
     */
    public function updateStatus()
    {
        if (!$this->validate()) {
            return null;
        }
   
        $message = Message::findIdentity($this->id);
        $message->status = $this->status;

        return $message->save();

    }
}
