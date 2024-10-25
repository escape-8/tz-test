<?php

declare(strict_types=1);

namespace app\repositories;

use app\models\Manager;
use app\repositories\interfaces\ManagerRepositoryInterface;
use yii\db\ActiveRecord;

class ManagerRepository implements ManagerRepositoryInterface
{
    /**
     * @return array|ActiveRecord|null
     */
    public function findManagerWithMinRequests()
    {
        return Manager::find()
            ->select([
                '{{managers}}.id',
                'COUNT({{requests}}.id) AS requests_count'
            ])
            ->joinWith('requests')
            ->where(['is_works' => true])
            ->groupBy('{{managers}}.id')
            ->orderBy('requests_count ASC')
            ->one();
    }
}