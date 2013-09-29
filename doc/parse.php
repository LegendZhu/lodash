<?php

  // cleanup requested filepath
  $file = isset($_GET['f']) ? $_GET['f'] : 'lodash';
  $file = preg_replace('#(\.*[\/])+#', '', $file);
  $file .= preg_match('/\.[a-z]+$/', $file) ? '' : '.js';

  // output filename
  if (isset($_GET['o'])) {
    $output = $_GET['o'];
  } else if (isset($_SERVER['argv'][1])) {
    $output = $_SERVER['argv'][1];
  } else {
    $output = basename($file);
  }

  /*--------------------------------------------------------------------------*/

  require('../vendor/docdown/docdown.php');

  // generate Markdown
  $markdown = docdown(array(
    'path'  => '../' . $file,
    'title' => 'Lo-Dash <span>v2.2.0</span>',
    'toc'   => 'categories',
    'url'   => 'https://github.com/lodash/lodash/blob/2.2.0/lodash.js'
  ));

  // save to a .md file
  file_put_contents($output . '.md', $markdown);

  // print
  header('Content-Type: text/plain;charset=utf-8');
  echo $markdown . PHP_EOL;

?>
