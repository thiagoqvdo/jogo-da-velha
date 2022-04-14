<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cLogin
 *
 * @author jairb
 */
class cLogin {
    //put your code here
    public static function login() {
        if(isset($_POST['logar'])){
            session_start();
            $_SESSION['player1'] = $_POST['player1'];
            $_SESSION['player2'] = $_POST['player2'];
            $_SESSION['player1_score'] = 0;
            $_SESSION['player2_score'] = 0;
            header("Location: ./view/home.php");
        }
    }

    public static function registrar() {
        if(isset($_POST['salvar'])){
        $player1 = $_POST['player1'];
        $player2 = $_POST['player2'];
        $vencedor = $_POST['vencedor'];
        if ($vencedor == $player1) $_SESSION['player1_score'] = $_SESSION['player1_score']+1; 
        if ($vencedor == $player2) $_SESSION['player2_score'] = $_SESSION['player2_score']+1; 

            
        $pdo = require $_SERVER['DOCUMENT_ROOT'].'/jogo-da-velha/pdo/connection.php';
        $sql = "insert into partida (player1, player2, vencedor) values (?,?,?)";
        $Statement = $pdo->prepare($sql);
//            $Statement->execute([$nome,$email,$pass]);
//            Exemplo 2 de passar os parametros no insert
        $Statement->bindParam(1, $player1, PDO::PARAM_STR);
        $Statement->bindParam(2, $player2, PDO::PARAM_STR);
        $Statement->bindParam(3, $vencedor, PDO::PARAM_STR);
        $Statement->execute();
        header("Location: ../view/home.php");
        unset($Statement);
        unset($pdo);
    }
}

    public function logout() {
        
    }

}
