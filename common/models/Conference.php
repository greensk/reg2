<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "conference".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $created
 * @property integer $enabled
 * @property string $location
 * @property string $start_date
 * @property string $start_time
 *
 * @property Member[] $members
 */
class Conference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'location'], 'string'],
            [['created', 'start_date'], 'safe'],
            [['enabled'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['start_time'], 'string', 'max' => 45],
            [['start_time'], 'date', 'format' => 'HH:mm:ss', 'message' => 'Укажите в формате HH:mm:ss']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => 'Название',
            'description' => 'Описание',
            'created' => 'Дата создания',
            'enabled' => 'Отображается',
            'location' => 'Место проведения',
            'start_date' => 'Дата начала',
            'start_time' => 'Время начала'
        ];
    }
    
    public function isAvailable()
    {
        return $this->enabled && new \DateTime($this->start_date) > new \DateTime();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['conference_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ConferenceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConferenceQuery(get_called_class());
    }
}
