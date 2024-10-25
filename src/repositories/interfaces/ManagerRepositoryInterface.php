<?php

declare(strict_types=1);

namespace app\repositories\interfaces;

interface ManagerRepositoryInterface
{
    public function findManagerWithMinRequests();
}