<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_user_task".
 *
 * @property string $id
 * @property string $project_user_id
 * @property string $task_id
 *
 * @property ProjectUser $projectUser
 * @property Task $task
 */
class ProjectUserTask extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_user_task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_user_id', 'task_id'], 'required'],
            [['project_user_id', 'task_id'], 'integer'],
            [['project_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectUser::className(), 'targetAttribute' => ['project_user_id' => 'id']],
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
            'project_user_id' => Yii::t('app', 'Project User ID'),
            'task_id' => Yii::t('app', 'Task ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUser()
    {
        return $this->hasOne(ProjectUser::className(), ['id' => 'project_user_id']);
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
     * @return ProjectUserTaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectUserTaskQuery(get_called_class());
    }
}
