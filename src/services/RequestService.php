<?php

declare(strict_types=1);

namespace app\services;

use app\repositories\interfaces\RequestRepositoryInterface;
use yii\data\ActiveDataProvider;

class RequestService
{
    private $requestRepository;

    public function __construct(RequestRepositoryInterface $requestRepository)
    {
        $this->requestRepository = $requestRepository;
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