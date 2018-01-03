<?php

namespace app\models\users;

use Yii;
use yii\data\ActiveDataProvider;
use yii\base\Model;

class UserSearch extends User {

    public function rules() {
        return [
            ['username', 'required'],
            ['username', 'string', 'min' => 3],
            ['username', 'safe'],
        ];
    }

    public function scenarios() {
        return Model::scenarios();
    }

    public function search($params) {
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->load($params) || !$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->orFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
