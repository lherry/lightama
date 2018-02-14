<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task_member".
 *
 * @property string $id
 * @property string $task_id
 * @property string $project_has_member_id
 *
 * @property ProjectMember $projectHasMember
 * @property Task $task
 */
class TaskMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'project_has_member_id'], 'required'],
            [['id', 'task_id', 'project_has_member_id'], 'integer'],
            [['id'], 'unique'],
            [['project_has_member_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectMember::className(), 'targetAttribute' => ['project_has_member_id' => 'id']],
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
            'project_has_member_id' => Yii::t('app', 'Project Has Member ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectHasMember()
    {
        return $this->hasOne(ProjectMember::className(), ['id' => 'project_has_member_id']);
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
     * @return TaskMemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskMemberQuery(get_called_class());
    }
}
