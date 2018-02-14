<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "member".
 *
 * @property string $id
 * @property string $creation_date
 * @property string $modification_date
 * @property string $pseudo
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property int $enabled
 *
 * @property Activity[] $activities
 * @property User $id0
 * @property ProjectMember[] $projectMembers
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
            [['id', 'creation_date', 'modification_date', 'pseudo'], 'required'],
            [['id', 'enabled'], 'integer'],
            [['creation_date', 'modification_date'], 'safe'],
            [['pseudo'], 'string', 'max' => 16],
            [['firstname', 'lastname'], 'string', 'max' => 80],
            [['email'], 'string', 'max' => 120],
            [['id'], 'unique'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
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
            'pseudo' => Yii::t('app', 'Pseudo'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'email' => Yii::t('app', 'Email'),
            'enabled' => Yii::t('app', 'Enabled'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['member_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectMembers()
    {
        return $this->hasMany(ProjectMember::className(), ['member_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return MemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemberQuery(get_called_class());
    }
}
