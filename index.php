<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");
            exit();

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Inclusão do arquivo CSS -->
    <link rel="stylesheet" href="Formulario.css"> <!-- Verifique se o arquivo CSS está no mesmo diretório -->
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Acesse sua conta</h1>
        </div>
        <form action="" method="POST" class="form">
            <div class="form-control">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" placeholder="Digite seu e-mail">
                <small>Preencha seu e-mail</small>
            </div>
            <div class="form-control">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Digite sua senha">
                <small>Preencha sua senha</small>
            </div>
            <button type="submit">Entrar</button>
        </form>
        <?php
            echo "<p>Depois do seu Login não tem volta!</p>";
        ?>
    </div>
</body>
</html>
