<?php
    // Conexão com o banco de dados
    $BD = "skill_up";
    $HOST = "root";
    $PASSWORD = "";
    $SERVER = "localhost";

    $mysqli = new mysqli($SERVER, $HOST, $PASSWORD, $BD);

    if ($mysqli->connect_error) {
        echo "erro: ".$mysqli->connect_error;
    }
    

    session_start();

    ############## FORM DO login.php ###################
    if(isset($_POST["BT_LOGIN"])){
        $EMAIL = $_POST["login_email"];
        $SENHA = $_POST["login_senha"];

        $array = 
            $mysqli->query("select
                                        *
                                    from
                                        sys_users
                                    where
                                        Email_User = '".$EMAIL."' and
                                        Senha_User = '".$SENHA."' 
                                    limit 1");
        $result = $array->fetch_assoc();

        if(!empty($result)){

            $_SESSION["S_User_ID"] = $result["User_ID"];
            $_SESSION["S_Nome_User"] = $result["Nome_User"];
            $_SESSION["S_Email_User"] = $result["Email_User"];
            $_SESSION["S_Tipo_User"] = $result["Tipo_user"];

            if($result["Tipo_user"] == 1){
                header("location: dashboard_usuario.php");
                exit;
            }elseif($result["Tipo_user"] == 2){
                header("location: dashboard_admin.php");
                exit;
            }
        }elseif(empty($result)){
            $url = "login_error";
            header("location: login.php?link=".urlencode($url)."");
            exit;
        }

    }
    ################################################

?>