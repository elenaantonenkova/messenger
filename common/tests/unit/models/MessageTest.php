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
        $message = new Message();
       

        $message->text = 'Привет! Давно не виделись.';
        expect($message->revertCharacters())->equals('Тевирп! Онвад ен ьсиледив.');

        $message->text = 'Welcome)';
        expect($message->revertCharacters())->equals('Emoclew)');

        $message->text = 'Когда-то быЛо!';
        expect($message->revertCharacters())->equals('Адгок-от олЫб!');
    }
}