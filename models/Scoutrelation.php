<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scoutrelation".
 *
 * @property integer $id
 * @property integer $parentid
 * @property integer $scoutid
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Scout $scout
 * @property Scoutparent $parent
 */
class Scoutrelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scoutrelation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentid', 'scoutid'], 'required'],
            [['parentid', 'scoutid', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parentid' => 'Parentid',
            'scoutid' => 'Scoutid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScout()
    {
        return $this->hasOne(Scout::className(), ['id' => 'scoutid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Scoutparent::className(), ['id' => 'parentid']);
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

}
