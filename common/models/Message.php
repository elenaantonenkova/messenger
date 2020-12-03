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

    /**
     *  Revert message text
     */
    public function revertCharacters()
    {
        mb_regex_encoding('utf-8');
        mb_internal_encoding('utf-8');

        if ($partList = preg_split("/(\w+)|([^\w])|(\s+)/u", $this->text, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE)) {
    
            $result = '';

            foreach ($partList as $part)
            {
                if (preg_match("/\w+/u", $part)) {
                    
                    $rev = '';
                    $revUp = '';
                    $upper = array();

                    for ($i = mb_strlen($part, 'utf-8'); $i >= 0; $i--) {

                        $chr = mb_substr($part, $i, 1, 'utf-8');
                        $rev .= $chr;

                        if(mb_strtolower($chr, 'utf-8') != $chr) {
                            $upper[] = $i;
                        }       
                    }

                    $rev = mb_strtolower($rev, 'utf-8');

                    for ($i = 0;  $i <= mb_strlen($rev, 'utf-8'); $i++) {

                        if (in_array($i, $upper)) {
                            $chr = mb_substr($rev, $i, 1, 'utf-8');    
                            $chr = mb_strtoupper($chr, 'utf-8');
                        } else {
                            $chr = mb_substr($rev, $i, 1, 'utf-8');
                        }

                        $revUp .= $chr;
                    }

                    $result .= $revUp;

                } else {
                    $result .= $part;
                }
            }

            return $result;
        }

        return $this->text;
    }

}
