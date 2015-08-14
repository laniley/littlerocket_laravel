<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseSeeder extends Seeder {

    /**
    * DB table name
    *
    * @var string
    */
     protected $table;

     /**
    * CSV filename
    *
    * @var string
    */
     protected $filename;

     /**
     * Collect data from a given CSV file and return as array
     *
     * @param $filename
     * @param string $deliminator
     * @return array|bool
     */
     protected function getDataFromCSV($filename, $deliminator = ",") {

       $filename = str_replace("/", "\\", $filename);

       if(!file_exists($filename)) {
         var_dump('file does not exist - '.$filename);
         return FALSE;
       }
       if(!is_readable($filename)) {
         var_dump('file is not readable - '.$filename);
         return FALSE;
       }

       $header = NULL;
       $data = array();

       if(($handle = fopen($filename, 'r')) !== FALSE) {
         while(($row = fgetcsv($handle, 1000, $deliminator)) !== FALSE) {
           if(!$header) {
             $header = $row;
           }
           else {
             if (count($row) == count($header)) {
               $data[] = array_combine($header, $row);
             }
             else {
               var_dump("not matchable data - ".implode(",", $row));
             }
           }
         }
         fclose($handle);
       }
       else {
         var_dump('could not open file - '.$filename);
         return FALSE;
       }

       return $data;
     }
}
