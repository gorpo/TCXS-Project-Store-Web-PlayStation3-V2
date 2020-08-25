<!-- ████████╗ ██████╗██╗  ██╗███████╗    ██████╗ ██████╗  ██████╗      ██╗███████╗ ██████╗████████╗
     ╚══██╔══╝██╔════╝╚██╗██╔╝██╔════╝    ██╔══██╗██╔══██╗██╔═══██╗     ██║██╔════╝██╔════╝╚══██╔══╝
        ██║   ██║      ╚███╔╝ ███████╗    ██████╔╝██████╔╝██║   ██║     ██║█████╗  ██║        ██║   
        ██║   ██║      ██╔██╗ ╚════██║    ██╔═══╝ ██╔══██╗██║   ██║██   ██║██╔══╝  ██║        ██║   
        ██║   ╚██████╗██╔╝ ██╗███████║    ██║     ██║  ██║╚██████╔╝╚█████╔╝███████╗╚██████╗   ██║   
        ╚═╝    ╚═════╝╚═╝  ╚═╝╚══════╝    ╚═╝     ╚═╝  ╚═╝ ╚═════╝  ╚════╝ ╚══════╝ ╚═════╝   ╚═╝   -->
<!-- @Gorpo Orko - 2020 -->
<?php
// Inicia a sessão
session_start();
?>


<!DOCTYPE html>
  <head>      

      <meta charset="UTF-8">
      <meta http-equiv="refresh" content="120">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta property="og:site_name" content="TCXS Project PlayStation3"/>
      <meta property="og:title" content="TCXS Project PlayStation3"/>
      <meta property="og:url" content="https://tcxsproject.com.br/"/>
      <meta property="og:description" content="Para adquirir sua versão mais atual da TCXS Project Store PKG para o console PlayStation3 clique no botão COMO ADQUIRIR e leia todas as regras, após isto já fazer sua doação. Aceitamos todos os tipos de pagamento como cartão, pagamento online"/>
      <meta property="og:image" content="loja/imagens/logo.png"/>
      <link rel="shortcut icon" href="loja/imagens/icon.png" />
      <script src="https://kit.fontawesome.com/a80232805f.js" crossorigin="anonymous"></script>
      <script src="assets/js/funcoesLogin.js"></script>
      <script src="loja/gorpo.js"></script>
      <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
      <title>TCXS Project STORE</title>
    </head>
<body> 
<!-- bloqueio do click direito do mouse -->
<script>document.oncontextmenu = document.body.oncontextmenu = function() {return false;}</script>
<!-- titulo animado <h1>TCXS PROJECT</h1>-->
<center><br><br><br><br><br><br><br><br><br><br>
<img src="assets/logo.png">
<div id="matrix" class="auto-style8">HAN | HEN | CFW | SEU IP: <?php echo $_SERVER['REMOTE_ADDR'] ?></div>
<font face="courier new" color="Red" size"12" ></center><br>
<br><br><br><br><br><br>
<!-- sistema -->
<center>
 <section class="hero is-success is-fullheight">
    <div class="hero-body">  
      <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">

          <!-- função php que retorna se o usuario teve erro ao logar -->
          <?php
            if(isset($_SESSION['nao_autenticado'])):
          ?>
            <div class="notification is-danger" style="font-size:20px;"><b>Usuário não cadastrado</b></div>
          <?php
            endif;
            unset($_SESSION['nao_autenticado']);
          ?>

        <!-- inputs para o usuario, após inserido envia os dados para serem confirmados em login.php -->  
        <div class="box"> 
          <form action="login.php" method="POST">

          <div class="wrap-input100 validate-input m-b-16" >
            <input class="input100" type="text" name="usuario" placeholder="Usuário">
            <span class="focus-input100"></span>
            </span>
          </div>

          <div class="wrap-input100 validate-input m-b-16" >
            <input class="input100" type="password" name="senha" placeholder="Senha">
            <span class="focus-input100"></span>
            </span>
          </div>

          <div class="field">          
            <button type="submit" id="btnhome" type="button" class="container-login100-form-btn login100-form-btn m-b-16 ">Entrar</button>
          </div>

          </form> 
        </div>
      </div>
    </div>
</section>


<!-- rodape -->
<div class="rodape">
  <b> Não vaze sua senha, seu ip esta armazenado e se outro ip logar com sua conta você será banido.</b>
</div>


<!--
<script>
    writeEnvInfo();
    ps3chk();
</script> -->
  </body>
</html>


 

