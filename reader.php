<?php

class Reader {
  private $filename;
  private $perpage;
  private $header = [];
  private $file;
  private $isLastPage = false;

  function __construct($filename, $perpage = 100) {
    $this->filename = $filename;
    $this->file = fopen($this->filename, 'r');
    if (!$this->file) throw new Exception("File not found", 1);
    $this->perpage = $perpage;
    $this->header = fgetcsv($this->file);
  }

  function __destruct() {
    fclose($this->file);
  }

  function getHeader() {
    return $this->header;
  }

  function getIsLastPage() {
    return $this->isLastPage;
  }

  function getPage($pageNumber) {
    $filters = $_GET;
    $filters = array_filter($filters, fn($value, $key) => is_numeric($key), ARRAY_FILTER_USE_BOTH);

    $i = 1;
    $j = 1;
    $pageCurrent = 1;
    $this->isLastPage = false;
    $arr = [];

    while (($line = fgetcsv($this->file)) !== FALSE) {
      $i++;
      foreach ($filters as $key => $value) {
        if (!str_contains(mb_strtolower($line[$key], 'UTF-8'), mb_strtolower($value, 'UTF-8'))) continue 2;
      }
      $j++;
      array_push($arr, $line);

      if ($j == $this->perpage) {
        if ($pageNumber == $pageCurrent) {
          return $arr;
        } else {
          $pageCurrent++;
          $arr = [];
          $j = 1;
        }
      }
    }
    $this->isLastPage = true;

    return $arr;
  }
}