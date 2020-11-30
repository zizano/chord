<?php

namespace App\Http\Controllers;

use App\AppUser;
use App\BusStop;
use App\Classes\CsvOutput;
use App\Classes\PdfOutput;
use App\Classes\Report;
use App\PostCode;
use App\School;
use App\Address;

class GeoController extends Controller
{
    const
        BUS = 'bus',
        SCHOOL = 'school',
        ADDRESS = 'address'
    ;

    protected $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function listPostCodes()
    {
        $codes = PostCode::listCodes();
        return response()->json($codes);
    }

    /**
     * @param $postcode
     * @param null $filter
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function listLocations($postcode, $filter = null)
    {
        $data = [];
        $code = PostCode::wherePostcode($postcode)->first();
        if (is_null($code)) {
            return $data;
        }
        if (is_null($filter) || $filter == self::BUS) {
            $data[self::BUS] = BusStop::getClosestByPostCode($code);
        }
        if (is_null($filter) || $filter == self::SCHOOL) {
            $data[self::SCHOOL] = School::getSchoolsInRangeByPostCode($code);
        }
        if (is_null($filter) || $filter == self::ADDRESS) {
            $data[self::ADDRESS] = Address::getAllByPostCode($code);
        }
        return response()->json($data);
    }

    /**
     * @param null $pdf
     */
    public function report($pdf = null)
    {
        $data = AppUser::makeReport();

        if (!empty($pdf)) {
            $this->report->setOutput(new PdfOutput($data));
        } else {
            $this->report->setOutput(new CsvOutput($data));
        }
        $this->report->showOutput($data);

    }

}
