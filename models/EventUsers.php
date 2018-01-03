<?php

namespace app\models;

use app\models\users\User;

use Yii;

/**
 * This is the model class for table "event_enroll".
 *
 * @property integer $event_id
 * @property integer $user_id
 * @property integer $status
 *
 * @property Event $event
 * @property Users $user
 */
class EventUsers extends \yii\db\ActiveRecord {

    const STATUS_ACTIVE = 1;
    const STATUS_PENDING = 2;
    const STATUS_REMOVED = 3;
    const STATUS_BLOCKED = 4;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'event_enroll';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['event_id', 'user_id', 'status'], 'required'],
            [['event_id', 'user_id', 'status'], 'integer'],
            [['event_id', 'user_id'], 'unique', 'targetAttribute' => ['event_id', 'user_id'], 'message' => 'The combination of Event ID and User ID has already been taken.'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'event_id' => 'Event ID',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent() {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
