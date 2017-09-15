<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 14.09.2017
 * Time: 15:10
 */



namespace frontend\modules\user\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\User;
use yii\web\NotFoundHttpException;

class ProfileController extends Controller
{

    public function actionView($nickname)
    {
        return $this->render('view', [
            'user' => $this->findUser($nickname),
        ]);
    }

    /**
     * @param string $nickname
     * @return User
     * @throws NotFoundHttpException
     */
    private function findUser($nickname)
    {
        if ($user = User::find()->where(['nickname' => $nickname])->orWhere(['id' => $nickname])->one()) {
            return $user;
        }
        throw new NotFoundHttpException();
    }

}