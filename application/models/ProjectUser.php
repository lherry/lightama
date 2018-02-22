<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_user".
 *
 * @property string $id
 * @property string $project_id
 * @property string $user_id
 * @property int $ownered
 * @property int $enabled
 *
 * @property Project $project
 * @property User $user
 * @property ProjectUserTask[] $projectUserTasks
 */
class ProjectUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'user_id', 'ownered', 'enabled'], 'required'],
            [['project_id', 'user_id'], 'integer'],
            [['ownered', 'enabled'], 'string', 'max' => 4],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'project_id' => Yii::t('app', 'Project ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'ownered' => Yii::t('app', 'Ownered'),
            'enabled' => Yii::t('app', 'Enabled'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUserTasks()
    {
        return $this->hasMany(ProjectUserTask::className(), ['project_user_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProjectUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectUserQuery(get_called_class());
    }
}
