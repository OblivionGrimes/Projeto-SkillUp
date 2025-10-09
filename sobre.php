<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre - SkillUp</title>
    <link rel="icon" type="image/png" href="favicons/favicon.png">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/sobre.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include 'componentes/nav_bar.php'; ?>
    <div class="container py-5" style="padding-top:120px;">
        <h2 class="text-center mb-5" style="font-family: 'Orbitron', sans-serif; color: #ff0000;">Sobre os Desenvolvedores</h2>
        <div class="row justify-content-center g-4">
            <div class="col-md-4">
                <div class="card developer-card shadow-sm p-3 text-center">
                    <img src="imagens/img_maycon.jpeg" class="card-img-top rounded-circle mb-3" alt="Maycon da Silva" />
                    <h5 class="card-title">Maycon da Silva Conceição</h5>
                    <p class="card-text">Estudante de TI, curso de Sistemas de Informação. Apaixonado por desenvolvimento web e gamificação.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card developer-card shadow-sm p-3 text-center">
                    <img src="imagens/img_matheus.jpeg" class="card-img-top rounded-circle mb-3" alt="Matheus de Jesus" />
                    <h5 class="card-title">Matheus de Jesus Santos</h5>
                    <p class="card-text">Estudante de TI, curso de Sistemas de Informação. Focado em backend e lógica de programação.</p>
                </div>
            </div>
        </div>
    </div>
    <?php include 'componentes/footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
