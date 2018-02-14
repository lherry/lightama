<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property string $id ID
 * @property string $priority_id
 * @property string $creation_date Creation date
 * @property string $modification_date Modification date
 * @property string $label Label
 * @property string $description Description
 * @property double $duration Duration
 * @property string $start_date Start date
 * @property string $deadline_date Deadline date
 * @property int $cancelled Cancelled
 *
 * @property Activity[] $activities
 * @property Priority $priority
 * @property TaskMember[] $taskMembers
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['priority_id', 'creation_date', 'modification_date', 'label'], 'required'],
            [['priority_id', 'cancelled'], 'integer'],
            [['creation_date', 'modification_date', 'start_date', 'deadline_date'], 'safe'],
            [['description'], 'string'],
            [['duration'], 'number'],
            [['label'], 'string', 'max' => 80],
            [['priority_id'], 'exist', 'skipOnError' => true, 'targetClass' => Priority::className(), 'targetAttribute' => ['priority_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'priority_id' => Yii::t('app', 'Priority ID'),
            'creation_date' => Yii::t('app', 'Creation Date'),
            'modification_date' => Yii::t('app', 'Modification Date'),
            'label' => Yii::t('app', 'Label'),
            'description' => Yii::t('app', 'Description'),
            'duration' => Yii::t('app', 'Duration'),
            'start_date' => Yii::t('app', 'Start Date'),
            'deadline_date' => Yii::t('app', 'Deadline Date'),
            'cancelled' => Yii::t('app', 'Cancelled'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority()
    {
        return $this->hasOne(Priority::className(), ['id' => 'priority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskMembers()
    {
        return $this->hasMany(TaskMember::className(), ['task_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskQuery(get_called_class());
    }
}
