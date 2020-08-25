<?php
// para iniciar esta sessao é necessario usar o link https://tcxsproject.com.br/cadastro.php?act=tcxs
session_start();
if (!$_REQUEST["act"] && $_REQUEST["act"] != "tcxs"){
  header('Location: nao_logado.php');
  exit();
}


// Verificar se foi enviando dados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = filter_input(INPUT_POST, 'id');
    $nome = filter_input(INPUT_POST, 'nome');
    $usuario = filter_input(INPUT_POST, 'usuario');
    $senha = filter_input(INPUT_POST, 'senha');
} else if (!isset($id)) {
// Se não se não foi setado nenhum valor para variável $id
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
    $usuario = (isset($_GET["usuario"]) && $_GET["usuario"] != null) ? $_GET["usuario"] : "";
}



// Cria a conexão com o banco de dados
try {
    $conexao = new PDO("mysql:host=localhost;dbname=u923273795_users", "u923273795_users", "Tcxsproject2020web");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "<p class=\"bg-danger\">Erro na conexão:" . $erro->getMessage() . "</p>";
}

// Bloco If que Salva os dados no Banco - atua como Create e Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nome != "") {
    try {
        if ($id != "") {
            $stmt = $conexao->prepare("UPDATE usuarios SET nome=?, usuario=?,senha=?,data_cadastro=? WHERE id = ?");
            $stmt->bindParam(10, $id);
        } else {
            $stmt = $conexao->prepare("INSERT INTO usuarios (nome, usuario, senha,data_cadastro) VALUES (?, ?, ?, NOW())");
        }
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $usuario);
        $stmt->bindParam(3, $senha);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<p class=\"bg-success\">Dados cadastrados com sucesso!</p>";
                $id = null;
                $nome = null;
                $usuario = null;
                $senha = null;
            } else {
                echo "<p class=\"bg-danger\">Erro ao tentar efetivar cadastro</p>";
            }
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</p>";
    }
}

// Bloco if que recupera as informações no formulário, etapa utilizada pelo Update
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $nome = $rs->nome;
            $usuario = $rs->usuario;
            $senha = $rs->senha;
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Erro: " . $erro->getMessage() . "</p>";
    }
}
   
        
    
// Bloco if utilizado pela etapa Delete
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $id != "" && $usuario != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt2 = $conexao->prepare("DROP TABLE $usuario");
        $stmt2->bindParam(1, $usuario, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "<p class=\"bg-success\">Usuário removido com exito.</p>";
            $id = null;
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }
        if ($stmt2->execute()) {
            echo "<p class=\"bg-success\">Todos os dados de login e IP do usuário foram deletados.</p>";
            $usuario = null;
        } else {
            echo "<p class=\"bg-danger\">Erro: Não foi possível executar a declaração sql</p>";
        }


    } catch (PDOException $erro) {
        echo "<p class=\"bg-danger\">Usuário ainda não tinha logado no sistema, sem database de IP para deletar.</a>";
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
<a href="consulta.php?act=tcxs"> <button  class="btn btn-primary" /> VERIFICAR  ACESSOS E IP's</button></a>
<div class="container">
            <header class="row">
                <br />
            </header>
            <article>
                <div class="row">
                    <form action="?act=save" method="POST" name="form1" class="form-horizontal" >
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="panel-title">SISTEMA CADASTRO DE USUARIOS.</span>
                            </div>
                            <div class="panel-body">

                                <input type="hidden" name="id" value="<?php
                                // Preenche o id no campo id com um valor "value"
                                echo (isset($id) && ($id != null || $id != "")) ? $id : '';
                                ?>" />

                                <div class="form-group">
                                    <label for="nome" class="col-sm-1 control-label">Nome:</label>
                                    <div class="col-md-10">
                                        <input type="text" name="nome" value="<?php
                                        echo (isset($nome) && ($nome != null || $nome != "")) ? $nome : '';
                                        ?>" class="form-control"/>
                                    </div>
                                </div>    
                                <div class="form-group">    
                                    <label for="usuario" class="col-sm-1 control-label">Usuario:</label>
                                    <div class="col-md-10">
                                        <input type="text" name="usuario" value="<?php
                                        echo (isset($usuario) && ($usuario != null || $usuario != "")) ? $usuario : '';
                                        ?>" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="senha" class="col-sm-1 control-label">Senha:</label>
                                    <div class="col-md-10">
                                        <input type="text" name="senha" value="<?php
                                        echo (isset($senha) && ($senha != null || $senha != "")) ? $senha : '';
                                        ?>" class="form-control" />
                                    </div>
                                </div>
                        </div>
                                
                            <div class="panel-footer">
                                <div class="clearfix">
                                        <button type="submit" class="btn btn-primary" /><span class="glyphicon glyphicon-ok"></span> salvar</button>
                                    <div class="pull-right">
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
                                    <th>nome</th>
                                    <th>usuario</th>
                                    <th>senha</th>
                                    <th>data cadastro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /**
                                 *  Bloco que realiza o papel do Read - recupera os dados e apresenta na tela
                                 */
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM usuarios");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {

                                            ?><tr>
                                                <td><?php echo $rs->nome; ?></td>
                                                <td><?php echo $rs->usuario; ?></td>
                                                <td><?php echo $rs->senha; ?></td>
                                                <td><?php echo $rs->data_cadastro; ?></td>
                                                <td><center>
                                         


                                            <a href="?act=del&id=<?php echo $rs->id; ?>&usuario=<?php echo $rs->usuario; ?>" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-remove"></span> Excluir</a>


                                        </center>
                                        </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                }
                            } catch (PDOException $erro) {
                                echo "Erro: " . $erro->getMessage();
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </article>
        </div>

<!-- final do painel de consultas -->
</html>
<font color="#91060d"><footer id="det" style="position:fixed; left:0px; right:0px; bottom:0px; background:rgb(0,0,0); text-align:center; border-top: 1px solid #91060d; border-bottom: 1px solid #91060d"><font color="#91060d" face="Tahoma" size="2"><font color="91060d"><b> TCXS Project 2020 | @GorpoOrko Codding</b></font>

 

