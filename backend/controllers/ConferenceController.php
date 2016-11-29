<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\Conference;

/**
 * Site controller
 */
class ConferenceController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }
    
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $list = Conference::find()->orderBy(['created' => SORT_DESC])->all();
        return $this->render('index', ['list' => $list]);
    }

    public function actionAdd()
    {
        $conference = new Conference;
        $conference->enabled = 1;
        
        if (isset($_POST['Conference'])) {
            $form = $_POST['Conference'];
            $conference->attributes = $form;
            if ($conference->save()) {
                Yii::$app->session->setFlash('success', 'Изменения сохранены.');
                return $this->redirect(['conference/index']);
            }
        }
        return $this->render('edit', ['conference' => $conference]);
    }

    public function actionEdit($id)
    {
        $conference = Conference::findOne($id);
        if ($id === null) {
            throw new \yii\web\NotFoundHttpException('Конференция не найдена');
        }
        if (isset($_POST['Conference'])) {
            
            if (isset($_POST['delete'])) {
                $conference->delete();
                Yii::$app->session->setFlash('success', 'Запись удалена.');
                return $this->redirect(['conference/index']);
            } else {
                $form = $_POST['Conference'];
                $conference->attributes = $form;
                if ($conference->save()) {
                    Yii::$app->session->setFlash('success', 'Изменения сохранены.');
                    return $this->redirect(['conference/index']);
                }
            }
        }
        return $this->render('edit', ['conference' => $conference]);
    }
}
