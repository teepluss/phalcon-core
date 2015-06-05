<?php namespace App\Forms;

use Phalcon\Forms\Form;
use Phalcon\Validation\Message;

abstract class BaseForm extends Form {

    public function errorFirst($name)
    {
        $element = $this->get($name);

        // Get any generated messages for the current element
        $messages = $this->getMessagesFor($element->getName());

        if (count($messages))
        {
            return $this->flash->error($messages[0]);
        }
    }

    public function mergeMessages($messages)
    {
        foreach ($messages as $message)
        {
            $addMessage = new Message($message->getMessage(), $message->getField(), $message->getType());

            $buffer = $this->getMessagesFor($message->getField());

            $buffer->appendMessage($addMessage);
        }
    }

}