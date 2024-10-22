<?php

declare(strict_types=1);

namespace app\repositories\interfaces;

interface RequestRepositoryInterface
{
    public function findRequestsByManagerId(int $managerId);
}