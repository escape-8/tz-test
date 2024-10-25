<?php

declare(strict_types=1);

namespace app\services;

use app\jobs\RequestCreateJob;
use app\models\Request;
use app\repositories\interfaces\RequestRepositoryInterface;
use Yii;
use yii\data\ActiveDataProvider;

class RequestService
{
    private $requestRepository;
    private $queue;

    public function __construct(RequestRepositoryInterface $requestRepository)
    {
        $this->requestRepository = $requestRepository;
        $this->queue = Yii::$app->queue;
    }

    public function createRequest(Request $request): void
    {
        $this->queue->push(new RequestCreateJob($this->requestRepository, [
            'request' => $request
        ]));
    }

    public function filterRequestByManagerId(int $managerId): ActiveDataProvider
    {
        $queryRequestsManager = $this->requestRepository->findRequestsByManagerId($managerId);

        return new ActiveDataProvider([
            'query' => $queryRequestsManager,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ]
        ]);
    }
}