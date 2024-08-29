<?php

require_once "config.php";

if ($_FILES['file_foto']['size'] != 0) {
    $prato = $_POST['txt_prato'];
    $cardapio = $_POST['txt_cardapio'];
    $foto = $_FILES['file_foto']['name'];

    $foto = str_replace(" ", "", $foto);

    // Caminho Temporario
    $foto_temp = $_FILES['file_foto']['tmp_name'];
    $destino = "img/" . $foto;
}

// Cadastrar
if (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar') {
    if (move_uploaded_file($foto_temp, $destino)) {
        $insert = $PDO->prepare("INSERT INTO pratos (id_cardapio, prato, foto) VALUES (?, ?, ?)");
        $insert->bindValue(1, $cardapio);
        $insert->bindValue(2, $prato);
        $insert->bindValue(3, $foto);

        $insert->execute();

        header("Location: pg_prato.php");
    }
}

// Excluir
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {

    $id = $_GET['id'];
    $foto = $_GET['foto'];

    $del = $PDO->prepare("DELETE FROM pratos WHERE id_pratos = ? ");
    $del->bindValue(1, $id);

    $del->execute();

    unlink('img/' . $foto);
    header("Location: pg_prato.php");
}

// Editar
if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
    $id = $_GET['id'];
    $fotoDB = $_GET['foto'];
    $id_cardapio = $_POST['txt_cardapio'];

    // TESTAR
    if ($_FILES['file_foto']['size'] == 0) {
        $edit = $PDO->prepare("UPDATE pratos SET prato = ?, id_cardapio = ? WHERE id_pratos = ?");
        $edit->bindValue(1, $prato);
        $edit->bindValue(2, $id_cardapio);
        $edit->bindValue(3, $id);
        $edit->execute();

        header("Location: pg_prato.php");
    } else {
        unlink('img/' . $fotoDB);

        if (move_uploaded_file($foto_temp, $destino)) {
            $edit = $PDO->prepare("UPDATE pratos SET prato = ?, id_cardapio = ?, foto = ? WHERE id_pratos = ?");
            $edit->bindValue(1, $prato);
            $edit->bindValue(2, $id_cardapio);
            $edit->bindValue(3, $foto);
            $edit->bindValue(4, $id);

            $edit->execute();

            header("Location: pg_prato.php");
        }
    }
}