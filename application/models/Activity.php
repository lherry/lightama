<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property string $id
 * @property string $task_id
 * @property string $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $start_date
 * @property string $end_date
 * @property string $description
 * @property double $duration
 * @property int $finished
 *
 * @property Task $task
 * @property User $user
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
            [['task_id', 'user_id', 'created_at', 'updated_at', 'start_date', 'end_date', 'duration', 'finished'], 'required'],
            [['task_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at', 'start_date', 'end_date'], 'safe'],
            [['description'], 'string'],
            [['duration'], 'number'],
            [['finished'], 'string', 'max' => 4],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
