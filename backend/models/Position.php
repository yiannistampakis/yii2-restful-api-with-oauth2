<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Position".
 *
 * @property integer    $POS_Id
 * @property string     $POS_Name
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Position';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['POS_Name'], 'required'],
            [['POS_Name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */

    // public function attributeLabels() {
    //     return [
    //         'POS_Id' => '',
    //         'POS_Name' => '',
    //     ];
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
