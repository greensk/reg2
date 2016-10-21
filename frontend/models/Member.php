<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $last_name
 * @property string $first_name
 * @property string $phone
 * @property string $email
 * @property integer $conference_id
 * @property string $reg_date
 *
 * @property Conference $conference
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_name', 'first_name', 'phone', 'email', 'conference_id'], 'required'],
            [['conference_id'], 'integer'],
            [['reg_date'], 'safe'],
            [['last_name', 'first_name', 'phone', 'email'], 'string', 'max' => 45],
            [['conference_id'], 'exist', 'skipOnError' => true, 'targetClass' => Conference::className(), 'targetAttribute' => ['conference_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'conference_id' => 'Conference ID',
            'reg_date' => 'Reg Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConference()
    {
        return $this->hasOne(Conference::className(), ['id' => 'conference_id']);
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
