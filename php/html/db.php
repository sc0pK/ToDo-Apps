<?php
function getDb()
{
  $dsn = 'mysql:dbname=todo_list; host=mysql; charset=utf8';
  $usr = 'usr';
  $passwd = 'TjpLxscak6rq';

  try {
    $db = new PDO($dsn, $usr, $passwd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  } catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage()); 
  } finally {
    $db = null;
  }
}
?>