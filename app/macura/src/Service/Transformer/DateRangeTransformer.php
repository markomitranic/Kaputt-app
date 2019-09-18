<?php

namespace App\Service\Transformer;

use DateInterval;
use DatePeriod;
use DateTime;
use DateTimeInterface;
use Exception;

abstract class DateRangeTransformer
{
    /** @var string  */
    const DATE_FORMAT = 'Y-m-j';
    /** @var string  */
    const DATE_RANGE_FORMAT = self::DATE_FORMAT . '_' . self::DATE_FORMAT;
    /** @var int  */
    const MAXIMUM_INTERVAL_DAYS = 10;

    /**
     * @param string $dateRangeQuery
     * @return DateTimeInterface[]
     * @throws Exception
     */
    public static function transform(string $dateRangeQuery): array
    {
        $dateQueryStrings = self::explodeDateRangeQuery($dateRangeQuery);
        $period = self::datePeriodFromRangeQueryString(
            $dateQueryStrings['from'],
            $dateQueryStrings['to']
        );

        /** @var DateTimeInterface[] $days */
        $days = [];
        /** @var DateTimeInterface $day */
        foreach ($period as $day) {
            $days[] = $day;
        }

        return $days;
    }

    /**
     * @param string $dateRangeQuery
     * @return string[]
     * @throws Exception
     */
    private static function explodeDateRangeQuery(string $dateRangeQuery): array
    {
        $dateQueryStrings = explode('_', $dateRangeQuery);

        if (count($dateQueryStrings) !== 2) {
            throw new Exception('Unparsable input. Cannot deserialize into two date strings. ' . json_encode($dateQueryStrings));
        }

        return [
            'from' => $dateQueryStrings[0],
            'to' => $dateQueryStrings[1]
        ];
    }

    /**
     * @param string $from
     * @param string $to
     * @return DatePeriod
     * @throws Exception
     */
    private static function datePeriodFromRangeQueryString(string $from, string $to): DatePeriod
    {
        $fromDate = DateTime::createFromFormat(self::DATE_FORMAT, $from);
        $toDate = DateTime::createFromFormat(self::DATE_FORMAT, $to);

        if (!$fromDate || !$toDate) {
            throw new Exception('Unable to generate DateTime-s based on:' . $from . ' and ' . $to);
        }

        if ($fromDate->diff($toDate, true)->days > self::MAXIMUM_INTERVAL_DAYS) {
            throw new Exception('An interval must not be larger than ' . self::MAXIMUM_INTERVAL_DAYS . ' days.');
        }
        if ($fromDate->diff($toDate)->invert) {
            throw new Exception('The "to" date must not be in the past: ' . $to);
        }

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod(
            $fromDate,
            $interval,
            $toDate->modify('+ 1 day') // DatePeriod has an off-by-one.
        );
        return $period;
    }

}
