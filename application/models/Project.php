<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property string $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $label
 * @property string $description
 * @property string $parent_project_id
 *
 * @property Project $parentProject
 * @property Project[] $projects
 * @property ProjectUser[] $projectUsers
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'label'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['parent_project_id'], 'integer'],
            [['label'], 'string', 'max' => 80],
            [['parent_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['parent_project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'label' => Yii::t('app', 'Label'),
            'description' => Yii::t('app', 'Description'),
            'parent_project_id' => Yii::t('app', 'Parent Project ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'parent_project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['parent_project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUsers()
    {
        return $this->hasMany(ProjectUser::className(), ['project_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }
}
