<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once './controller/cLogin.php';
// $login = new cLogin();
?>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="./view/css/reset.css" />
    <link rel="stylesheet" href="./view/css/global.css" />
  </head>
  <body>
    <section class="container">
      <form
        class="form_simple form_sizing items_center flex_column center_block"
        action="<?php cLogin::login(); ?>"
        method="POST"
        name="form"
      >
        <div class="form_item">
          <h1 class="big_title">Login</h1>
        </div>
        <div class="form_item flex_column">
          <label for="player1">Player 1</label>
          <input
            class="input_textfield"
            name="player1"
            id="player1"
            type="text"
            required
          />
        </div>
        <div class="form_item flex_column">
          <label for="player2">Player 2</label>
          <input
            class="input_textfield"
            name="player2"
            id="player2"
            type="text"
            required
          />
        </div>
        <div class="items_center flex_row">
          <input class="simple_button" type="submit" name="logar" value="Logar" />
          <input class="simple_button" type="reset" name="limpar" value="Limpar" />
        </div>
      </form>
    </section>
    <script>
        
    </script>
  </body>
</html>
