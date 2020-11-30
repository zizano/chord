<?php
/**
 * Created by PhpStorm.
 * User: bojanzizanovic
 * Date: 2020-11-29
 * Time: 22:40
 */

namespace App\Classes;


class Report
{
    private $output;

    /**
     * @param OutputInterface $outputType
     */
    public function setOutput(OutputInterface $outputType)
    {
        $this->output = $outputType;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function showOutput($data)
    {
        return $this->output->show($data);
    }
}