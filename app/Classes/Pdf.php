<?php
/**
 * Created by PhpStorm.
 * User: bojanzizanovic
 * Date: 2020-11-30
 * Time: 21:32
 */

namespace App\Classes;

use Fpdf\Fpdf;

class Pdf extends Fpdf
{
    /**
     * @param $header
     * @param $data
     */
    function BasicTable($header, $data)
    {
        foreach($header as $col) {
            $this->Cell(18, 7, $col, 1);
        }
        $this->Ln();

        foreach($data as $row)
        {
            foreach ($header as $col) {
                $this->Cell(18,6,$row->$col,1);
            }
            $this->Ln();
        }
    }
}