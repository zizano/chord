<?php
/**
 * Created by PhpStorm.
 * User: bojanzizanovic
 * Date: 2020-11-29
 * Time: 22:46
 */

namespace App\Classes;

class PdfOutput implements OutputInterface
{
    const PDF_FILE = 'report_';

    /**
     * @param $data
     * @return string
     */
    public function show($data)
    {
        $pdf = new Pdf();

        $row = reset($data);
        $header = array_keys(get_object_vars($row));

        $pdf->SetFont('Arial','',8);
        $pdf->AddPage('L', 'A4');
        $pdf->basicTable($header,$data);
        return $pdf->Output();
    }

}