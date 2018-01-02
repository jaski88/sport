<?php

namespace app\models\user;

use Yii;
use yii\base\Model;
use app\models\User;

class PasswordForm extends User {

    public $password_old;
    public $password_confirm;
    public $password;
    private $_user;

    public function rules() {
        return [
            // username and password are both required
            [['password_old', 'password', 'password_confirm'], 'required'],
            ['password_confirm', 'confirmPassword'],
            ['password_old', 'validateOldPassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'password' => 'Password',
            'password_confirm' => 'Confirm password',
            'password_old' => 'Old password',
        ];
    }

    public function validateOldPassword($attribute, $params) {

        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password_old)) {
                $this->addError($attribute, 'Incorrect password.');
            }
        }
    }

    public function confirmPassword($attribute, $params) {
        if (!$this->hasErrors()) {

            if ($this->password != $this->password_confirm) {
                $this->addError($attribute, 'Entered passwords are different');
            }
        }
    }

    public function updatePassword() {
        $user = $this->getUser();
        if ($user != NULL && $this->validate()) {
            $user->password = User::hashPassword($this->password);
            $user->save(false);
            return true;
        }
        return false;
    }

    private function getUser() {
        if ($this->_user === NULL) {
            $this->_user = Yii::$app->user->identity;
        }

        return $this->_user;
    }

}
