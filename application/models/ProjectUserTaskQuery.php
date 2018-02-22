<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProjectUserTask]].
 *
 * @see ProjectUserTask
 */
class ProjectUserTaskQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProjectUserTask[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProjectUserTask|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
