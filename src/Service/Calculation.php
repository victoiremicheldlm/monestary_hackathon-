<?php

namespace App\Service;



class Calculation
{
    public function distance(float $lat1, float $lng1, float $lat2, float $lng2, bool $miles = false): string
    {
        $pi80 = M_PI / 180;
        $lat1 *= $pi80;
        $lng1 *= $pi80;
        $lat2 *= $pi80;
        $lng2 *= $pi80;

        $r = 6372.797; // rayon moyen de la Terre en km
        $dlat = $lat2 - $lat1;
        $dlng = $lng2 - $lng1;
        $a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin(
                $dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $km = $r * $c;

        return round($miles ? ($km * 0.621371192) : $km, 2);
    }
}