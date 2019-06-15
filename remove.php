<?php
if (!$_GET['tarefa'] || $_GET['tarefa'] == '') {
  header('location: index.php');
}

include("conexao.php");
include("funcoes.php");

$lista_id = 1;
$resultado = null;

$tarefa_removida = $_GET['tarefa'];

$query_recupera = "SELECT * FROM tarefas WHERE id = $lista_id";
$tarefas = $mysqli->query($query_recupera)->fetch_object();

$lista_de_tarefas = json_decode($tarefas->tarefas);
$lista_de_tarefas = $lista_de_tarefas;

$tarefas_atualizadas = array();

foreach ($lista_de_tarefas as $tarefa => $status) {
  if ($tarefa != $tarefa_removida) {
    $tarefas_atualizadas[$tarefa] = $status;
  }
}


$tarefas_atualizadas_json = json_encode($tarefas_atualizadas, JSON_UNESCAPED_UNICODE);
$resultado = atualiza_bd($mysqli, $lista_id, $tarefas_atualizadas_json);

header('location: index.php?resultado=' . $resultado);
?>