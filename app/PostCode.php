<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'postcode', 'latitude', 'longitude'
    ];

    /**
     * @return array
     */
    public static function listCodes()
    {
        $postCodes = self::orderBy('postcode')->get();

        $codes = [];

        foreach ($postCodes as $postcode) {
            $parts = explode(' ', $postcode->postcode, 2);
            $codes[$parts[0]][] = $postcode->postcode;
        }

        return $codes;
    }

}
