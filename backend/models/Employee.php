<?php

namespace app\models;

use Yii;

use yii\base\Model;
// use app\models\Employee;
use app\models\Department;
use app\models\StatusHistory;
use app\models\PlacementHistory;
use app\models\Teacher;

ini_set('max_execution_time', 0);

/**
 * This is the model class for table "Person".
 *
 * @property int        $EMP_Id
 * @property string     $EMP_FirstName
 * @property string     $EMP_LastName
 * @property string     $EMP_FatherFirstName
 * @property string     $EMP_AFM
 * @property string     $EMP_Email
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['EMP_FirstName', 'EMP_LastName', 'EMP_FatherFirstName','EMP_AFM'], 'required'],
            [['EMP_FirstName', 'EMP_LastName', 'EMP_FatherFirstName', 'EMP_Email'], 'string'],
            [['EMP_AFM'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'EMP_Id' => 'Αναγνωριστικό',
            'EMP_FirstName' => 'Όνομα',
            'EMP_LastName' => 'Επίθετο',
            'EMP_FatherFirstName' => 'Πατρώνυμο',
            'EMP_AFM' => 'Α.Φ.Μ',
            'EMP_Email' => 'E-mail' 
        ];
    }

    static public function searchSdap($params)
    {
        // $page = Yii::$app->getRequest()->getQueryParam('page');
        // $limit = Yii::$app->getRequest()->getQueryParam('limit');
        // $order = Yii::$app->getRequest()->getQueryParam('order');

        $search = Yii::$app->getRequest()->getQueryParam('search');

        if(isset($search)) {
            $params=$search;
        }

        $limit = 20000;
        $page = 1;

        $offset = ($page - 1) * $limit;

        /*  Based on Decision Id 12 */

        // $query = Person::find()
        //     ->select(['PER_Id', 'PER_FirstName', 'PER_LastName', 'PER_FatherFirstName', 'PER_AFM', 'PER_Email', 'PLH_DEP_Id'])
        //     ->innerJoin('Employee', 'Employee.EMP_PER_Id = Person.PER_Id')
        //     ->innerJoin('StatusHistory', 'StatusHistory.STH_EMP_Id = Employee.EMP_Id')
        //     ->innerJoin('PlacementHistory', 'StatusHistory.STH_Id = PlacementHistory.PLH_STH_Id')
        //     ->innerJoin('Department', 'PlacementHistory.PLH_DEP_Id = Department.DEP_Id')
        //     ->where(['DEP_DEC_Id' => 12])
        //     ->andWhere(['EMP_Active' => 1])
        //     ->andWhere(['not', ['PER_AFM' => null]])
        //     ->asArray(true)
        //     ->limit($limit)
        //     ->offset($offset);
        
        /**
         * based on Hrm's last placement decision. 
         * Department table on Sdap must be updated with latest Hrm's DEP Ids
         */
      
        // $query = Person::find()
        //     ->select(['PER_Id', 'PER_FirstName', 'PER_LastName', 'PER_FatherFirstName', 'PER_AFM', 'PER_Email', 'PLH_DEP_Id'])
        //     ->innerJoin('Employee', 'Employee.EMP_PER_Id = Person.PER_Id')
        //     ->innerJoin('StatusHistory', 'StatusHistory.STH_EMP_Id = Employee.EMP_Id')
        //     ->innerJoin('PlacementHistory', 'StatusHistory.STH_Id = PlacementHistory.PLH_STH_Id')
        //     ->innerJoin('Department', 'PlacementHistory.PLH_DEP_Id = Department.DEP_Id')
        //     ->innerJoin('Decision', 'Department.DEP_DEC_Id = Decision.DEC_Id')
        //     ->where(['STH_DateTo' => null])
        //     ->andWhere(['DEC_DateTo' => null])
        //     ->andWhere(['EMP_Active' => 1])
        //     ->andWhere(['not', ['PER_AFM' => null]])
        //     ->asArray(true)
        //     ->limit($limit)
        //     ->offset($offset);
        
        // $query = Person::find()
        //     ->select(['PER_Id', 'PER_FirstName', 'PER_LastName', 'PER_FatherFirstName', 'PER_AFM', 'PER_Email', 'PLH_DEP_Id'])
        //     ->innerJoin('Employee', 'Employee.EMP_PER_Id = Person.PER_Id')
        //     ->innerJoin('StatusHistory', 'StatusHistory.STH_EMP_Id = Employee.EMP_Id')
        //     // ->innerJoin('PositionHistory', 'PositionHistory.POH_STH_Id = StatusHistory.STH_Id')
        //     // ->innerJoin('Position', 'Position.POS_Id = PositionHistory.POH_POS_Id')

        //     ->innerJoin('PlacementHistory', 'StatusHistory.STH_Id = PlacementHistory.PLH_STH_Id')
        //     ->innerJoin('Department', 'PlacementHistory.PLH_DEP_Id = Department.DEP_Id')
        //     ->innerJoin('Decision', 'Department.DEP_DEC_Id = Decision.DEC_Id')
        //     ->where(['STH_DateTo' => null])
        //     ->andWhere(['DEC_DateTo' => null])
        //     ->andWhere(['EMP_Active' => 1])
        //     ->andWhere(['not', ['PER_AFM' => null]])
        //     ->asArray(true)
        //     ->limit($limit)
        //     ->offset($offset);
            
        $sql = 'exec api.spGetEmployees';
        $command = \Yii::$app->db
            ->createCommand($sql);
        $resultSet = $command->query();
        // var_dump($resultSet);
        // exit();

        $query = $resultSet->readAll(); 
        // var_dump($empArray);
        // exit();


            // var_dump($query);
            // exit;
        
            // $query = StatusHistory::find()
            // ->select(['STH_EMP_Id', 'POS_Id'])
            // ->innerJoin('PositionHistory', 'PositionHistory.POH_STH_Id = StatusHistory.STH_Id')
            // ->innerJoin('Position', 'Position.POS_Id = PositionHistory.POH_POS_Id')
            // ->where(['STH_EMP_Id' => 2826])
            // ->andwhere(['STH_DateTo' => null])
            // ->asArray(true)
            // ->limit($limit)
            // ->offset($offset);
        
        
        
        if(isset($params['PER_Id'])) {
            $query->andFilterWhere(['PER_Id' => $params['PER_Id']]);
        }

        if(isset($params['PER_AFM'])) {
            $query->andFilterWhere(['PER_AFM' => $params['PER_AFM']]);
        }

        if(isset($params['PER_FirstName'])) {
            $query->andFilterWhere(['like', 'PER_FirstName', $params['PER_FirstName']]);
        }

        if(isset($params['PER_LastName'])) {
            $query->andFilterWhere(['like', 'PER_LastName', $params['PER_LastName']]);
        }
        
        if(isset($params['PER_FatherFirstName'])) {
            $query->andFilterWhere(['like', 'PER_FatherFirstName', $params['PER_FatherFirstName']]);
        }
        
        // if(isset($order)){
        //     $query->orderBy($order);
        // }

        $additional_info = [
            'page' => $page,
            'size' => $limit,
            'totalCount' => count($query)
            // 'totalCount' => (int)$query->count()
        ];

        return [
            'data' => $query,
            // 'data' => $query->all(),
            'info' => $additional_info
        ];
    }

    static public function searchSdapTeacher()
    {
        // $page = Yii::$app->getRequest()->getQueryParam('page');
        // $limit = Yii::$app->getRequest()->getQueryParam('limit');
        // $order = Yii::$app->getRequest()->getQueryParam('order');

        $search = Yii::$app->getRequest()->getQueryParam('search');

        if(isset($search)) {
            $params=$search;
        }

        $limit = 10000;
        $page = 1;

        $offset = ($page - 1) * $limit;

        $query = Person::find()
            ->select(['PER_Id', 'PER_FirstName', 'PER_LastName', 'PER_FatherFirstName', 'PER_AFM', 'PER_Email'])
            ->innerJoin('Teacher', 'Teacher.TEA_PER_Id = Person.PER_Id')
            ->Where(['not', ['PER_AFM' => null]])
            ->asArray(true)
            ->limit($limit)
            ->offset($offset);

        if(isset($params['PER_Id'])) {
            $query->andFilterWhere(['PER_Id' => $params['PER_Id']]);
        }

        if(isset($params['PER_AFM'])) {
            $query->andFilterWhere(['PER_AFM' => $params['PER_AFM']]);
        }

        if(isset($params['PER_FirstName'])) {
            $query->andFilterWhere(['like', 'PER_FirstName', $params['PER_FirstName']]);
        }

        if(isset($params['PER_LastName'])) {
            $query->andFilterWhere(['like', 'PER_LastName', $params['PER_LastName']]);
        }
        
        if(isset($params['PER_FatherFirstName'])) {
            $query->andFilterWhere(['like', 'PER_FatherFirstName', $params['PER_FatherFirstName']]);
        }
        
        // if(isset($order)){
        //     $query->orderBy($order);
        // }

        $additional_info = [
            'page' => $page,
            'size' => $limit,
            'totalCount' => (int)$query->count()
        ];

        return [
            'data' => $query->all(),
            'info' => $additional_info
        ];
    }

    static public function search($params)
    {
        $page = Yii::$app->getRequest()->getQueryParam('page');
        $limit = Yii::$app->getRequest()->getQueryParam('limit');
        $order = Yii::$app->getRequest()->getQueryParam('order');

        $search = Yii::$app->getRequest()->getQueryParam('search');

        if(isset($search)) {
            $params=$search;
        }

        $limit = isset($limit) ? $limit : 10000;
        $page = isset($page) ? $page : 1;


        $offset = ($page - 1) * $limit;

        $query = Person::find()
            ->select(['PER_Id', 'PER_FirstName', 'PER_LastName', 'PER_FatherFirstName', 'PER_AFM', 'PER_Email'])
            ->asArray(true)
            ->limit($limit)
            ->offset($offset);

        if(isset($params['PER_Id'])) {
            $query->andFilterWhere(['PER_Id' => $params['PER_Id']]);
        }

        if(isset($params['PER_AFM'])) {
            $query->andFilterWhere(['PER_AFM' => $params['PER_AFM']]);
        }

        if(isset($params['PER_FirstName'])) {
            $query->andFilterWhere(['like', 'PER_FirstName', $params['PER_FirstName']]);
        }

        if(isset($params['PER_LastName'])) {
            $query->andFilterWhere(['like', 'PER_LastName', $params['PER_LastName']]);
        }
        
        if(isset($params['PER_FatherFirstName'])) {
            $query->andFilterWhere(['like', 'PER_FatherFirstName', $params['PER_FatherFirstName']]);
        }
        
        if(isset($order)){
            $query->orderBy($order);
        }

        $additional_info = [
            'page' => $page,
            'size' => $limit,
            'totalCount' => (int)$query->count()
        ];

        return [
            'data' => $query->all(),
            'info' => $additional_info
        ];
    }

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
