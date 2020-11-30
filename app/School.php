<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    const
        SCHOOLS_RANGE_MILES = 10,
        METERS_TO_MILES = 0.000621371192
    ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name'
    ];

    public static function getSchoolsInRangeByPostCode(PostCode $postCode)
    {
        $schools = [];
        if (!is_null($postCode->latitude) && !is_null($postCode->longitude)) {
            $latitude = (float) $postCode->latitude;
            $longitude = (float) $postCode->longitude;
            $schoolsData = self::join('post_codes', 'schools.postcode_id', '=', 'post_codes.id')
                ->whereRaw(" ST_Distance_Sphere( point(longitude, latitude), point(?, ?) ) * " . self::METERS_TO_MILES . " <  " . self::SCHOOLS_RANGE_MILES, [ $longitude, $latitude ])
                ->get();

            foreach ($schoolsData as $busStop) {
                $schools[] = $busStop->name;
            }
        }
        return $schools;
    }

}
