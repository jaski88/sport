<?php

namespace app\models\users;

use Yii;

class RegisterForm extends User {

    public $password_confirm;
    private $_user = false;

    public function rules() {
        return [
            [['username', 'email', 'password', 'password_confirm'], 'required'],
            ['email', 'email'],
            [['username','password'], 'string','min' => 5],
            [['username','password'], 'unique'],
            ['password_confirm', 'confirmPassword'],
        ];
    }

    public function confirmPassword($attribute, $params) {
        if (!$this->hasErrors()) {
            if ($this->password != $this->password_confirm) {
                $this->addError($attribute, 'Passwords must be the same');
            }
        }
    }

    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

}
