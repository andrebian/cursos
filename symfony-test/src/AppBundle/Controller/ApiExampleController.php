<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiExampleController
 * @package AppBundle\Controller
 */
class ApiExampleController
{
    /**
     * @Route("/api/status")
     */
    public function statusAction()
    {
        $response = [
            'build_version' => 1,
            'codebase_version' => 30,
            'hash' => md5(uniqid())
        ];

        return new JsonResponse($response);
    }
}