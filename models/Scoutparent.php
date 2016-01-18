<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scoutparent".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property integer $userid
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 * @property Scoutrelation[] $scoutrelations
 */
class Scoutparent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scoutparent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'userid'], 'required'],
            [['name', 'phone'], 'string'],
            [['userid', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'userid' => 'Userid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScoutrelations()
    {
        return $this->hasMany(Scoutrelation::className(), ['parentid' => 'id']);
    }

    public function beforeSave($insert)
    {
       if (parent::beforeSave($insert)) {
          $thisuser =  Yii::$app->user->getId();
          if($insert) {
             $this->created_at = date('Y-m-d H:i:s');
             $this->created_by = $thisuser;
          }
          $this->updated_at = date('Y-m-d H:i:s');
          $this->updated_by = $thisuser;
          return true;
       } else {
          return false;
   }

}
