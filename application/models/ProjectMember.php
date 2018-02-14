<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_member".
 *
 * @property string $id
 * @property string $project_Id
 * @property string $member_id
 * @property int $owner
 * @property int $enabled
 *
 * @property Project $project
 * @property Member $member
 * @property TaskMember[] $taskMembers
 */
class ProjectMember extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'project_Id', 'member_id', 'owner', 'enabled'], 'required'],
            [['id', 'project_Id', 'member_id', 'owner', 'enabled'], 'integer'],
            [['id'], 'unique'],
            [['project_Id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_Id' => 'id']],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_Id' => Yii::t('app', 'Project  ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'owner' => Yii::t('app', 'Owner'),
            'enabled' => Yii::t('app', 'Enabled'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_Id']);
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
    public function getTaskMembers()
    {
        return $this->hasMany(TaskMember::className(), ['project_has_member_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProjectMemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectMemberQuery(get_called_class());
    }
}
