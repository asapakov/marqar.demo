<?php

if(isset($_GET['rid']))
  session_start(); 
  $_SESSION['rid'] = $_GET['rid'];
  header("Location: https://marqar.kz/s/frontend/web/site/signup?rid=".$_GET['rid']);
  exit();

?>

