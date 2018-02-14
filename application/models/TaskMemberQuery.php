<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TaskMember]].
 *
 * @see TaskMember
 */
class TaskMemberQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TaskMember[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaskMember|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
