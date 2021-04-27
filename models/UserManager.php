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
function CreateNewUser($nickname, $password)
{
  global $PDO;
  $response = $PDO->prepare("INSERT INTO user (nickname, password) values (:nickname , :password )");
  $response->execute(
    array(
      "nickname" => $nickname,
      "password" => $password
    )
  );
  return $PDO->lastInsertId();
}
function IsNicknameFree($nickname)
{
  global $PDO;
  $response = $PDO->prepare("SELECT * FROM user WHERE nickname = :nickname ");
  $response->execute(
    array(
      "nickname" => $nickname
    )
  );
  return $response->rowCount() == 0;
}
