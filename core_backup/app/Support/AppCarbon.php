<?php

// in app/Support/AppCarbon.php

namespace App\Support;

use Carbon\Carbon;
use Carbon\CarbonInterface;

class AppCarbon extends Carbon
{
    public function toFormattedDateString(): string
    {
        return $this->translatedFormat('F j, Y');
    }

    public static function fromFormat($format, $time, $tz = null): CarbonInterface
    {
        return parent::fromFormat($format, $time, $tz);
    }
}