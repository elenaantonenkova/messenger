<?php

namespace common\tests\unit\models;

use Yii;
use common\models\Message;
use common\fixtures\UserFixture;

/**
 * Login form test
 */
class MessageTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;


    /**
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function testRevertCharacters()
    {
        $message = new Message([
            'text' => 'Привет! Давно не виделись.',
        ]);

        expect($message->revertCharacters())->equals('Тевирп! Онвад ен ьсиледив.');
    }
}