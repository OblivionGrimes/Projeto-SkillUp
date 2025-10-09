<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillUp - Recuperar Senha</title>
    <link rel="icon" type="image/png" href="favicons/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/recuperar_senha.css">
</head>
<body>

    <?php
        include("includes.php");

        if(isset($_POST["BT_RECUPERAR"])){
            $REC_EMAIL = strtolower($_POST["rec_email"]);
            $REC_SENHA = $_POST["rec_nova_senha"];

            $array =
                $mysqli->query("select 
                                            count(1)
                                        from
                                            sys_users
                                        where
                                            Email_User = '".$REC_EMAIL."' 
                                        limit 1");
            $result = $array->fetch_all();

            if($result[0][0] == 1){

                $stmt = $mysqli->prepare("update sys_users set Senha_User = ? where Email_User = ? ");
                $stmt->bind_param("ss", $REC_SENHA, $REC_EMAIL);
                $stmt->execute();

                header("location: login.php?link=".urlencode('rec_success')."");
                exit;
                
            }elseif($result[0][0] == 0){
                $FS_CONFIG->fs_alerta("Email não encontrado ou incorreto!","erro");
            }
        }
    ?>

    <div class="card">
        <h3 class="text-center text-primary mb-3">Recuperar Senha</h3>
        <form method="POST" >
            <div class="mb-3">
                <input type="email" name="rec_email" id="rec_email" class="form-control" placeholder="Seu email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="rec_nova_senha" id="rec_nova_senha" class="form-control" placeholder="Nova senha" required>
            </div>
            <div class="mb-3">
                <input type="password" name="rec_confirma_senha" id="rec_confirma_senha" class="form-control" placeholder="Confirme a nova senha"
                    required>
            </div>
            <div class="d-grid">
                <button type="submit" name="BT_RECUPERAR" id="BT_RECUPERAR" class="btn btn-recuperar">Confirmar</button>
                <div class="text-center mt-2">
                    <a href="login.php" class="text-light" style="text-decoration: underline;">Volte para o login</a>
                </div>
            </div>
            <!-- exibe o script aqui -->
            <p id="menssagem"></p>
        </form>

        <script>
            const bt_recuperar = document.getElementById("BT_RECUPERAR");
            const rec_nova_senha = document.getElementById("rec_nova_senha");
            const rec_confirma_senha = document.getElementById("rec_confirma_senha");
            const menssagem = document.getElementById("menssagem");

            bt_recuperar.addEventListener("click", function (event){
                new_senha = rec_nova_senha.value;
                new_confirm_senha = rec_confirma_senha.value;

                if(new_senha != new_confirm_senha){
                    event.preventDefault();
                    menssagem.textContent = "Senhas divergentes!!";
                    menssagem.style.textAlign = "center"; 
                    menssagem.style.color = "red";

                    setTimeout(() => {
                        menssagem.textContent = '';
                    }, 3000);
                }
            }); 
        </script>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>