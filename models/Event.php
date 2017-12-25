<?php

namespace app\models;

use yii\helpers\Html;
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
            [['user_id', 'public', 'time_start', 'duration', 'active', 'description', 'location', 'event_type', 'people_min', 'people_max', 'region_id'], 'required'],
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
            'time_start' => 'Rozpoczęcie',
            'time_end' => 'Time End',
            'cyclic' => 'Cyclic',
            'active' => 'Active',
            'description' => 'Description',
            'location' => 'Location',
            'event_type' => 'Event Type',
            'people_min' => 'People Min',
            'people_max' => 'People Max',
            'town' => 'Adres',
            'duration' => 'Czas trwania',
            'region_id' => 'Region'
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

    static function findByUser($user_id) {
        $date = date('Y-m-d H:i');
        return Event::find()->where(['user_id' => $user_id]); //->andWhere(['>', 'time_start', $date]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion() {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    public function loadDefault() {
        $this->location = "52.234660180064594;21.00889634393309";
        $this->town = "Marszałkowska 132, 00-008 Warszawa, Poland";
        $this->region_id = 6;
        $this->time_start = date('Y-m-d H:i');
        $this->public = 1;
        $this->duration = 1;
        $this->active = 1;
        $this->people_min = 0;
        $this->people_max = 0;
    }

    public function toClassName() {
        $class = [ 1 => "panel-primary", 2 => "panel-success", 3 => "panel-info", 4 => "panel-warning", 5 => "panel-danger"];
        return $class[$this->event_type];
    }

    public function getUrl() {
        return Html::a('Wiecej', ['events/view', 'id' => $this->id]);
    }

    public function toMarkerJson() {
        $content = $this->time_start . ' <br />' . $this->town . '<br />' . $this->getUrl();
        return sprintf('{id:%s, coords: {lat: %s, lng: %s }, title:\'\', content:\'%s\' }', !empty($this->id) ? $this->id : -1, $this->getLat(), $this->getLng(), $content);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventUsers() {
        return $this->hasMany(EventUsers::className(), ['event_id' => 'id']);
    }

    public function hasMaxUsers() {
        if( $this->people_max == 0 )
        {
            return false;
        }
        
        $total = $this->getEventUsers()->count();
        if (is_string($total)) {
            $total = intval($total);
        }

        return $total >= $this->people_max;
    }
    
    public function switchActive( )
    {
        if ( $this->active == self::STATUS_ACTIVE )
        {
            $this->active = self::STATUS_INACTIVE;
        }
        else
        {
            $this->active = self::STATUS_ACTIVE;
        }
    }
    
    public function isOwner( )
    {
        return User::getUserId() == $this->user_id;
    }
    
    public function needMore( )
    {
        if ( $this->people_min == 0 )
        {
            return 0;
        }
        
        $count = $this->getEventUsers()->count();
        
        return ( $this->getEventUsers()->count() < $this->people_min ) ? $this->people_min - $this->getEventUsers()->count() : 0;
    }
    
    public function freeSlots() 
    {
        if ( $this->people_max == 0 )
        {
            return 0;
        }
        
        return ( $this->getEventUsers()->count() < $this->people_max ) ? $this->people_max - $this->getEventUsers()->count() : 0;
    }

}
