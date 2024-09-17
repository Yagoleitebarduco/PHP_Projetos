<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <!-- As a heading -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1 mx-auto">Sistema de Contato</span>
        </div>
    </nav>

    <section>
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
    </section>
    
    <footer>
        <nav class="navbar">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 mx-auto">&copy; Todos os Direitos reservados</span>
            </div>
        </nav>
    </footer>

    <script src"assets/js/bootstrap.min.js"></script>
</body>

</html>