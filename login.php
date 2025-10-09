<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillUp - Login</title>
    <link rel="icon" type="image/png" href="favicons/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <?php
        include("includes.php");

        if(isset($_GET["link"])){
            $link = $FS_CONFIG->fs_decodifica_url($_GET["link"]);

            // Vem desta pagina
            if($link[0] == 'login_error'){
                $FS_CONFIG->fs_alerta("Email ou Senha incorretos!","erro");
            }
            // Vem da pagina 'recuperar_senha.php'
            if($link[0] == 'rec_success'){
                $FS_CONFIG->fs_alerta('Senha alterada com sucesso','sucesso');
            }
        }
    ?>

    <!-- Painel esquerdo -->
    <div class="left-panel">
        <h1>SKILL UP</h1>
        <h3 class="mt-4">Bem-vindo de volta!</h3>
        <p class="text-light">Acesse sua conta agora mesmo.</p>
        <form method="POST" action="conexao.php" style="max-width: 300px; width: 100%;">
            <div class="mb-3">
                <input type="email" name="login_email" id="login_email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="login_senha" id="login_senha" class="form-control" placeholder="Senha" required>
            </div>
            <div class="d-grid">
                <button type="submit" name="BT_LOGIN" id="BT_LOGIN" class="btn btn-login">Entrar</button>
                <div class="text-center mt-2">
                    <a href="recuperar_senha.php" class="text-light" style="text-decoration: underline;">Esqueceu a
                        senha?</a>
                </div>
            </div>
        </form>
    </div>
    <!-- Painel direito -->
    <div class="right-panel">
        <h3>Não tem uma conta?</h3>
        <p>Crie sua conta agora e comece a evoluir suas habilidades!</p>
        <a href="cadastro.php" class="btn btn-primary">Cadastrar</a>
    </div>

    <?php
        session_unset();
        session_destroy();

        mysqli_close($mysqli);
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>