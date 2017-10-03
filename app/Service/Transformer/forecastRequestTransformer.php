<?php
namespace Service\Transformer;

use DateTimeImmutable;
use Exception;

class forecastRequestTransformer
{

    public function hydrate ($request)
    {
        if (null == $request['city']) {
            throw new Exception('The city field may not be empty', 400);
        } else {
            if (preg_match('[\s]', $request['city'])) {
                throw new Exception('City query is not allowed to have spaces or special characters.', 400);
            }
            $city = $request['city'];
        }

        if (null == $request['start_date']) {
            $start_date = new DateTimeImmutable('2017-10-03');
        } else {
            $this->matchesISO8061($request['start_date']);
            $start_date = new DateTimeImmutable($request['start_date']);
        }

        if (null == $request['end_date']) {
            $end_date = $start_date->add(new \DateInterval('PT48H'));
        } else {
            $this->matchesISO8061($request['end_date']);
            $end_date = new DateTimeImmutable($request['end_date']);
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