<?php
namespace Service\Transformer;

use DateTimeImmutable;
use Exception;

class forecastRequestTransformer
{

    public function hydrate ($request)
    {
        $todayDate = new DateTimeImmutable();
        $todayDate = $todayDate->setTime(0, 0, 0);

        if (null == $request['city']) {
            throw new Exception('The city field may not be empty.', 400);
        } else {
            $city = $request['city'];
            $city = preg_replace('[,\s]', ',', $city);
            $city = preg_replace('[\s]', '-', $city);
            $city = strtolower($city);
        }

        if (null == $request['start_date']) {
            throw new Exception('The start date field may not be empty.', 400);
        } else {
            $this->matchesISO8061($request['start_date']);
            $start_date = new DateTimeImmutable($request['start_date']);

            if ($start_date < $todayDate) {
                throw new Exception('The start date field may not be in the past.', 400);
            }
        }

        if (null == $request['end_date']) {
            throw new Exception('The end date field may not be empty.', 400);
        } else {
            $this->matchesISO8061($request['end_date']);
            $end_date = new DateTimeImmutable($request['end_date']);

            if ($end_date < $start_date) {
                throw new Exception('The end date field may not be in the past.', 400);
            }
        }

        return [
            'city' => $city,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];
    }

    /**
     * Matches 2017-10-03
     *
     * @param $string
     * @return bool
     * @throws Exception
     */
    private function matchesISO8061 ($string)
    {
        if (preg_match('/^([2][0][1-2][0-9]-[0-1][0-9]-[0-3][0-9])$/', $string)) {
            return true;
        }

        throw new Exception('Not a valid ISO8601 date. (2017-10-03)', 400);
    }
}