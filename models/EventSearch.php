<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Event;

/**
 * EventSearch represents the model behind the search form about `app\models\Event`.
 */
class EventSearch extends Event
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'public', 'duration', 'cyclic', 'active', 'people_min', 'people_max', 'region_id'], 'integer'],
            [['time_start', 'time_end', 'description', 'location', 'town'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Event::getIncoming();

        // add conditions that should always apply here
         
        if ( isset( $params[ $this->formName() ] ) && isset( $params[ $this->formName() ]['event_type'] ) )
        {
            $event_type = $params[ $this->formName() ]['event_type'];
        }
        else
        {
            $event_type = null;
        }
        
        $this->event_type = $event_type;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'public' => $this->public,
            'time_start' => $this->time_start,
            'duration' => $this->duration,
            'time_end' => $this->time_end,
            'cyclic' => $this->cyclic,
            'active' => $this->active,
            'event_type' => $this->event_type,
            'people_min' => $this->people_min,
            'people_max' => $this->people_max,
        ]);
        
        if ( $this->region_id != 0 )
        {
            $query->andFilterWhere([ 'region_id' => $this->region_id ]);
        }

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'town', $this->town]);
        
        if ( !empty( $event_type) )
        {
            if(is_array($event_type))
            {
                $query->andWhere(['event_type'=>$event_type]);
            }
        }
        
        return $dataProvider;
    }
}
