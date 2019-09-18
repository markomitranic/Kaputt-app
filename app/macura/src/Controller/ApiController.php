<?php

namespace App\Controller;

use App\Service\ClothesForecast\ClothesForecastService;
use App\Service\ClothesForecast\Request\RequestDTOTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController
{

    /** @var int  */
    const CACHE_TIMEOUT = 43200; # 12 hours

    /**
     * @param RequestDTOTransformer $requestTransformer
     * @param ClothesForecastService $clothesForecastService
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function forecast(
        RequestDTOTransformer $requestTransformer,
        ClothesForecastService $clothesForecastService,
        Request $request
    ): JsonResponse {
        $requestDto = $requestTransformer->transform($request);

        $clothesForecast = $clothesForecastService->getClothesForecast(
            $requestDto->getLatitude(),
            $requestDto->getLongitude(),
            ...$requestDto->getDateRange()
        );

        $response = new JsonResponse($clothesForecast);
        $response->setSharedMaxAge(self::CACHE_TIMEOUT);

        return $response;
    }
}
