<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Signup;
use app\models\Login;
use app\models\Notes;
use yii\data\Pagination;

class SiteController extends Controller
{



    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        if(!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
    }

    public function actionSignup()
        {
            $model = new Signup();

            if ($model->load(Yii::$app->request->post())) {
                if ($user = $model->signup()) {
                    return $this->goHome();
                }
            }

            return $this->render('signup', ['model' => $model]);
        }

    public function actionLogin()
    {
          if(!Yii::$app->user->isGuest)
          {
              return $this->goHome();
          }
          $login_model = new Login();
          if( Yii::$app->request->post('Login'))
          {
              $login_model->attributes = Yii::$app->request->post('Login');
              if($login_model->validate())
              {
                  Yii::$app->user->login($login_model->getUser());
                  return $this->goHome();
              }
          }
          return $this->render('login',['login_model'=>$login_model]);
    }

    public function actionList()
    {
        $userId = Yii::$app->user->identity->getId();
        $query = Notes::find()->where('userid = :id', [':id' => $userId])->select('title, text');
        $pages = new Pagination(['totalCount'=> $query->count(), 'pageSize' => '12']);
        $notes = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('list', compact('notes', 'pages'));
    }

    public function actionNote()
    {
        $title = \Yii::$app->request->get('title');
        $note = Notes::findOne($title);
        $note->load(Yii::$app->request->post());
        $note->save();

        return $this->render('note', compact('note'));
    }

    public function actionCreate()
    {
        $data = new Notes();
        $data->userid = Yii::$app->user->identity->getId();
        $data->load(Yii::$app->request->post());
        $data->save();

        return $this->render('create', ['data' => $data]);
    }
}