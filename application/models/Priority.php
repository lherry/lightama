<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "priority".
 *
 * @property string $id
 * @property int $level
 * @property string $label
 * @property int $enabled
 *
 * @property Task[] $tasks
 */
class Priority extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'priority';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'level', 'label', 'enabled'], 'required'],
            [['id', 'level', 'enabled'], 'integer'],
            [['label'], 'string', 'max' => 10],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'level' => Yii::t('app', 'Level'),
            'label' => Yii::t('app', 'Label'),
            'enabled' => Yii::t('app', 'Enabled'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['priority_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return PriorityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PriorityQuery(get_called_class());
    }
}
