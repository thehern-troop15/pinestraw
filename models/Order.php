<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property string $name
 * @property integer $scoutid
 * @property string $subdivision
 * @property string $house_number
 * @property string $street_name
 * @property string $city
 * @property string $zip
 * @property string $phone
 * @property string $drop_location
 * @property string $payment_type
 * @property string $check_number
 * @property string $number_bales
 * @property string $order_amount
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Scout $scout
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'scoutid', 'house_number', 'street_name', 'city', 'zip', 'phone', 'payment_type', 'number_bales', 'order_amount'], 'required'],
            [['name', 'subdivision', 'house_number', 'street_name', 'city', 'zip', 'phone', 'drop_location', 'payment_type', 'check_number', 'number_bales', 'order_amount'], 'string'],
            [['scoutid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Customer Name',
            'scoutid' => 'Scoutid',
            'subdivision' => 'Subdivision',
            'house_number' => 'House Number',
            'street_name' => 'Street Name',
            'city' => 'City',
            'zip' => 'Zip',
            'phone' => 'Phone',
            'drop_location' => 'Drop Location',
            'payment_type' => 'Payment Type',
            'check_number' => 'Check Number',
            'number_bales' => 'Number Bales',
            'order_amount' => 'Order Amount',
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

/*
* Autoupdate created_at and updated_at fields.
*/

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
