<?php

namespace app\models;

use yii\base\Model;
use \yii\db\ActiveRecord;

class Notes extends ActiveRecord
{

    public static function tableName()
    {
        return '{{notes}}';
    }

    public function rules()
    {
        return [
            ['title', 'trim'],
            ['title', 'required'],
            ['title', 'unique', 'targetClass' => '\app\models\Notes', 'message' => 'This title has already been taken.'],
            ['title', 'string', 'max' => 100],
            ['text', 'required'],
        ];
    }




}