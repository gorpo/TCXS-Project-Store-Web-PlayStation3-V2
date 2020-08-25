<?php
// para iniciar esta sessao é necessario usar o link https://tcxsproject.com.br/consulta.php?act=tcxs
session_start();
if (!$_REQUEST["act"] && $_REQUEST["act"] != "tcxs"){
  header('Location: nao_logado.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = filter_input(INPUT_POST, 'usuario');
} 

// Cria a conexão com o banco de dados
try {
    $conexao = new PDO("mysql:host=localhost;dbname=u923273795_users", "u923273795_users", "Tcxsproject2020web");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "<p class=\"bg-danger\">Erro na conexão:" . $erro->getMessage() . "</p>";
}

// Bloco if que recupera as informações no formulário, etapa utilizada pelo Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $usuario != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM $usuario");
        //$stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $usuario = $rs->usuario;
            $senha = $rs->senha;
            $ip = $rs->ip;
            $data_atual = $rs->data_atual;
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Caso usuário ainda não tenha realizado o login não teremos dados para consultar, espere ate que o usuário logue e tente novamente!</p>";
    }
}

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
      <link href="assets/css/bootstrap.css" type="text/css" rel="stylesheet" />
      <script src="assets/js/bootstrap.js" type="text/javascript" ></script>
      <script src="loja/gorpo.js"></script>
      <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
      <title>TCXS Project 2021</title>
    </head>
<body> 
<center>
<a href="cadastro.php?act=tcxs"> <button  class="btn btn-primary" /> VOLTAR AO CADASTRO</button></a>
<div class="container">
            <header class="row">
                <br />
            </header>
            <article>
                <div class="row">
                    <form action="?act=save" method="POST" name="form1" class="form-horizontal" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="panel-title">Sistema de consulta | Verificar Vazamentos | Insira Usuario.</span>
                            </div>
                            <div class="panel-body">


                                <div class="form-group">    
                                    <label for="usuario" class="col-sm-1 control-label">Usuario:</label>
                                    <div class="col-md-10">
                                        <input type="text" name="usuario" value="<?php
                                        echo (isset($usuario) && ($usuario != null || $usuario != "")) ? $usuario : '';
                                        ?>" class="form-control" />
                                        <p>Insira o nome de usuário (username) cadastrado, confira a lista de usuários na tela anterior. Ignore o erro abaixo, insira o nome de usuário e clique em verificar, será exibido todos os logins com data, hora, usuario, senha e o IP. Em caso de IP diferente consulte o usuário ou apenas volte a tela anterior e realize o banimento do mesmo. Usuários cadastrados neste sistema passam por uma verificação diária, seu banimento é automático.</p>
                                    </div>
                                </div>
                        </div>
                            

                            <div class="panel-footer">
                                <div class="clearfix">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary" /><span class="glyphicon glyphicon-ok"></span> verificar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="panel panel-default">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ip</th>
                                    <th>usuario</th>
                                    <th>senha</th>
                                    <th>data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //trata o erro nao exibingo a mensagem de erro do mysql por nao achar uma database.
                                error_reporting(E_ALL & ~E_NOTICE);
                                /**
                                 *  Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
                                 */
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM $usuario");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {

                                            ?><tr>
                                                <td><?php echo $rs->ip; ?></td>
                                                <td><?php echo $rs->usuario; ?></td>
                                                <td><?php echo $rs->senha; ?></td>
                                                <td><?php echo $rs->data_atual; ?></td>
                                                <td><center>
                                        </center>
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                }
                            } catch (PDOException $erro) {
                                

                                echo "Caso usuário ainda não tenha realizado o login não teremos dados para consultar, espere ate que o usuário logue e tente novamente!" ;
                            }

                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </article>
        </div>
        <!-- final do painel de consultas -->


<!-- final do painel de consultas -->
</html>
<font color="#91060d"><footer id="det" style="position:fixed; left:0px; right:0px; bottom:0px; background:rgb(0,0,0); text-align:center; border-top: 1px solid #91060d; border-bottom: 1px solid #91060d"><font color="#91060d" face="Tahoma" size="2"><font color="91060d"><b> TCXS Project 2020 | @GorpoOrko Codding</b></font>