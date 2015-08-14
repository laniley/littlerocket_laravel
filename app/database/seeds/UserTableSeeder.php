<?php

class UserTableSeeder extends BaseSeeder {

  public function __construct() {
    $this->table = 'users'; // name of the db-table
    $this->filename = app_path().'/database/csv/users.csv'; // Filename and location of data in csv file
  }

  /**
  * Run DB seed
  */
  public function run() {

    DB::table($this->table)->truncate();

    $csvData = $this->getDataFromCSV($this->filename, ',');

    $seedData = array();

    foreach($csvData as $oldData) {

      // $newData["email"] = "";
      $newData["fb_id"] = $oldData["id"];

      if(strrpos($oldData["name"], ' ') > -1) {
        list($newData["first_name"], $newData["last_name"]) = explode(' ', $oldData["name"], 2);
      }
      else {
        $newData["first_name"] = $oldData["name"];
        $newData["last_name"] = "";
      }

      $newData["img_url"] = $oldData["img_url"];
      $newData["gender"] = "";
      $newData["score"] = $oldData["score"];
      $newData["stars"] = $oldData["stars"];
      $newData["reached_level"] = 1;
      $newData["first_login"] = 0;
      $newData["last_login"] = $oldData["updated_at"];
      $newData["created_at"] = $oldData["inserted_at"];
      $newData["updated_at"] = $oldData["updated_at"];

      User::create(array(
        'fb_id' => $newData["fb_id"],
        'first_name' => $newData["first_name"],
        'last_name' => $newData["last_name"],
        'img_url' => $newData["img_url"],
        'gender' => $newData["gender"],
        'score' => $newData["score"],
        'stars' => $newData["stars"],
        'reached_level' => 1,
        'first_login' => false,
        'created_at' => $newData["created_at"],
        'updated_at' => $newData["updated_at"]
      ));
    }
  }



} // EOF
