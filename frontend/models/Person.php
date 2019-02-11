<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Person".
 *
 * @property int        $PER_Id
 * @property string     $PER_FirstName
 * @property string     $PER_LastName
 * @property string     $PER_FatherFirstName
 * @property string     $PER_AFM
 * @property string     $PER_Email
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Person';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PER_FirstName', 'PER_LastName', 'PER_FatherFirstName','PER_AFM'], 'required'],
            [['PER_FirstName', 'PER_LastName', 'PER_FatherFirstName', 'PER_Email'], 'string'],
            [['PER_AFM'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PER_Id' => 'ID',
            'PER_FirstName' => 'Name',
            'PER_LastName' => 'Lastname',
            'PER_FatherFirstName' => 'Father First Name',
            'PER_AFM' => 'AFM',
            'PER_Email' => 'Email' 
        ];
    }

    
}
