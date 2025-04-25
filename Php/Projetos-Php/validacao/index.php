<?php 
$erros = [];

if(isset($_POST["nome"], $_POST["email"],$_POST["senha"],$_POST["confirmaSenha"])){
    //tratando nome
    if(empty($_POST["nome"])){
            $erros ["nome"] = "insira seu nome!"; 
    }elseif(!preg_match('/^[\p{L}\s]+$/u',$_POST["nome"])){
        $erros ["nome"] = "Apenas letras e espaços em branco</";
    }
    else{
        $nome = tratarForm($_POST["nome"]);
    }
    //tratando email
    if(empty($_POST["email"])){
            $erros ["email"] = "insira seu email!"; 
    }elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
        $erros ["email"] = "Insira um email valido";
    }
    else{
        $nome = tratarForm($_POST["email"]);
    }
    //tratando senha
    if(empty($_POST["senha"])){
            $erros ["senha"] = "insira sua senha!"; 
    }elseif(strlen($_POST["senha"]) < 5){
        $erros ["senha"] = "Insira uma senha de no minimo 5 caracteres";
    }
    else{
        $nome = tratarForm($_POST["senha"]);
    }
    //tratando confirma senha
    if(empty($_POST["confirmaSenha"])){
            $erros ["confirmaSenha"] = "Confirme sua senha!"; 
    }elseif($_POST["confirmaSenha"]!== $_POST["senha"]){
        $erros ["confirmaSenha"] = "As senhas sao diferentes";
    }
    else{
        $confirmaSenha = tratarForm($_POST["confirmaSenha"]);
    }
}
function tratarForm($dado){
    $dado = trim($dado);
    $dado = htmlspecialchars($dado);
    $dado = stripslashes($dado);
    return $dado;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de cadastro</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="containerPai">
        <div class="card">
            <h1>Cadastre-se</h1>
            <form method="post">
                <input type="text" name="nome" id="" placeholder="Nome">
                <?php
                if (isset($erros["nome"])){?>
                
                <div class="erro">
                <?php echo $erros["nome"];?>
                    <i class="bi bi-exclamation-circle-fill"></i>
                </div> <?php }?>
                <input type="email" name="email" id="" placeholder="Email">
                <?php
                if (isset($erros["email"])){?>
                <div class="erro">
                <?php echo $erros["email"];?>
                    <i class="bi bi-exclamation-circle-fill"></i>
                </div> <?php }?>
                <input type="password" name="senha" id="" placeholder="Senha">
                <?php
                if (isset($erros["senha"])){?>
                <div class="erro">
                <?php echo $erros["senha"];?>
                    <i class="bi bi-exclamation-circle-fill"></i>
                </div> <?php }?>
                <input type="password" name="confirmaSenha" id="" placeholder="Confirme a sua senha">
                <?php
                if (isset($erros["confirmaSenha"])){?>
                
                <div class="erro">
                <?php echo $erros["confirmaSenha"];?>
                    <i class="bi bi-exclamation-circle-fill"></i>
                </div> <?php }?>
                <button type="submit">Enviar</button>
            </form>
            <?php 
            if($_SERVER["REQUEST_METHOD"] == "POST" && empty ($erros)){
             echo "<h2>Formulario enviado com sucesso</h2> ";
            }
            ?>
            
        </div>
    </div>
</body>
</html>