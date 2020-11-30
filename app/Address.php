<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'postcode_id', 'district', 'locality', 'street', 'site', 'site_number', 'site_description', 'site_subdescription'
    ];

    public static function getAllByPostCode(PostCode $postCode)
    {
        $addresses = [];
        if (!is_null($postCode->latitude) && !is_null($postCode->longitude)) {

            $addressesData = Address::wherePostcodeId($postCode->id)->get();
            foreach ($addressesData as $address) {
                $addresses[] = implode(',', array_filter([$address->district, $address->locality, $address->street,
                    $address->site, $address->site_number, $address->site_description, $address->site_subdescription]));
            }
        }
        return $addresses;
    }

}
