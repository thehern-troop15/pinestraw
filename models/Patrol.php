<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patrol".
 *
 * @property integer $id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Scout[] $scouts
 */
class Patrol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patrol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
            [['created_at', 'updated_at'], 'integer']
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScouts()
    {
        return $this->hasMany(Scout::className(), ['patrolid' => 'id']);
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
