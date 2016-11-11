<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Member;
use common\models\Conference;

/**
 * Site controller
 */
class MembersController extends Controller
{
    public function actionIndex($id)
    {
        $conference = Conference::findOne($id);
        if (!$conference) {
            throw new \yii\web\NotFoundHttpException('Конференция не найдена');
        }
        $list = $conference->getMembers()
            ->orderBy(['last_name' => SORT_ASC, 'first_name' => SORT_ASC])
            ->all();
        return $this->render('index', ['conference' => $conference, 'list' => $list]);
    }
    
    public function actionDelete($id, $confirm = false)
    {
        $member = Member::findOne($id);
        if (!$member) {
            throw new \yii\web\NotFoundHttpException('Участник не найден');
        }
        if ($confirm) {
            $member->delete();
            Yii::$app->session->setFlash('success', 'Запись удалена.');
            return $this->redirect(['members/index', 'id' => $member->conference_id]);
        } else {
            return $this->render('delete', ['member' => $member]);
        }
    }
    
    public function actionEdit($id)
    {
        $member = Member::findOne($id);
        if (!$member) {
            throw new \yii\web\NotFoundHttpException('Участник не найден');
        }
        if (isset($_POST['Member'])) {
            $form = $_POST['Member'];
            $member->attributes = $form;
            if ($member->save()) {
                Yii::$app->session->setFlash('success', 'Изменения сохранены.');
                return $this->redirect(['members/index', 'id' => $member->conference_id]);
            }
        }
        return $this->render('edit', ['member' => $member]);
    }
}
