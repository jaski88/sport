<?php

namespace app\models;
use Yii;


class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;
    const ROLE_MODERATOR = 2;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'password', 'passwordConfirm'], 'required'],
            [['id', 'role'], 'integer'],
            ['username', 'unique'],
            [['password', 'username'], 'string', 'max' => 50],
            ['passwordConfirm', 'confirmPassword'],
        ];
    }

    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login(self::findByUsername($this->username), 3600 * 24 * 30 );
        }
        return false;
    }

    public static function hashPassword($password) {
        return md5($password);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
        ];
    }

    public $authKey;
    public $passwordConfirm;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null) {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === self::hashPassword($password);
    }

    public function confirmPassword($attribute, $params) {
        if (!$this->hasErrors()) {

            if ($this->password != $this->passwordConfirm) {
                $this->addError($attribute, 'Passwords must be the same');
            }
        }
    }

}
