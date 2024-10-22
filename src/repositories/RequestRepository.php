<?php

declare(strict_types=1);

namespace app\repositories;

use app\models\Request;
use app\repositories\interfaces\RequestRepositoryInterface;
use yii\db\ActiveQuery;

class RequestRepository implements RequestRepositoryInterface
{
    public function findRequestsByManagerId(int $managerId): ActiveQuery
    {
        return Request::find()->joinWith('manager')->where(['manager_id' => $managerId]);
    }
}