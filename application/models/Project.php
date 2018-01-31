<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property string $id
 * @property string $creation_date
 * @property string $modification_date
 * @property string $label
 * @property string $name
 * @property string $description
 * @property string $parent_project_id
 *
 * @property Project $parentProject
 * @property Project[] $projects
 * @property ProjectMember[] $projectMembers
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
            [['creation_date', 'modification_date', 'label', 'name'], 'required'],
            [['creation_date', 'modification_date'], 'safe'],
            [['description'], 'string'],
            [['parent_project_id'], 'integer'],
            [['label', 'name'], 'string', 'max' => 80],
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
            'creation_date' => Yii::t('app', 'Creation Date'),
            'modification_date' => Yii::t('app', 'Modification Date'),
            'label' => Yii::t('app', 'Label'),
            'name' => Yii::t('app', 'Name'),
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
    public function getProjectMembers()
    {
        return $this->hasMany(ProjectMember::className(), ['project_Id' => 'id']);
    }
}
