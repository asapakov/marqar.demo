<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Дерево</title>
    <link href="new-tree.css" type="text/css" rel="stylesheet" />
    
  </head>
    <body>

<?php

function buildTree(array &$elements, $parentId = 0) {
  $branch = array();

  foreach ($elements as $element) {
      if ($element['pid'] == $parentId) {
          $children = buildTree($elements, $element['id']);
          if ($children) {
              $element['children'] = $children;
          }
          $branch[$element['id']] = $element;
          unset($elements[$element['id']]);
      }
  }
  return $branch;
}

function drawTreeChild($child) {
  echo '<ul>';
  foreach ($child as $node) {
    echo sprintf("<li><a>%d: %s</a>", $node['id'], $node['name']);
    if (isset($node['children'])) {
      drawTreeChild($node['children']);
    }
  }
  echo '</li></ul>';
}

function drawTree($tree) {
  ob_start();
  echo '<ul class="tree">';
  foreach ($tree as $node) {
    echo sprintf("<li><a>%d: %s</a>", $node['id'], $node['name']);
    if (isset($node['children'])) {
      drawTreeChild($node['children']);
    }
  }
  echo '</ul>';

  echo ob_get_clean();
}

$servername = "localhost";
$username = "u_markhar";
$password = "a5Ylua76";
$dbname = "markhar";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";


$sql = "SELECT * FROM user ORDER BY id ASC";  

// start query time measurement
$start_time = microtime(true);

$result = $conn->query($sql);

$arr = [];

if ($result->num_rows) {
	while ($row = $result->fetch_assoc()) {
    $arr[] = [
      'id'   => $row['id'],
      'pid'  => $row['parent_user_id'],
      'name' => $row['first_name']
    ];
	}
} else {
  echo "0 results";
}

$tree = buildTree($arr);
unset($arr);

// calculate elapsed query time
echo sprintf('Elapsed: %f seconds<br>', microtime(true) - $start_time);

$result->free_result();
$conn->close();
?>

  <div class="content">
      <h1>Marqar Tree</h1>
      <?php drawTree($tree) ?>
  </div>
   
  </body>
</html>
