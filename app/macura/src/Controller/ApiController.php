<?php

namespace App\Controller;

use App\Service\ClothesForecast\ClothesForecastService;
use App\Service\ClothesForecast\Request\RequestDTOTransformer;
use App\Service\Transformer\DateRangeTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController
{

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

        return new JsonResponse($clothesForecast);
    }
}
