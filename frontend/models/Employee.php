<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Employee".
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

    
}
