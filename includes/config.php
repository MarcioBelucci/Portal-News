<?php 
  mysqli_report(MYSQLI_REPORT_OFF);
  // $mysqli = mysqli_connect ('mysql.jumbo.com.br', 'jumbo01', 'A1234x','jumbo01');
  $mysqli = mysqli_connect ('localhost', 'root', '', 'news');
  if(mysqli_connect_errno()){
    echo "Conexão com o MySQL falhou: " . mysqli_connect_error();
  }
  mysqli_query($mysqli, "SET NAMES 'utf8'");
  mysqli_query($mysqli, 'SET character_set_connection=utf8');
  mysqli_query($mysqli, 'SET character_set_client=utf8');
  mysqli_query($mysqli, 'SET character_set_results=utf8');
  error_reporting(0);
?>