<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scout".
 *
 * @property integer $id
 * @property integer $userid
 * @property integer $patrolid
 * @property string $name
 * @property string $phone
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Order[] $orders
 * @property Patrol $patrol
 * @property User $user
 * @property Scoutrelation[] $scoutrelations
 */
class Scout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scout';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'patrolid', 'name', 'phone'], 'required'],
            [['userid', 'patrolid', 'created_at', 'updated_at'], 'integer'],
            [['name', 'phone'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'patrolid' => 'Patrolid',
            'name' => 'Name',
            'phone' => 'Phone',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['scoutid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatrol()
    {
        return $this->hasOne(Patrol::className(), ['id' => 'patrolid']);
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
        return $this->hasMany(Scoutrelation::className(), ['scoutid' => 'id']);
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
