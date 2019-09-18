<?php

namespace App\Service\ClothesForecast\Request;

use App\Service\Transformer\DateRangeTransformer;
use Symfony\Component\HttpFoundation\Request;

class RequestDTOTransformer
{

    /**
     * @param Request $request
     * @return RequestDTO
     * @throws \Exception
     */
    public function transform(Request $request): RequestDTO
    {
        if (!($dateRange = $request->query->get('dateRange'))) {
            throw new \Exception('You must provide a date range. Format: ' . DateRangeTransformer::DATE_RANGE_FORMAT);
        }
        if (!($lat = (float) $request->query->get('lat'))
            || !is_numeric($lat)
            || !($lat > 0 || $lat <= 180)
        ) {
            throw new \Exception('You must provide a valid latitude.');
        }
        if (!($lon = $request->query->get('lon'))
            || !is_numeric($lon)
            || !($lon > 0 || $lon <= 180)
        ) {
            throw new \Exception('You must provide a valid longitude.');
        }

        $dates = DateRangeTransformer::transform($dateRange);

        return new RequestDTO($lat, $lon, ...$dates);
    }

}
