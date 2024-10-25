<?php

declare(strict_types=1);

namespace app\jobs;

use app\models\Request;
use app\repositories\interfaces\RequestRepositoryInterface;
use yii\base\BaseObject;

class RequestCreateJob extends BaseObject implements \yii\queue\JobInterface
{
    /** @var Request $request */
    public $request;
    private $requestRepo;

    public function __construct(RequestRepositoryInterface $requestRepo, $config = [])
    {
        $this->requestRepo = $requestRepo;
        parent::__construct($config);
    }

    public function execute($queue)
    {
        $this->requestRepo->createRequest($this->request);
    }
}