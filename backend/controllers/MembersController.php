<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Member;
use common\models\Conference;

/**
 * Members controller
 * 
 * Управление участниками на стороне backend.
 */
class MembersController extends Controller
{
    /**
     * Страница списка участников
     * 
     * @param int $id Номер конференции для вывода.
     */
    public function actionIndex($id)
    {
        // получаем объект конференции
        $conference = Conference::findOne($id);
        
        // если указанная конференция не найдена, кидаем ошибку 404
        if (!$conference) {
            throw new \yii\web\NotFoundHttpException('Конференция не найдена');
        }
        
        // получаем список участников, отсортированные по алфавиту
        $list = $conference->getMembers()
            ->orderBy(['last_name' => SORT_ASC, 'first_name' => SORT_ASC])
            ->all();
            
        // выводим представление с объектом конференции и списком участников
        return $this->render('index', ['conference' => $conference, 'list' => $list]);
    }
    
    /**
     * Страница удаление участника (с подтверждением).
     * 
     * Если пользователь приходит с параметром confirm=true, значит
     * пользователь уже потвердил удаление, можно собственно удалять.
     * Если нет, то выводится запрос подтверждения удаления.
     * 
     * @param int $id номер участника для удаления
     * @param boolean $confirm 
     */
    public function actionDelete($id, $confirm = false)
    {
        // находим объект участника
        $member = Member::findOne($id);
        
        // нельзя удалить участника, если его нет в базе
        if (!$member) {
            throw new \yii\web\NotFoundHttpException('Участник не найден');
        }
        
        if ($confirm) {
            // собственно удаление
            $member->delete();
            
            // сообщение, которое увидит пользователь при следующем открытии страницы
            Yii::$app->session->setFlash('success', 'Запись удалена.');
            
            // переадресуем на список участников конференции
            // (хотя запись удалена из базы, объект $member все еще жив!)
            return $this->redirect(['members/index', 'id' => $member->conference_id]);
        } else {
            // здесь запрос подверждения удаления
            return $this->render('delete', ['member' => $member]);
        }
    }
    
    /**
     * Страница редактирования данных участника
     * 
     * @param int $id номер редактируемого участника
     */
    public function actionEdit($id)
    {
        // получение объекта участника
        $member = Member::findOne($id);
        
        // получаем список активных конференций
        // для выбора конфенеренции, на которую зарегистрирован участник
        $conferenceList = Conference::find()->having('enabled = 1')->all();
        
        if (!$member) {
            throw new \yii\web\NotFoundHttpException('Участник не найден');
        }
        
        // если переданы обновленные данные, передаем их в модель
        if (isset($_POST['Member'])) {
            $form = $_POST['Member'];
            $member->attributes = $form;
            
            // пытаемся сохранить (с валидацией)
            if ($member->save()) {
                // сообщение об успешном сохранении (отобразится после редиректа)
                Yii::$app->session->setFlash('success', 'Изменения сохранены.');
                
                // перенаправляем пользователя на список участника той конференции, на которую участник зарегистрирован
                return $this->redirect(['members/index', 'id' => $member->conference_id]);
            }
        }
        return $this->render('edit', ['member' => $member, 'conferenceList' => $conferenceList]);
    }
    
    public function behaviors()
    {
        return [
            'access' => [
                // контроль доступа
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        // доступ до всех страниц зарегистрированным пользователям
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }
}
