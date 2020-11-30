<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusStop extends Model
{
    const BUST_STOPS_LIMIT = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'lat', 'lon'
    ];

    public static function getClosestByPostCode(PostCode $postCode)
    {
        $busStops = [];
        if (!is_null($postCode->latitude) && !is_null($postCode->longitude)) {
            $latitude = (float) $postCode->latitude;
            $longitude = (float) $postCode->longitude;
            $busStopsData = self::selectRaw("*, ST_Distance_Sphere( point(`lon`, `lat`), point($longitude, $latitude) ) AS sphere_distance")
                ->orderby('sphere_distance')
                ->limit(self::BUST_STOPS_LIMIT)
                ->get();
            foreach ($busStopsData as $busStop) {
                $busStops[] = $busStop->name;
            }
        }
        return $busStops;
    }

}
