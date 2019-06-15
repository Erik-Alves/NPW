<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || $_POST['tarefa'] == '') {
  header('location: index.php');
}

include("conexao.php");
include("funcoes.php");

$lista_id = 1;
$resultado = null;

$query_recupera = "SELECT * FROM tarefas WHERE id = $lista_id";
$tarefas = $mysqli->query($query_recupera)->fetch_object();

$lista_de_tarefas = json_decode($tarefas->tarefas);

$nova_tarefa = mysql_real_escape_string(trim($_POST['tarefa']));

if (count($lista_de_tarefas) == 0) {
  $tarefas_atualizadas_json = json_encode(array($nova_tarefa => 0), JSON_UNESCAPED_UNICODE);
}

else {
  $lista_de_tarefas->$nova_tarefa = 0;
  $tarefas_atualizadas_json = json_encode($lista_de_tarefas, JSON_UNESCAPED_UNICODE);
}

$resultado = atualiza_bd($mysqli, $lista_id, $tarefas_atualizadas_json);
header('location: index.php?resultado=' . $resultado);
?>
