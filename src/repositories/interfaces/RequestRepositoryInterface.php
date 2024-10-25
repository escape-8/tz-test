<?php

declare(strict_types=1);

namespace app\repositories\interfaces;

use app\models\Request;

interface RequestRepositoryInterface
{
    public function findRequestsByManagerId(int $managerId);

    public function findDuplicateForMonth(Request $request);

    public function createRequest(Request $request);
}