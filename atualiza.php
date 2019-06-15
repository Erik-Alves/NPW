<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('location: index.php');
}

include("conexao.php");
include("funcoes.php");

$lista_id = 1;
$resultado = null;

$query_recupera = "SELECT * FROM tarefas WHERE id = $lista_id";
$tarefas = $mysqli->query($query_recupera)->fetch_object();

$lista_de_tarefas = json_decode($tarefas->tarefas);

$tarefas_atualizadas = array();

if (isset($_POST['tarefas'])) {
  $tarefas_post = $_POST['tarefas'];

  foreach ($lista_de_tarefas as $tarefa => $status) {
    if (in_array($tarefa, $tarefas_post)) {
      $tarefas_atualizadas[$tarefa] = 1;
    } else {
      $tarefas_atualizadas[$tarefa] = 0;
    }
  }
}

else {
  foreach ($lista_de_tarefas as $tarefa => $status) {
    $tarefas_atualizadas[$tarefa] = 0;
  }
}

$tarefas_atualizadas_json = json_encode($tarefas_atualizadas, JSON_UNESCAPED_UNICODE);
$resultado = atualiza_bd($mysqli, $lista_id, $tarefas_atualizadas_json);
header('location: index.php?resultado=' . $resultado);
?>