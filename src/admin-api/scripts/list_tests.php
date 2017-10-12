<?php

/* /tests */
$root = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'tests';

/* types of tests: 'api', 'unit' ... */
$types = directories($root);

/* create whole structure */
$structure = [];
foreach($types as $type) {
  if(!isset($structure[$type])) {
    $path = $root . DIRECTORY_SEPARATOR . $type;
    $subtypes = directories($path);
    /* 'contact', 'contact_group', 'post' ... */
    foreach($subtypes as $subtype) {
      $innerPath = $path . DIRECTORY_SEPARATOR . $subtype;
      $structure[$type][$subtype] = files($innerPath);
    }
  }
}

/* function regex */
$functionFinder = '/function[\s\n]+(\S+)[\s\n]*\(/';
$result = [];

foreach($structure as $type => $value) {
  foreach($value as $subtype => $innerValue) {
    $files = $structure[$type][$subtype];
    foreach($files as $file) {
      $path = $root . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . $subtype . DIRECTORY_SEPARATOR . $file;
      $functions = functions($path);
      $result[$type][$subtype][$file] = $functions;
    }
  }
}

function directories($path) {
  $files = [];
  foreach (new DirectoryIterator($path) as $file) {
    if ($file->isDot()) { continue; }
    if ($file->isDir()) {
      $files[] = $file->getFilename();
    }
  }
  return $files;
}

function files($path) {
  $files = [];
  foreach (new DirectoryIterator($path) as $file) {
    if ($file->isFile()) {
      $files[] = $file->getFilename();
    }
  }
  return $files;
}

function functions($path) {
  global $functionFinder;
  $content = file_get_contents($path);
  $result = [];
  preg_match_all($functionFinder, $content, $result);
  return $result;
}

print_r($result);
