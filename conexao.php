<?php

$mysqli = new mysqli("localhost", "root", "", "listadetarefas");

if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
?>
