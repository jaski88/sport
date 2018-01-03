<?php

namespace app\models\users;

use app\models\EventUsers;
use app\models\Event;

use Yii;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;
    const ROLE_MODERATOR = 2;

    public $authKey;

    public static function tableName() {
        return 'users';
    }

    public function rules() {
        return [
            [['username', 'email'], 'required'],
            [['id', 'role', 'region_id'], 'integer'],
            [['username', 'email'], 'unique'],
            [['coords', 'address', 'fb_id', 'name', 'surname'], 'string', 'max' => 200],
            [['password', 'username', 'token'], 'string', 'max' => 50],
            [['fb_id', 'username', 'email'], 'required', 'on' => ['facebook']],
        ];
    }

    public function login() {
        return Yii::$app->user->login(self::findByUsernameOrEmail($this->username), 3600 * 24 * 30);
    }

    public static function findIdentityByAccessToken($token, $userType = null) {
        return static::findOne(['token' => $token]);
    }

    static public function loginByFb($id) {

        $user = static::findOne(['fb_id' => $id]);
        if ($user !== null) {
            return Yii::$app->user->login($user, 3600 * 24 * 30);
        }

        return false;
    }

    public static function hashPassword($password) {
        return md5($password);
    }

    public function generateToken() {
        $token = md5(time());
        $this->token = $token;
        $this->save(false);

        return $token;
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirm' => 'Confirm password',
            'role' => 'Role',
        ];
    }

    public static function getUserId() {
        return Yii::$app->user->identity->id;
    }

    public static function findIdentity($id) {
        return static::findOne(['id' => $id]);
    }

    public static function findByUsernameOrEmail($username) {
        return static::find()->where(['username' => $username])->orWhere(['email' => $username])->one();
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password) {
        return $this->password === self::hashPassword($password);
    }

    public function toMarkerJson() {
        $coords = explode(";", $this->coords);
        return sprintf('{coords: {lat: %s, lng: %s } }', $coords[0], $coords[1]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents() {
        return $this->hasMany(Event::className(), ['user_id' => 'id']);
    }

    public function getEventUsers() {
        return $this->hasMany(EventUsers::className(), ['user_id' => 'id']);
    }

    public static function hasSigned($eventId) {
        return null != EventUsers::findOne(['user_id' => User::getUserId(), 'event_id' => $eventId]);
    }

    public function isFbUser() {
        return !empty($this->fb_id);
    }

    public static function generatePassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = "";
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass .= $alphabet[$n];
        }
        return $pass;
    }

}
