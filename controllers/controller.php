<?php
//$action = $_GET["action"] ?? "display";
/*$action = "display";
if (isset($_GET["action"])) {
  $action = $_GET["action"];
}*/
$action = isset($_GET["action"]) ? $_GET["action"] : "display";

switch ($action) {

  case 'register':
    // code...
    break;

  case 'logout':
    // code...
    break;

  case 'login':
    // code...
    break;

  case 'newMsg':
    // code...
    break;

  case 'newComment':
    // code...
    break;

  case 'display':
  default:
    include "../models/PostManager.php";
    $posts = GetAllPosts();

    include "../models/CommentManager.php";
    $comments = array();

    foreach ($posts as $onepost) {

      var_dump($onepost['id']);
      $comments[$onepost['id']] = GetAllCommentsFromPostId($onepost['id']);
    }
    include "../views/DisplayPosts.php";
    break;
}
