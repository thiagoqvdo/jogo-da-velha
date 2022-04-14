<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Inicializar a sessão
session_start();

//Renovar todas as variáveis da sessão
$_SESSION = array();

//Destrói a sessão
session_destroy();

//Redireciona para o login
header("location: ../index.php");
exit;
