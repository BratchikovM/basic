<?php

namespace app\models;

use yii\base\Model;

class Login extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            [['username','password'],'required']
        ];
    }
    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors())
        {
            $user = $this->getUser();
            if(!$user)
            {
                $this->addError($attribute,'Пароль или логин введены неверно');
            }
        }
    }

    public function getUser()
    {
        return User::findOne(['username'=>$this->username]);
    }
}