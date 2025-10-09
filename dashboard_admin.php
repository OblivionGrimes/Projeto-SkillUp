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
          <form class="d-flex mb-4">
            <input type="text" name="nome_grupo" class="form-control me-4" placeholder="Nome do grupo" required>
            <button type="submit" class="btn btn-primary">Criar</button>
          </form>

          <h4>Grupos Existentes</h4>
          <div class="row g-3 mt-2">
            <div class="col-md-4">
              <div class="card p-3 text-center">
                <h5 class="text-white">Grupo TI</h5>
                <div class="d-flex justify-content-center gap-2 mt-2">
                  <button class="btn btn-danger btn-sm">Excluir</button>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card p-3 text-center">
                <h5 class="text-white">Grupo Vendas</h5>
                <div class="d-flex justify-content-center gap-2 mt-2">
                  <button class="btn btn-danger btn-sm">Excluir</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Missões -->
        <div class="tab-pane fade" id="missoes" role="tabpanel">
          <h4>Criar Missão</h4>
          <form class="mb-4">
            <div class="mb-2">
              <input type="text" name="nome_missao" class="form-control" placeholder="Nome da missão" required>
            </div>
            <div class="mb-2">
              <input type="number" name="pontos" class="form-control" placeholder="Pontos" required>
            </div>
            <div class="mb-2">
              <select name="grupo" class="form-select" required>
                <option value="">Selecione o grupo</option>
                <option value="TI">TI</option>
                <option value="Vendas">Vendas</option> 
              </select>
              <br>
            </div>
            <button type="submit" class="btn btn-primary">Criar Missão</button>
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
