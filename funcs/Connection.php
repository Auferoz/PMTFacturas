<?php

$link = 'mysql:host=localhost;dbname=pmtcl_db';
$usuario = 'pmtcl_master';
$contraseña = 'ucGYsXs.g*BZ';

try{

    $pdo = new PDO($link,$usuario,$contraseña);
    $pdo->exec("set names utf8");

    //echo 'Conectado <br>';

    //foreach($pdo->query('SELECT * FROM `colores`') as $fila) {
    //    print_r($fila);
    //}
	//
	//$link = 'mysql:host=localhost;dbname=pmtcl_sinextradb';
	//$usuario = 'pmtcl_sinextras';
	// $contraseña = '!Alfredo2019!';
	//
	// csi39531_sinextradb
	// csi39531_extra
	// snxtr2019


} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}
