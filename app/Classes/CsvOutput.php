<?php
/**
 * Created by PhpStorm.
 * User: bojanzizanovic
 * Date: 2020-11-29
 * Time: 22:46
 */

namespace App\Classes;


class CsvOutput implements OutputInterface
{
    const
        CSV_FILE = 'report_',
        CSV_DELIMITER = ','
    ;

    /**
     * @param $data
     */
    public function show($data)
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . self::CSV_FILE . date('Ymd-His') . '.csv"');

        $fp = fopen('php://output', 'wb');
        $firstRow = true;
        foreach ($data as $row) {
            $vars = get_object_vars($row);
            if ($firstRow) {
                $properties = array_keys($vars);
                fputcsv($fp, $properties, self::CSV_DELIMITER);
            }
            fputcsv($fp, $vars, self::CSV_DELIMITER);
            $firstRow = false;
        }
        fclose($fp);
    }

}