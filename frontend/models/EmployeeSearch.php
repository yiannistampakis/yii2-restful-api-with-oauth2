<?php

namespace app\models;

use Yii;

use yii\base\Model;
use yii\data\ActiveDataProvider;

use app\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form of `app\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EMP_Id'], 'integer'],
            [['EMP_FirstName', 'EMP_LastName', 'EMP_FatherFirstName', 'EMP_AFM', 'EMP_Email'], 'safe'],
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
        $query = Employee::find();

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
            'EMP_Id' => $this->EMP_Id,
            'EMP_AFM' => $this->EMP_AFM,
            ]);

        $query->andFilterWhere(['like', 'EMP_FirstName', $this->EMP_FirstName])
            ->andFilterWhere(['like', 'EMP_LastName', $this->EMP_LastName])
            ->andFilterWhere(['like', 'EMP_FatherFirstName', $this->EMP_FatherFirstName])
            ->andFilterWhere(['like', 'EMP_Email', $this->EMP_Email]);

        return $dataProvider;
    }
}
