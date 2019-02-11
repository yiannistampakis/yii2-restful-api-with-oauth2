<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Person;

/**
 * PersonSearch represents the model behind the search form of `app\models\Person`.
 */
class PersonSearch extends Person
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PER_Id'], 'integer'],
            [['PER_FirstName', 'PER_LastName', 'PER_FatherFirstName', 'PER_AFM', 'PER_Email'], 'safe'],
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
        $query = Person::find();

        // add conditions that should always apply here

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
            'PER_Id' => $this->PER_Id,
            'PER_AFM' => $this->PER_AFM,
            ]);

        $query->andFilterWhere(['like', 'PER_FirstName', $this->PER_FirstName])
            ->andFilterWhere(['like', 'PER_LastName', $this->PER_LastName])
            ->andFilterWhere(['like', 'PER_FatherFirstName', $this->PER_FatherFirstName])
            ->andFilterWhere(['like', 'PER_Email', $this->PER_Email]);

        return $dataProvider;
    }
}
