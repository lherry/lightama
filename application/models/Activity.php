<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property string $id
 * @property string $task_id
 * @property string $member_id
 * @property string $creation_date
 * @property string $modification_date
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 * @property double $duration
 * @property int $finished
 *
 * @property Member $member
 * @property Task $task
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'member_id', 'creation_date', 'modification_date', 'start_date', 'end_date', 'duration', 'finished'], 'required'],
            [['id', 'task_id', 'member_id', 'finished'], 'integer'],
            [['creation_date', 'modification_date', 'start_date', 'end_date'], 'safe'],
            [['description'], 'string'],
            [['duration'], 'number'],
            [['id'], 'unique'],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'task_id' => Yii::t('app', 'Task ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'creation_date' => Yii::t('app', 'Creation Date'),
            'modification_date' => Yii::t('app', 'Modification Date'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'description' => Yii::t('app', 'Description'),
            'duration' => Yii::t('app', 'Duration'),
            'finished' => Yii::t('app', 'Finished'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * @inheritdoc
     * @return ActivityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActivityQuery(get_called_class());
    }
}
