<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * Message model
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $text
 * @property integer $status 
 * @property integer $created_at
 * @property integer $updated_at
 */
class Message extends ActiveRecord
{
    const STATUS_CORRECT = 1;
    const STATUS_UNCORRECT = 0;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_CORRECT],
            ['status', 'in', 'range' => [self::STATUS_CORRECT, self::STATUS_UNCORRECT]],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findCorrect()
    {
        return static::find()
            ->joinWith('user')
            ->where(['message.status' => self::STATUS_CORRECT])
            ->orderBy('created_at')
            ->all();
    }

    public static function findUncorrect()
    {
        return static::find()
            ->where(['status' => self::STATUS_UNCORRECT])
            ->orderBy('created_at')
            ->all();
    }

     public function isCorrect()
    {
        return ($this->status == self::STATUS_CORRECT);
    }
}
