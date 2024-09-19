<?php
if($error == 'exist'){
    echo '<p class="alert alert-danger">Email já Cadastrado</p>';
} 
?>

<div class="container mt-3">
    <h3>Adicionar</h3>

    <form method="POST" action="<?php echo BASE_URL ?>contatos/add_save">
        <!-- Formulario - Inicio -->
        <div class="mb-3">
            <label class="form-label">Nome: </label>
            <input type="text" class="form-control" name="nome">
        </div>

        <div class="mb-3">
            <label class="form-label">Email: </label>
            <input type="email" class="form-control" name="email">
        </div>

        <button type="submit" class="btn btn-primary">Adicionar</button>
        <!-- Formulario - Fim -->
    </form>
</div>