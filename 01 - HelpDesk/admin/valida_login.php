<?php
// echo 'Teste OK';

// print_r($_GET);

// echo $_GET['email'];
// echo '<br>';
// echo $_GET['senha'];

// print_r($_GET);

// echo $_GET['email'];
// echo '<br>';
// echo $_GET['senha'];

session_start();

$usuario_autenticado = false;
$usuario_id = null;
$usuario_perfil_id = null;

$perfils = array(
    1 => 'administrativo',
    2 => 'usuario'
);

$usuario_app = array(
    array('id' => 1, 'email' => 'admi@a23.com', 'senha' => '1234', 'perfil_id' => 1),
    array('id' => 2, 'email' => 'user@a23.com', 'senha' => '1234', 'perfil_id' => 2)
);

foreach ($usuario_app as $user) {
    if ($user['email'] == $_POST['email'] && $user['senha'] == $_POST['senha']) {
        $usuario_autenticado = true;
        $usuario_id = $user['id'];
        $usuario_perfil_id =  $user['perfil_id'];
    };
};

if ($usuario_autenticado) {
    header('Location: home.php');
    $_SESSION['autenticado'] = 'SIM';
    $_SESSION['id'] = $usuario_id;
    $_SESSION['perfil_id'] = $usuario_perfil_id;
} else {
    // echo 'ERRO de Autenticacao';

    $_SESSION['autenticado'] = 'NAO';
    header('Location: index.php?login=erro');
};
