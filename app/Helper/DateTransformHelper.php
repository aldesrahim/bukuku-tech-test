<?php

namespace App\Helper;

use Carbon\Carbon;

class DateTransformHelper
{
    public static function getLocaleCode()
    {
        $locale = config('app.locale');
        $fallbackLocale = config('app.fallback_locale');

        if (! setlocale(LC_ALL, $locale)) {
            return $fallbackLocale;
        }

        return $locale;
    }

    public static function createFromIsoFormat($format, $timeString, $fromLocale = true): Carbon
    {
        if ($fromLocale !== true) {
            return Carbon::createFromIsoFormat(format: $format, time: $timeString, locale: $fromLocale);
        }

        return Carbon::createFromLocaleIsoFormat($format, self::getLocaleCode(), $timeString);
    }

    public static function dayNameToEN($dayID): string
    {
        $dayID = strtolower($dayID);
        $dayID = StringHelper::getLettersOnly($dayID);

        $daysMap = [
            'senin' => 'monday',
            'selasa' => 'tuesday',
            'rabu' => 'wednesday',
            'kamis' => 'thursday',
            'jumat' => 'friday',
            'sabtu' => 'saturday',
            'minggu' => 'sunday',
        ];

        return ucfirst($daysMap[$dayID] ?? $dayID);
    }
}
