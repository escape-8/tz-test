<?php

declare(strict_types=1);

namespace app\repositories;

use app\models\Request;
use app\repositories\interfaces\RequestRepositoryInterface;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class RequestRepository implements RequestRepositoryInterface
{
    public function findRequestsByManagerId(int $managerId): ActiveQuery
    {
        return Request::find()->joinWith('manager')->where(['manager_id' => $managerId]);
    }

    public function createRequest(Request $request)
    {
        $duplicate = $this->findDuplicateForMonth($request);
        $request->duplicate_id = $duplicate->id;
        $request->save();
    }

    /**
     * @return array|ActiveRecord|null
     */
    public function findDuplicateForMonth(Request $request)
    {
        $currentDate = (new \DateTime())->format('Y-m-d H:i:s');
        $dateMonthAgo = (new \DateTime())
            ->modify('-1 month')
            ->format('Y-m-d H:i:s');

        return Request::find()
            ->orWhere(['email' => $request->email])
            ->orWhere(['email' => $request->phone])
            ->andWhere(['between', 'created_at', $dateMonthAgo, $currentDate])
            ->orderBy('id DESC')
            ->limit(1)
            ->one();
    }
}