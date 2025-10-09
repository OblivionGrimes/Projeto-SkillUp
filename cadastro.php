<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillUp - Cadastro</title>
    <link rel="icon" type="image/png" href="favicons/favicon.png">
    <link rel="stylesheet" href="css/cadastro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php
        include("includes.php");

        if(isset($_POST["BT_CADASTRAR"])){
            $USER = $_POST["user"];
            $EMAIL = strtolower($_POST["cad_email"]);
            $SENHA = $_POST["cad_senha"];
            $TIPO = ($_POST["role"] == "user") ? 1 : 2;
            $DATA = date("Y-m-d H:i:s");

            $array = 
                $mysqli->query("select 
                                            count(1)
                                        from
                                            sys_users
                                        where
                                            Email_User = '".$EMAIL."' and
                                            Tipo_user = '".$TIPO."'
                                        limit 1 "); 
            $res = $array->fetch_all();

            if($res[0][0] == 0){
                $stmt = $mysqli->prepare("insert into sys_users (Nome_User, Email_User, Senha_User, Tipo_user, Data_User) values (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssis", $USER, $EMAIL, $SENHA, $TIPO, $DATA);
                $stmt->execute();

                $FS_CONFIG->fs_alerta("Email cadastrado com sucesso!!","sucesso");
            }elseif($res[0][0] == 1){

                $FS_CONFIG->fs_alerta("Email já cadastrado anteriormente!","erro");
            }

        }

    ?>

    <!--Painel esquerdo-->
    <div class="left-panel">
        <h1>SKILL UP</h1>
        <h3 class="mt-4">Bem-vindo de volta!</h3>
        <p class="text-light">Acesse sua conta agora mesmo.</p>
        <form action="login.php" method="POST">
            <a href="login.php" class="btn btn-danger">Entrar</a>
        </form>
    </div>

    <!--Painel direito-->
    <div class="right-panel">
        <div class="container" style="max-width: 400px;">
            <h3 class="text-center">Crie sua conta</h3>
            <p class="text-center">Preencha seus dados</p>
            
            <form action="cadastro.php" method="POST">
                  <div class="mb-3">
                    <input type="text" name="user" id="user" class="form-control" placeholder="Nome" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="cad_email" id="cad_email" class="form-control" placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="cad_senha" id="cad_senha" class="form-control" placeholder="Senha" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="cad_confirma_senha" id="cad_confirma_senha" class="form-control" placeholder="Confirme sua senha"
                        required>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <div>
                        <input type="radio" id="user" name="role" value="user" checked required>
                        <label for="user">Usuário</label>
                    </div>
                    <div>
                        <input type="radio" id="admin" name="role" value="admin">
                        <label for="admin">Administrador</label>
                    </div>
                </div>

                <!-- exibe o script aqui -->
                <p id="menssagem"></p>

                <div class="d-grid">
                    <button type="submit" name="BT_CADASTRAR" id="BT_CADASTRAR" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>

            <script>
                const bt_cadastrar = document.getElementById("BT_CADASTRAR");
                const cad_senha = document.getElementById("cad_senha");
                const cad_confirma_senha = document.getElementById("cad_confirma_senha");
                const menssagem = document.getElementById("menssagem");

                bt_cadastrar.addEventListener("click", function (event){
                    new_senha = cad_senha.value;
                    new_confirm_senha = cad_confirma_senha.value;

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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>