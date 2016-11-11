<?php
namespace frontend\controllers;

use Yii;
use \yii\web\Controller;

use \common\models\Conference;
use \common\models\Member;
/**
 * Site controller
 */
class IndexController extends Controller
{
    public function actionIndex()
    {
        $list = Conference::find()
            ->having(array('enabled' => 1))
            ->andHaving('start_date > NOW()')
            ->orderBy(array('id' => SORT_DESC))
            ->all();
        return $this->render('index', array('list' => $list));
    }
    
    public function actionArchive()
    {
        $list = Conference::find()
            ->having(array('enabled' => 1))
            ->andHaving('start_date <= NOW()')
            ->orderBy(array('id' => SORT_DESC))
            ->all();
        return $this->render('index', array('list' => $list));
    }
    
    public function actionView($id)
    {
        $conference = Conference::findOne($id);
        if ($conference) {
            return $this->render('view',
                array(
                    'conference' => $conference
                )
            );
        } else {
            throw new \yii\web\NotFoundHttpException('Конференция не найдена');
        }
    }
    
    public function actionSignup($id)
    {
        $conference = Conference::findOne($id);
        if ($conference && $conference->isAvailable()) {
            
            $member = new Member;
            if (isset($_POST['Member'])) {
                $member->attributes = $_POST['Member'];
                $member->conference_id = $id;
                if ($member->save()) {
                    Yii::$app->session->setFlash('success', 'Вы записаны!');
                    return $this->redirect(['index/view', 'id' => $id]);
                }
            }
            return $this->render('signup',
                array(
                    'member' => $member,
                    'conference' => $conference
                )
            );
        } else {
            throw new \yii\web\NotFoundHttpException('Конференция не найдена или недоступна для регистрации');
        }
    }
}
