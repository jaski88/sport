<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $public
 * @property string $time_start
 * @property string $time_end
 * @property integer $cyclic
 * @property integer $active
 * @property string $description
 * @property string $location
 * @property integer $event_type
 * @property integer $people_min
 * @property integer $people_max
 * @property string $town
 *
 * @property Users $user
 * @property EventType $eventType
 */
class Event extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'event';
    }

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_PUBLIC = 1;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'public', 'time_start', 'duration', 'active', 'description', 'location', 'event_type', 'people_min', 'people_max','region_id'], 'required'],
            [['user_id', 'public', 'cyclic', 'active', 'event_type', 'people_min', 'people_max'], 'integer'],
            [['time_start', 'time_end'], 'safe'],
            [['description', 'location'], 'string'],
            [['town'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['event_type'], 'exist', 'skipOnError' => true, 'targetClass' => EventType::className(), 'targetAttribute' => ['event_type' => 'id']],
            [['time_start'], 'checkDate'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'public' => 'Public',
            'time_start' => 'Time Start',
            'time_end' => 'Time End',
            'cyclic' => 'Cyclic',
            'active' => 'Active',
            'description' => 'Description',
            'location' => 'Location',
            'event_type' => 'Event Type',
            'people_min' => 'People Min',
            'people_max' => 'People Max',
            'town' => 'Town',
            'duration' => 'Czas trwania'
        ];
    }

    public function getLat() {
        return explode(";", $this->location)[0];
    }

    public function getLng() {
        return explode(";", $this->location)[1];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventType() {
        return $this->hasOne(EventType::className(), ['id' => 'event_type']);
    }

    public function checkDate($attribute, $params) {
        if (!$this->hasErrors()) {
            if (strtotime($this->$attribute) === -1) {
                $this->addError($attribute, 'Please enter date in valid format');
            }
        }
    }

    static function getIncoming() {
        $date = date('Y-m-d H:i');
        return Event::find()->where(['active' => Event::STATUS_ACTIVE, 'public' => Event::STATUS_PUBLIC]); //->andWhere(['>', 'time_start', $date]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion() {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

}
