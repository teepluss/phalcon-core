<?php namespace App\Forms\User;

use App\Forms\BaseForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class Create extends BaseForm
{
    public function initialize($entity = null, $options = null)
    {
        // Name
        $firstname = new Text('name', ['class' => 'form-control']);
        $firstname->setLabel('Name');
        $firstname->setFilters(array('striptags', 'string'));
        $firstname->addValidators(array(
            new PresenceOf(array(
                'message' => 'Name is required'
            ))
        ));
        $this->add($firstname);

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'E-mail is required'
            )),
            new Email(array(
                'message' => 'E-mail is not valid'
            ))
        ));
        $this->add($email);

        // Password
        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'Password is required'
            )),
            new StringLength(array(
                'min' => 5,
                'messageMinimum' => 'The password is too short'
            )),
            new Confirmation(array(
               'message' => 'Password doesn\'t match confirmation',
               'with' => 'repeatPassword'
            ))
        ));
        $this->add($password);

        // Confirm Password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Repeat Password');
        $repeatPassword->addValidators(array(
            new PresenceOf(array(
                'message' => 'Confirmation password is required'
            ))
        ));
        $this->add($repeatPassword);

        $agreement = new Check('agree', ['value' => 'yes']);
        $agreement->setLabel('Accept terms and conditions');
        $agreement->addValidators([
            new Identical([
                'value'   => 'yes',
                'message' => 'Terms and conditions must be accepted'
            ])
        ]);

        $this->add($agreement);

        $submit = new Submit('submit');

        $this->add($submit);
    }

}