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
    if (isset($_SESSION['userId'])) {
      (unset) $_SESSION['userId'];
    }
    header('location: ?action=display');

    break;

  case 'login':
    include "../models/UserManager.php";
    if (isset($_POST['username']) && isset($_POST['password'])) {
      $userId = GetUserIdFromUserAndPassword($_POST['username'], $_POST['password']);
      if ($userId > 0) {
        $_SESSION['userId'] = $userId;
        header('Location: ?action=display');
      } else {
        $errorMsg = "Wrong login and/or password.";
        include "../views/LoginForm.php";
      }
    } else {
      include "../views/LoginForm.php";
    }
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
    if (isset($_GET['search'])) {
      $posts = SearchInPosts($_GET['search']);
    } else {
      $posts = GetAllPosts();
    }
    include "../models/CommentManager.php";
    $comments = array();

    foreach ($posts as $onepost) {

      $comments[$onepost['id']] = GetAllCommentsFromPostId($onepost['id']);
    }
    include "../views/DisplayPosts.php";
    break;
}
