<?php

require_once "config.php";

if ($_FILES['file_foto']['size'] != 0) {
    $foto = $_FILES['file_foto']['name'];

    $foto = str_replace(" ", "", $foto);

    // Caminho Temporario
    $foto_temp = $_FILES['file_foto']['tmp_name'];
    $destino = "img/" . $foto;
}

// Cadastrar
if (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar') {
    if (move_uploaded_file($foto_temp, $destino)) {
        $insert = $PDO->prepare("INSERT INTO banner (foto) VALUES (?)");
        $insert->bindValue(1, $foto);

        $insert->execute();

        header("Location: pg_banner.php");
    }
}

// Excluir
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    // echo "Cardapio Excluido: id= " . $_GET['id'] . "<br> Foto: " . $_GET['foto'];

    $id = $_GET['id'];
    $foto = $_GET['foto'];

    $del = $PDO->prepare("DELETE FROM banner WHERE id_banner = ? ");
    $del->bindValue(1, $id);
    $del->execute();

    unlink('img/' . $foto);
    header("Location: pg_banner.php");
}

// Editar
if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
    // echo "Cardapio Excluido: id= " . $_GET['id'] . "<br> Foto: " . $_GET['foto'];

    $id = $_GET['id'];
    $fotoDB = $_GET['foto'];

    // TESTAR
    if ($_FILES['file_foto']['size'] == 0) {
        header("Location: pg_banner.php");
    } else {
        unlink('img/' . $fotoDB);

        if (move_uploaded_file($foto_temp, $destino)) {
            $edit = $PDO->prepare("UPDATE banner SET foto = ? WHERE id_banner = ?");
            $edit->bindValue(1, $foto);
            $edit->bindValue(2, $id);

            $edit->execute();

            header("Location: pg_banner.php");
        }
    }
}

// echo "Cardapio: " . $cardapio . "<br> Foto: " . $foto;