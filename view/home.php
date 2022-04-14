<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
  require_once '../controller/cLogin.php';
?>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Cadastro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      rel="stylesheet"
      type="text/css"
      media="screen"
      href="./css/reset.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      media="screen"
      href="./css/global.css"
    />
  </head>
  <body onload="alterarPlayer('<?php echo $_SESSION['player1']; ?>')">
    <section class="container">
      <header>
        <div class="items_center">
          <h1 class="big_title" style="color: whitesmoke">Game da idosa</h1>
        </div>
        <div class="items_center flex_row">
          <h2 class="header_element player_name"><?php echo $_SESSION['player1'].' score: '.$_SESSION['player1_score'] ?></h2>
          <h2 class="header_element player_name"><?php echo $_SESSION['player2'].' score: '.$_SESSION['player2_score'] ?></h2>
          <div class="header_element">
            <button class="simple_button"><a style="text-decoration: none; color: #000000;" href="../controller/logout.php">Sair</a></button>
          </div>
        </div>
      </header>
      <div id="game" class="div_table center_block" style="margin-top: 75px;">
      <div class="table_row">
          <div class="table_quad items_center" onclick="point('a1')">
            <h1 class="game_point" id="a1" hidden></h1>
          </div>
          <div class="table_quad items_center" onclick="point('a2')">
            <h1 class="game_point" id="a2" hidden></h1>
          </div>
          <div  class="table_quad items_center" onclick="point('a3')">
            <h1 class="game_point" id="a3" hidden></h1>
          </div>
        </div>
        <div class="table_row">
          <div class="table_quad items_center" onclick="point('b1')">
            <h1 class="game_point" id="b1" hidden></h1>
          </div>
          <div class="table_quad items_center" onclick="point('b2')">
            <h1 class="game_point" id="b2" hidden></h1>
          </div>
          <div  class="table_quad items_center" onclick="point('b3')">
            <h1 class="game_point" id="b3" hidden></h1>
          </div>
        </div>
        <div class="table_row">
          <div  class="table_quad items_center" onclick="point('c1')">
            <h1 class="game_point" id="c1" hidden></h1>
          </div>
          <div class="table_quad items_center" onclick="point('c2')">
            <h1 class="game_point" id="c2" hidden></h1>
          </div>
          <div class="table_quad items_center" onclick="point('c3')">
            <h1 class="game_point" id="c3" hidden></h1>
          </div>
        </div>
      </div>
      <form hidden action="<?php cLogin::registrar(); ?>" method="post" id="partida_form">
      <input hidden type="text" name="player1" id="player1">
      <input hidden type="text" name="player2" id="player2">
      <input hidden type="text" name="vencedor" id="vencedor">
      <input hidden type="submit" name="salvar" id="partida_submit">
    </form>
    </section>
    <script>
      const rows = ["a", "b", "c"];
      const columns = ["1", "2", "3"];
      var player1 = {
        nome: "<?php echo $_SESSION['player1']; ?>",
        marcas: "",
        ponto: 'X'
      };
      var player2 = {
        nome: "<?php echo $_SESSION['player2']; ?>",
        marcas: "",
        ponto: " ⃝"
      };
      const players = [player1, player2];
      var playerDaVez = player1;

      var partida = {
        player1: player1.nome,
        player2: player2.nome,
        vencedor: "empate"
      }

      function point(elementId) {
        if (document.getElementById(elementId).innerHTML == "") {
          document.getElementById(elementId).innerHTML = playerDaVez.ponto;
          document.getElementById(elementId).removeAttribute("hidden");

          playerDaVez.marcas = playerDaVez.marcas + elementId;

          if (playerDaVez == player1) playerDaVez = player2; 
          else playerDaVez = player1;

          alterarPlayer(playerDaVez.nome);

          players.forEach((player) => {
            var player_marcas = player.marcas;
            if (
              (player_marcas.includes("a3") &&
                player_marcas.includes("b2") &&
                player_marcas.includes("c1")) ||
              (player_marcas.includes("a1") &&
                player_marcas.includes("b2") &&
                player_marcas.includes("c3"))
            ) {
              setTimeout(() => {
                partida.vencedor = player.nome;
                alert(player.nome + " venceu!");
                salvarPartida();
                clear();
              }, 200);
            }

            rows.forEach((e) => {
              if (
                player_marcas
                  .replaceAll(new RegExp(/[1-3]/, "g"), "")
                  .includes(e + e + e) ||
                  player_marcas
                  .replaceAll(new RegExp(/[1-3]/, "g"), "")
                  .includes(e + e + 'a' + e) ||
                  player_marcas
                  .replaceAll(new RegExp(/[1-3]/, "g"), "")
                  .includes(e + e + 'b' + e) ||
                  player_marcas
                  .replaceAll(new RegExp(/[1-3]/, "g"), "")
                  .includes(e + e + 'c' + e)
              ) {
                setTimeout(() => {
                  partida.vencedor = player.nome;
                  alert(player.nome + " venceu!");
                  clear();
                  salvarPartida();
                }, 200);
              }
            });
            columns.forEach((e) => {
              console.log(player_marcas.replaceAll(new RegExp(/(?![${e}])/, "g"), ""));

              if (
                player_marcas
                  .replaceAll(new RegExp(/[a-c]/, "g"), "")
                  .includes(e + e + e) ||
                  player_marcas
                  .replaceAll(new RegExp(/[a-c]/, "g"), "")
                  .includes(e + e + '1' + e) ||
                  player_marcas
                  .replaceAll(new RegExp(/[a-c]/, "g"), "")
                  .includes(e + e + '2' + e) ||
                  player_marcas
                  .replaceAll(new RegExp(/[a-c]/, "g"), "")
                  .includes(e + e + '3' + e)
                  
              ) {
                setTimeout(() => {
                  partida.vencedor = player.nome;
                  alert(player.nome + " venceu!");
                  clear();
                  salvarPartida();
                }, 200);
              }
            });
          });
        }
        setTimeout(() => {
            empate();    
        }, 200);
        
      }

      function clear() {
        rows.forEach((row) => {
          columns.forEach((column) => {
            document.getElementById(row + column).innerHTML = "";
          });
        });
        players.forEach((player) => {
          player.marcas = "";
        });
      }

      function isEmpty() {
        rows.forEach((row) => {
          columns.forEach((column) => {
            if (document.getElementById(row + column).innerHTML == "") {
              return false;
            }
          });
        });
        return true;
      }

      function empate() {
        if (isEmpty() && (player1.marcas+player2.marcas).length == 18) {
            setTimeout(() => {
                  salvarPartida();
                  alert("Empate!");
                  clear();
                }, 200);
        }
      }

      function salvarPartida(){
        document.getElementById("player1").value = player1.nome;
        document.getElementById("player2").value = player2.nome;
        document.getElementById("vencedor").value = partida.vencedor;

        document.getElementById("partida_submit").click();
      }

      function alterarPlayer(player){
        var game = document.getElementById("game");

        game.dataset.content = "É a vez do " + player;
      }
    </script>
  </body>
</html>
