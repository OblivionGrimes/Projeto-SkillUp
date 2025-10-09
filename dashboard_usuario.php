<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SkillUp - Dashboard</title>
  <link rel="icon" type="image/png" href="favicons/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard_usuario.css">
</head>

<body>
  <?php 
    include 'componentes/nav_bar.php'; 
    include("includes.php");

    if(!empty($_SESSION["S_User_ID"])) {

  ?>
  <div class="container py-5">
    <div class="welcome-card text-center mb-4 p-4">
      <h2 class="welcome-card-title">Bem-vindo, Usuário</h2>
      <p>Participe de um grupo agora mesmo.</p>
      <h4 class="welcome-card-points">Pontos: <span class="text-warning">150</span></h4>
    </div>


    <!-- Navegação -->
    <ul class="nav nav-pills mb-4" id="dashboardTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="grupos-tab" data-bs-toggle="pill" data-bs-target="#grupos" type="button"
          role="tab">Grupos</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="missoes-tab" data-bs-toggle="pill" data-bs-target="#missoes" type="button"
          role="tab">Tarefas</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pendencias-tab" data-bs-toggle="pill" data-bs-target="#pendencias" type="button"
          role="tab">Pendências</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="beneficios-tab" data-bs-toggle="pill" data-bs-target="#beneficios" type="button"
          role="tab">Benefícios</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="historico-tab" data-bs-toggle="pill" data-bs-target="#historico" type="button"
          role="tab">Histórico</button>
      </li>
    </ul>

    <!-- Conteúdo das abas -->
    <div class="tab-content" id="dashboardTabsContent">

      <!-- Grupos -->
      <div class="tab-pane fade show active" id="grupos" role="tabpanel">
        <h4>Grupos Disponíveis</h4>
        <div class="row g-3 mt-2">
          <div class="col-md-4">
            <div class="card p-3 text-center">
              <h5>Grupo de TI</h5> <br>
              <button class="btn btn-primary">Entrar</button> <br>
              <button class="btn btn-danger mt-2">Sair</button>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3 text-center">
              <h5>Grupo de Vendas</h5> <br>
              <button class="btn btn-primary">Entrar</button> <br>
              <button class="btn btn-danger mt-2">Sair</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Tarefas -->
      <div class="tab-pane fade" id="missoes" role="tabpanel">

        <!-- Grupo TI -->
        <h4>Tarefas do Grupo TI</h4>
        <div class="row g-3 mt-2 mb-4">
          <div class="col-md-4">
            <div class="card p-3 text-center">
              <h5>Curso X</h5>
              <p>50 pts</p>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detalheMissao">Detalhes</button>
            </div>
          </div>
        </div>
        <!-- Grupo de Vendas -->
        <h4>Tarefas do Grupo de Vendas</h4>
        <div class="row g-3 mt-2">
          <div class="col-md-4">
            <div class="card p-3 text-center">
              <h5>Curso Z</h5>
              <p>40 pts</p>
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detalheMissao">Detalhes</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Pendências -->
      <div class="tab-pane fade" id="pendencias" role="tabpanel">
        <h4>Evidências Avaliadas</h4>
        <div class="row g-3 mt-3">

          <!-- Aprovada -->
          <div class="col-md-4">
            <div class="card p-3 text-center border-success">
              <h5>Curso X</h5>
              <p>Grupo: <strong>Grupo de TI</strong></p>
              <p>Status: <span class="text-success fw-bold">Aprovada</span></p>
            </div>
          </div>

          <!-- Rejeitada -->
          <div class="col-md-4">
            <div class="card p-3 text-center border-danger">
              <h5>Curso Y</h5>
              <p>Grupo: <strong>Grupo de Vendas</strong></p>
              <p>Status: <span class="text-danger fw-bold">Rejeitada</span></p>
              <button class="btn btn-outline-danger btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#motivoModal">
                Ver motivo
              </button>
            </div>
          </div>

        </div>
      </div>

      <!-- Modal Motivo da Rejeição -->
      <div class="modal fade" id="motivoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title">Motivo da Rejeição</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <p><strong>Curso:</strong> Curso Y</p>
              <p><strong>Grupo:</strong> Grupo de Vendas</p>
              <p><strong>Motivo:</strong> O arquivo enviado estava ilegível ou incompleto. Por favor, envie novamente
                com qualidade adequada.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Benefícios -->
      <div class="tab-pane fade" id="beneficios" role="tabpanel">
        <h4>Benefícios Disponíveis</h4>
        <div class="row g-3 mt-2">
          <div class="col-md-4">
            <div class="card p-3 text-center">
              <h5>Vale-Livro</h5>
              <p>100 pts</p>
              <button class="btn-resgatar btn btn-warning">Resgatar</button>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3 text-center">
              <h5>Camiseta</h5>
              <p>60 pts</p>
              <button class="btn-resgatar btn btn-warning">Resgatar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Histórico -->
      <div class="tab-pane fade" id="historico" role="tabpanel">
        <h4>Histórico de Resgates</h4>
        <ul class="list-group">
          <li class="list-group-item">Camiseta | Grupo Vendas | 20/09 | 60 pts</li>
          <li class="list-group-item">Vale-Livro | Grupo TI | 25/09 | 100 pts</li>
        </ul>
      </div>
    </div>

    <!-- Botão de Sair -->
    <div class="mt-4">
      <a href="login.php" class="btn btn-danger">Sair</a>
    </div>
  </div>

  <!-- Modal Missão -->
  <div class="modal fade" id="detalheMissao" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-white">Detalhe da Missão</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="text-white"><strong>Missão:</strong> Curso X</p>
          <p class="text-white"><strong>Pontos:</strong> 50</p>
          <form enctype="multipart/form-data">
            <input type="file" name="evidencia" class="form-control mb-2" required>
            <button type="submit" class="btn btn-enviar">Enviar Evidência</button>
          </form>
        </div>
      </div>
    </div>
  </div>
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