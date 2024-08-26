<?php

require_once "config.php";

if(!empty($_POST['txt_cardapio'])) {
    $cardapio = $_POST['txt_cardapio'];
    $foto = $_FILES['file_foto']['name'];

    $foto = str_replace(" ", "", $foto);

    // Caminho Temporario
    $foto_temp = $_FILES['file_foto']['tmp_name'];
    $destino = "img/" . $foto;

    if(move_uploaded_file($foto_temp, $destino)) {
        $insert = $PDO->prepare("INSERT INTO cardapios (cardapio, foto) VALUES (?, ?)");
        $insert->bindValue(1, $cardapio);
        $insert->bindValue(2, $foto);

        $insert->execute();

        header("Location: pgCardapio.php");
    }
}

if(isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    echo "Cardapio Excluido: id= " . $_GET['id'] . "<br> Foto: " . $_GET['foto'];
}

// echo "Cardapio: " . $cardapio . "<br> Foto: " . $foto;