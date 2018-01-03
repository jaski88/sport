<?php

namespace app\models\users;

use Yii;
use yii\base\Model;

class PasswordRecoveryForm extends Model {

    public $input;
    private $_user = false;

    public function rules() {
        return [
            [['input'], 'required'],
            ['input', 'validateUser'],
        ];
    }

    public function validateUser($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if ($user === null) {
                $this->addError($attribute, 'Incorrect input.');
            }
        }
    }

    public function send() {
        if ($this->validate()) {
            
            $user = $this->getUser();
            
            $token = $user->generateToken( );
            $loginUrl = Yii::$app->urlManager->createAbsoluteUrl(['users/token-login','token' => $token]);
            $message = 'Please use this link to create temporary password '.$loginUrl;
            Yii::$app->mailer->compose()
                    ->setTo($user->email)
                    ->setFrom([Yii::$app->params['no_reply_email'] => 'TeamMates'])
                    ->setSubject('Password recovery')
                    ->setTextBody($message)
                    ->send();

            return true;
        }
        return false;
    }

    public function getUser() {
        if ($this->_user === false) {
            $this->_user = User::findByUsernameOrEmail($this->input);
        }

        return $this->_user;
    }

}
