<?php namespace App\Forms\User;

use App\Forms\BaseForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class Create extends BaseForm {

    public function initialize($entity = null, $options = null)
    {
        $firstname = new Text('firstname');
        $firstname->setLabel('First Name');
        $firstname->setFilters(array('striptags', 'string'));
        $firstname->addValidators(array(
            new PresenceOf(array(
                'message' => 'First Name is required'
            ))
        ));
        $this->add($firstname);

        $lastname = new Text('lastname');
        $lastname->setLabel('Last Name');
        $lastname->setFilters(array('striptags', 'string'));
        $lastname->addValidators(array(
            new PresenceOf(array(
                'message' => 'Last Name is required'
            ))
        ));
        $this->add($lastname);

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

        $submit = new Submit('submit');

        $this->add($submit);
    }

}