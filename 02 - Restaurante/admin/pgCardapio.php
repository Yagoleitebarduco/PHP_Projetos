<?php
require_once 'config.php';
require_once 'menu.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assents/css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="./assents/js/script.js"></script>
</head>

<body>
    <div class="conteiner mt-3">
        <!-- Button Modal Cadastro - Inicio -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Adicionar Cardapio
        </button>

        <!-- Modal Cadastro -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> Cadastro de Cardapio </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form action="op_cardapio.php?acao=cadastrar" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Cardapio</label>
                                <input type="text" class="form-control" name="txt_cardapio"
                                    placeholder="Digite o nome do Cardapio">
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Foto</label>
                                <input class="form-control" type="file" name="file_foto">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Listagem Inicio -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cardapio</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>

            <tbody>

                <?php
                $lista = $PDO->query("SELECT * FROM cardapios");

                while ($listas = $lista->fetch(PDO::FETCH_ASSOC)) {
                    ?>

                    <tr>
                        <th scope="row"><?php echo $listas['id_cardapio'] ?></th>
                        <td><?php echo $listas['cardapio'] ?></td>
                        <td>
                            <img src="img/<?php echo $listas['foto'] ?>" width="100px" alt="Imagem">
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modalEditar<?php echo $listas['id_cardapio'] ?>">
                                Editar
                            </button>

                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalExcluir<?php echo $listas['id_cardapio'] ?>">
                                Excluir
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Editar - Inicio -->
                    <div class="modal fade" id="modalEditar<?php echo $listas['id_cardapio'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editar o Cardapio</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form
                                        action="op_cardapio.php?acao=editar&id=<?php echo $listas['id_cardapio'] ?>&op_cardapio.php?acao=editar&foto=<?php echo $listas['foto'] ?>"
                                        method="post" enctype="multipart/form-data">

                                        <div class="mb-3">
                                            <label class="form-label">Cardapio</label>
                                            <input type="text" class="form-control" name="txt_cardapio"
                                                placeholder="Digite o nome do Cardapio"
                                                value="<?php echo $listas['cardapio'] ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Foto</label>
                                            <input class="form-control" type="file" name="file_foto">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Editar - Fim -->


                    <!-- Modal Excluir - Inicio -->
                    <div class="modal fade" id="modalExcluir<?php echo $listas['id_cardapio'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja Excluir o Cardapio</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <a href="op_cardapio.php?acao=excluir&id=<?php echo $listas['id_cardapio'] ?>&op_cardapio.php?acao=excluir&foto=<?php echo $listas['foto'] ?>"
                                        class="btn btn-primary">Sim</a>
                                    <button class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal-Excluir - Fim -->

                    <?php
                }
                ?>
                <!-- 
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr> 
                -->
            </tbody>
        </table>
        <!-- Listagem Fim -->

    </div>

    <!--
    <h1> Admin - restaurante </h1> 
    -->
</body>

</html>