<?php

namespace app\models;

use Yii; 
use dektrium\user\models\User as BaseUser;
 
class User extends BaseUser
{
   
    public function getIsAdmin()
    {
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        foreach ($role as $item)
            if ($item->name == 'admin')
                return true;
        return false;
    }

    public function getIsLeader()
    {
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        foreach ($role as $item)
            if ($item->name == 'leader')
                return true;
        return false;
    }

    public function getIsParent()
    {
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        foreach ($role as $item)
            if ($item->name == 'parent')
                return true;
        return false;
    }

    public function getIsScout()
    {
        $role = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
        foreach ($role as $item)
            if ($item->name == 'scout')
                return true;
        return false;
    }
}
?>
