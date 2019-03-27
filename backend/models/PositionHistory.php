<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PositionHistory".
 *
 * @property integer $POH_Id
 * @property integer $POH_STH_Id
 * @property integer $POH_POS_Id
 * @property integer $POH_PSE_Id
 */
class PositionHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PositionHistory';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['POH_STH_Id', 'POH_POS_Id'], 'required', 'on' => STATUS::POSITION],
            [['POH_STH_Id', 'POH_POS_Id', 'POH_DEP_Id', 'POH_PSE_Id'], 'integer'],
            // [['POH_POS_Id'], 'checkValid'],
            [['POH_STH_Id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusHistory::className(), 'targetAttribute' => ['POH_STH_Id' => 'STH_Id']],
            [['POH_POS_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Position::className(), 'targetAttribute' => ['POH_POS_Id' => 'POS_Id']],
            [['POH_PSE_Id'], 'unique', 'message'=>'Υπάρχει ήδη καταχώριση στη συγκεκριμένη υπηρεσιακή μεταβολή.', 'targetAttribute'=>['POH_PSE_Id','POH_STH_Id']]
        ];
    }

    /**
     * @inheritdoc
     */
    // public function attributeLabels() {
    //     return [
    //         'POH_Id' => 'Poh  ID',
    //         'POH_STH_Id' => 'Poh  Sth  ID',
    //         'POH_POS_Id' => 'Θέση Ευθύνης',
    //         'POH_DEP_Id' => 'Οργανική Μονάδα',
    //         'POH_PSE_Id' => 'Διαδικασία Τοποθέτησης'
    //         ];
    // }
    
    // static public function search($params)
    // {
    //     $page = Yii::$app->getRequest()->getQueryParam('page');
    //     $limit = Yii::$app->getRequest()->getQueryParam('limit');
    //     $order = Yii::$app->getRequest()->getQueryParam('order');

    //     $search = Yii::$app->getRequest()->getQueryParam('search');

    //     if(isset($search)) {
    //         $params=$search;
    //     }

    //     $limit = isset($limit) ? $limit : 10;
    //     $page = isset($page) ? $page : 1;


    //     $offset = ($page - 1) * $limit;

    //     $query = Employee::find()
    //         ->select(['id', 'name', 'email', 'created_at', 'updated_at'])
    //         ->asArray(true)
    //         ->limit($limit)
    //         ->offset($offset);

    //     if(isset($params['id'])) {
    //         $query->andFilterWhere(['id' => $params['id']]);
    //     }

    //     if(isset($params['created_at'])) {
    //         $query->andFilterWhere(['created_at' => $params['created_at']]);
    //     }
    //     if(isset($params['updated_at'])) {
    //         $query->andFilterWhere(['updated_at' => $params['updated_at']]);
    //     }
    //     if(isset($params['name'])) {
    //         $query->andFilterWhere(['like', 'name', $params['name']]);
    //     }
    //     if(isset($params['email'])){
    //         $query->andFilterWhere(['like', 'email', $params['email']]);
    //     }

    //     if(isset($order)){
    //         $query->orderBy($order);
    //     }

    //     $additional_info = [
    //         'page' => $page,
    //         'size' => $limit,
    //         'totalCount' => (int)$query->count()
    //     ];

    //     return [
    //         'data' => $query->all(),
    //         'info' => $additional_info
    //     ];
    // }

    // public function beforeSave($insert)
    // {
    //     if (parent::beforeSave($insert)) {

    //         if ($this->isNewRecord) {
    //             $this->created_at = date("Y-m-d H:i:s", time());
    //             $this->updated_at = date("Y-m-d H:i:s", time());

    //         } else {

    //             $this->updated_at = date("Y-m-d H:i:s", time());
    //         }
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
