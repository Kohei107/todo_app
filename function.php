<?php
function db_connect() {

  try{
      $dsn = 'mysql:dbname=heroku_96cadbb0a954e22;host=us-cdbr-east-02.cleardb.com;charset=utf8';
      $user = 'HEROKU_USER_NAME';
      $password = 'HEROKU_PWD';

      $dbh = new PDO($dsn, $user, $password);
      $dbh->query('SET NAMES utf8');
      $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

      return $dbh;

    } catch (PDOException $e) {
      print "エラー: " . $e->getMessage() . "<br/>";

      die();
      }
}

