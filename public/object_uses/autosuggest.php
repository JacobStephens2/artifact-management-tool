<?php
  // You can simulate a slow server with sleep
  // sleep(2);
  function is_ajax_request() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
      $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }

  if(!is_ajax_request()) {
    exit;
  }

  require_once('../../artifacts_private/initialize.php');

  // Notes:
  // * strpos is faster than strstr or preg_match
  // * strpos requires strict comparison operator (===)
  //     returns 0 for match at start of string
  //     returns false for no match

  function str_contains($choice, $query) {
    return strpos($choice, $query) !== false;
  }

  function search($query, $choices) {
    $matches = [];

    $d_query = strtolower($query);

    // foreach($choices as $choice) {
    foreach($choices as $choice) {
      // Downcase both strings for case-insensitive search
      $d_choice = strtolower($choice);
      if(str_contains($d_choice, $d_query)) {
      // if(str_starts_with($d_choice, $d_query)) {
        $matches[] = $choice;
      }
    }

    return $matches;
  }

  // 2. Create query variable string.
  $query = isset($_GET['q']) ? $_GET['q'] : '';

  // 1. Get results from database query.
  // find and return search suggestions as JSON
  $object_names = find_object_names_by_user();
  $choices = [];
  // $choice_ids = [];
  while($record = mysqli_fetch_assoc($object_names)) {
    $choices [] = $record['ObjectName'];
    // $choice_ids [] = $record['ID'];
  }

  // $object_names = find_object_names();
  // $choices = mysqli_fetch_assoc($object_names);

  $suggestions = search($query, $choices);
  sort($suggestions);
  $max_suggestions = 5;
  $top_suggestions = array_slice($suggestions, 0, $max_suggestions);

  // $max_ids = 5;
  // $top_ids = array_slice($choice_ids, 0, $max_suggestions);

  echo json_encode($top_suggestions);
  // echo json_encode($top_ids);

  // echo '["1st Grade","1st Grade Books, Primary","1st Grade Papers","1st Grade, Primary","21st Birthday Mix by Kendel Lyn (2015)"]';

?>
