<?php

namespace common\tests\unit\models;

use Yii;
use common\models\Message;

/**
 * Login form test
 */
class MessageTest extends \Codeception\Test\Unit
{
    public function testRevertCharacters()
    {
        $message = new Message([
            'text' => 'Привет! Давно не виделись.',
        ]);

        expect($message->revertCharacters())->equals('Тевирп! Онвад ен ьсиледив.');
    }
}