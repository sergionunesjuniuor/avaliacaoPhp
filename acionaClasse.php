<?php

include("clientes_db.php");


$Nome = "";
if(isset($_GET['nome'])) { 
	$Nome = $_GET['nome'];
}


$pdo = clientes_db::buscaCliente($Nome);

#print "Retorno Json: ".$pdo;

//faz o parsing na string, gerando um objeto PHP
$obj = json_decode($pdo);
 
//imprime o conteúdo do objeto 
print "<table>";
print "<tr><td width=100>nome:</td><td> $obj->cli_nome<br></td></tr>"; 
print "<tr><td>idade: </td><td>$obj->cli_idade<br></td></tr>";
print "<tr><td>endereco: </td><td>$obj->cli_endereco<br></td></tr>";
print "<tr><td>telefone: </td><td>$obj->cli_telefone<br></td></tr>";
print "<tr><td>categoria: </td><td>$obj->cat_nome<br></td></tr>"; 
print "<tr><td>status: </td><td>$obj->cat_status<br></td></tr>"; 
print "</table>";


#var_dump($obj);
