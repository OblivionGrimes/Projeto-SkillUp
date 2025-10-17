<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkillUp - Dashboard ADM</title>
  <link rel="icon" type="image/png" href="favicons/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard_admin.css">
  <link rel="stylesheet" href="css/navbar.css">
  <link rel="stylesheet" href="css/footer.css">
</head>

<body>
  <?php 
    include 'componentes/nav_bar.php'; 
    
    include("includes.php");

    if(!empty($_SESSION["S_User_ID"])) {

      // ainda não esta fazendo nada (setando)
      $Nome_Grupo = '';
      $ID_Grupo = '';
      $ID_MISSAO = '';
      $OBS_MISSAO = '';

      if(isset($_POST['BT_EDIT_GRUPO'])){
        $ID_Grupo = base64_decode($_POST['ID_Grupo']);

        $array_gp =
          $mysqli->query("select 
                                    Nome_Grupo,
                                    ID_Grupo
                                  from
                                    cad_grupos
                                  where
                                    ID_Grupo = '".$ID_Grupo."' and
                                    FK_User_ID = '".$_SESSION['S_User_ID']."'
                                  limit 1 ");
        $resG = $array_gp->fetch_all();
        $Nome_Grupo = $resG[0][0];
        $ID_Grupo = $resG[0][1];

      }

      // Form do grupo
      if(isset($_POST["BT_SALVAR_GRUPO"])) {
        $Nome_Grupo = trim($_POST["Nome_Grupo"]);
        $ID_Grupo = $_POST["ID_Grupo"];
        $Data_Grupo = date("Y-m-d H:i:s");
        $Exc_Grupo = 0;

        if($ID_Grupo == '') { // criação

          $stmt = $mysqli->prepare('insert into cad_grupos (FK_User_ID, Nome_Grupo, Exc_Grupo, Data_Grupo) values (?, ?, ?, ?)');
          $stmt->bind_param('isis', $_SESSION['S_User_ID'], $Nome_Grupo, $Exc_Grupo, $Data_Grupo);
          $stmt->execute();

          if($stmt->error){
            $FS_CONFIG->fs_alerta('Algo inesperado aconteceu!','erro');
          }else{
            $FS_CONFIG->fs_alerta('Grupo criado com sucesso!','sucesso');
          }

        }elseif($ID_Grupo != '') { // Atualização

          $stmt = $mysqli->prepare('update cad_grupos set Nome_Grupo = ? where ID_Grupo = ?');
          $stmt->bind_param('si', $Nome_Grupo, $ID_Grupo);
          $stmt->execute();
          
          $Nome_Grupo = '';
          $ID_Grupo = '';

          if($stmt->error){
            $FS_CONFIG->fs_alerta('Algo inesperado aconteceu!','erro');
          }else{
            $FS_CONFIG->fs_alerta('Nome do grupo atualizado com sucesso!','sucesso');
          }

        }
      } // Fim Form do grupo

      // EXC Grupo
      if(isset($_POST['BT_EXC_GRUPO'])) {
        $ID_Grupo = base64_decode($_POST['ID_Grupo']);
        $Exc_Grupo = 1;

        $stmt = $mysqli->prepare('update cad_grupos set Exc_Grupo = ? where ID_Grupo = ? and FK_User_ID = ?');
        $stmt->bind_param("iii", $Exc_Grupo, $ID_Grupo, $_SESSION['S_User_ID']);
        $stmt->execute();

        if($stmt->error){
          $FS_CONFIG->fs_alerta('Algo inesperado aconteceu!','erro');
        }else{
          $FS_CONFIG->fs_alerta('Grupo excluido com sucesso!','sucesso');
          $ID_Grupo = '';
        }

      } // Fim exc grupo

      // Salvando as missões 
      if(isset($_POST['BT_SALVAR_MISSAO'])) {
        $ID_MISSAO = base64_decode($_POST['ID_MISSAO']);
        $ID_Grupo = base64_decode($_POST['id_grupo']);
        $OBS_MISSAO = trim($_POST['obs_missao']);
        $PONTOS = $_POST['pontos'];
        $NOME_MISSAO = $_POST['nome_missao'];
        $DATA_MISSAO = date("Y-m-d H:m:s");

        if($ID_MISSAO == ''){
          $stmt = $mysqli->prepare("insert into cad_missao (FK_User_ID, FK_ID_Grupo, Nome_Missao, Obs_Missao, Pontos_Missao, Data_Missao) values (?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("iissis", $_SESSION['S_User_ID'], $ID_Grupo, $NOME_MISSAO, $OBS_MISSAO, $PONTOS, $DATA_MISSAO);
          $stmt->execute();

          if($stmt->error){
            $FS_CONFIG->fs_alerta('Algo inesperado aconteceu!','erro');
          }else{
            $FS_CONFIG->fs_alerta('Missão criada com sucesso!','sucesso');
          }
        }elseif($ID_MISSAO != ''){
          $stmt = $mysqli->prepare("update cad_missao set FK_User_ID = ?, FK_ID_Grupo = ?, Nome_Missao = ?, Obs_Missao = ?, Pontos_Missao = ?, Data_Missao = ? where ID_Missao = ?");
          $stmt->bind_param("iissis", $_SESSION['S_User_ID'], $ID_Grupo, $NOME_MISSAO, $OBS_MISSAO, $PONTOS, $DATA_MISSAO, $ID_MISSAO);
          $stmt->execute();

          if($stmt->error){
            $FS_CONFIG->fs_alerta('Algo inesperado aconteceu!','erro');
          }else{
            $FS_CONFIG->fs_alerta('Missão atualizada com sucesso!','sucesso');
          }
        }

      } // Fim salvando as missões 

  ?>
  <main class="content-wrapper"> 
    <div class="container py-5">
      <h2 class="mb-4">Painel do Administrador</h2>

      <!-- Navegação por abas -->
      <ul class="nav nav-pills mb-4" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="grupos-tab" data-bs-toggle="pill" data-bs-target="#grupos" type="button"
            role="tab">Grupos</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="missoes-tab" data-bs-toggle="pill" data-bs-target="#missoes" type="button"
            role="tab">Missões</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="beneficios-tab" data-bs-toggle="pill" data-bs-target="#beneficios" type="button"
            role="tab">Benefícios</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="evidencias-tab" data-bs-toggle="pill" data-bs-target="#evidencias" type="button"
            role="tab">Evidências</button>
        </li>
      </ul>

      <div class="tab-content" id="adminTabsContent">

        <!-- Grupos -->
        <div class="tab-pane fade show active" id="grupos" role="tabpanel">
          <h4>Criar Grupo</h4>
          <form method="POST" class="d-flex mb-4">
            <input type="text" name="Nome_Grupo" id="Nome_Grupo" value="<?php echo $Nome_Grupo ?>" class="form-control me-4" placeholder="Nome do grupo" required>
            <input type="hidden" name="ID_Grupo" id="ID_Grupo" value="<?php echo $ID_Grupo; ?>" class="form-control me-4" placeholder="Nome do grupo"> <!-- Adicionar o retorno do ID_Grupo aqui -->
            <button type="submit" name="BT_SALVAR_GRUPO" id="BT_SALVAR_GRUPO" class="btn btn-primary">Criar</button>
          </form>

          <h4>Grupos Existentes</h4>
          <div class="row g-3 mt-2">
              <?php
                $array = 
                  $mysqli->query("select
                                          *
                                        from
                                          cad_grupos
                                        where
                                          FK_User_ID = '".$_SESSION['S_User_ID']."' and
                                          Exc_Grupo = 0
                                        order by
                                          Nome_Grupo ");
                while($row = $array->fetch_assoc()) {
              ?>
                <div class="col-md-4">
                  <div class="card p-3 text-center">
                    <h5 class="text-white"><?php echo $row['Nome_Grupo'] ?></h5>
                    <div class="d-flex justify-content-center gap-2 mt-2">
                      <form method="POST">
                        <input type="hidden" name="ID_Grupo" id="ID_Grupo" value="<?php echo base64_encode($row['ID_Grupo']); ?>">
                        <button type="submit" name="BT_EDIT_GRUPO" id="BT_EDIT_GRUPO" class="btn btn-info btn-sm">Editar</button>
                        <button type="submit" name="BT_EXC_GRUPO" id="BT_EXC_GRUPO" class="btn btn-danger btn-sm">Excluir</button>
                      </form>
                    </div>
                  </div>
                </div>
              <?php
                }
              ?>
            </div>
        </div>

        <!-- Missões -->
        <div class="tab-pane fade" id="missoes" role="tabpanel">
          <h4>Criar Missão</h4>
          <form method="POST" class="mb-4">
            <div class="mb-2">
              <input type="text" name="nome_missao" id="nome_missao" class="form-control" placeholder="Nome da missão" required>
            </div>
            <div class="mb-2">
              <input type="number" name="pontos" id="pontos" class="form-control" placeholder="Pontos" required min="1" max="1000">
            </div>
            <div class="mb-2">
              <select name="id_grupo" id="id_grupo" class="form-select" required>
                <?php
                  $array_S =
                    $mysqli->query("select 
                                              Nome_Grupo,
                                              ID_Grupo
                                            from
                                              cad_grupos
                                            where
                                              (FK_User_ID = '".$_SESSION['S_User_ID']."' or ID_Grupo = 1) and
                                              Exc_Grupo = 0");
                  while($rowS = $array_S->fetch_assoc()) {
                ?>
                  <option value="<?php echo base64_encode($rowS['ID_Grupo']); ?>"><?php echo $rowS['Nome_Grupo']; ?></option>
                <?php
                  }
                ?>
              </select>
              <br>
            </div>
            <div class="mb-2">
              <input type="text" name="obs_missao" id="obs_missao" value="<?php echo $OBS_MISSAO; ?>" class="form-control" placeholder="Observações">
              <input type="hidden" name="ID_MISSAO" id="ID_MISSAO" value="<?php echo base64_encode($ID_MISSAO); ?>">
            </div>
            <br>
            <button type="submit" name="BT_SALVAR_MISSAO" id="BT_SALVAR_MISSAO" class="btn btn-primary">Criar Missão</button>
          </form>

          <h4>Missões Existentes</h4>
          <div class="row g-3 mt-2">
            <div class="col-md-4">
              <div class="card p-3 text-center">
                <h5 class="text-white">Curso X</h5>
                <p>Pontos: 50 | Grupo: TI</p>
                <div class="d-flex justify-content-center gap-2 mt-2">
                  <button class="btn btn-danger btn-sm">Excluir</button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card p-3 text-center">
                <h5 class="text-white">Curso Y</h5>
                <p>Pontos: 70 | Grupo: Vendas</p>
                <div class="d-flex justify-content-center gap-2 mt-2">
                  <button class="btn btn-danger btn-sm">Excluir</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Benefícios -->
        <div class="tab-pane fade" id="beneficios" role="tabpanel">
          <h4>Criar Benefício</h4>
          <form class="mb-4">
            <div class="mb-2">
              <input type="text" name="nome_beneficio" class="form-control" placeholder="Nome do benefício" required>
            </div>
            <div class="mb-2">
              <input type="number" name="pontos_necessarios" class="form-control" placeholder="Pontos necessários"
                required>
            </div>
            <div class="mb-2">
              <select name="grupo" class="form-select" required>
                <option value="">Selecione o grupo</option>
                <option value="TI">TI</option>
                <option value="Vendas">Vendas</option>
              </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Criar Benefício</button>
          </form>

          <h4>Benefícios Existentes</h4>
          <div class="row g-3 mt-2">
            <div class="col-md-4">
              <div class="card p-3 text-center">
                <h5 class="text-white">Vale-Livro</h5>
                <p>Pontos: 100 | Grupo: TI</p>
                <div class="d-flex justify-content-center gap-2 mt-2">
                  <button class="btn btn-danger btn-sm">Excluir</button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card p-3 text-center">
                <h5 class="text-white">Camiseta</h5>
                <p>Pontos: 60 | Grupo: Vendas</p>
                <div class="d-flex justify-content-center gap-2 mt-2">
                  <button class="btn btn-danger btn-sm">Excluir</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Aba Evidências Pendentes -->
        <div class="tab-pane fade" id="evidencias" role="tabpanel">
          <h4>Evidências Pendentes</h4>
          <div class="row g-3 mt-2">

            <!-- Card -->
            <div class="col-md-4">
              <div class="card p-3 text-center">
                <p><strong>Usuário:</strong> João</p>
                <p><strong>Grupo:</strong> TI</p>
                <p><strong>Missão:</strong> Curso X</p>
                <div class="d-flex justify-content-center gap-2 mt-2">
                  <button class="btn btn-success btn-sm">Aprovar</button>
                  <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejeitarModal1">
                    Rejeitar
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Rejeição Card-->
        <div class="modal fade" id="rejeitarModal1" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Rejeitar Evidência</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                <p class="text-dark"><strong>Usuário:</strong> João</p>
                <p class="text-dark"><strong>Missão:</strong> Curso X</p>
                <label for="motivo1"><strong class="text-dark">Motivo da Rejeição:</strong></label>
                <textarea id="motivo1" class="form-control" rows="3" placeholder="Digite o motivo..."></textarea>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Rejeitar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main> 
      <?php 
        include 'componentes/footer.php';

        mysqli_close($mysqli);

        // Fechamento do if que faz verificação se existe um usuario verificado previamente.
        }else{
            session_unset();
            session_destroy();
            
            header("location: login.php");
            exit;
        } 

      ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
