<?php
include_once "PDO.php";

function GetOneUserFromId($id)
{
  global $PDO;
  $response = $PDO->query("SELECT * FROM user WHERE id = $id");
  return $response->fetch();
}

function GetAllUsers()
{
  global $PDO;
  $response = $PDO->query("SELECT * FROM user ORDER BY nickname ASC");
  return $response->fetchAll();
}

function GetUserIdFromUserAndPassword($nickname, $password)
{
  global $PDO;
  // die("SELECT username, password FROM user WHERE username = '$username' AND password = '$password'");

  $response = $PDO->query("SELECT id, password FROM user WHERE nickname = '$nickname' AND password = '$password'");
  $rows = $response->fetchAll();
  $usersNandP = count($rows);
  if ($usersNandP == 1) {
    $userConnect = $rows[0];
    return $userConnect['id'];
  } else {
    return -1;
  }
}
