<?php

require_once "config.php";

if (!empty($_POST['txt_cardapio'])) {
    $cardapio = $_POST['txt_cardapio'];
    $foto = $_FILES['file_foto']['name'];

    $foto = str_replace(" ", "", $foto);

    // Caminho Temporario
    $foto_temp = $_FILES['file_foto']['tmp_name'];
    $destino = "img/" . $foto;
}

// Cadastra
if (isset($_GET['acao']) && $_GET['acao'] == 'cadastrar') {
    if (move_uploaded_file($foto_temp, $destino)) {
        $insert = $PDO->prepare("INSERT INTO cardapios (cardapio, foto) VALUES (?, ?)");
        $insert->bindValue(1, $cardapio);
        $insert->bindValue(2, $foto);

        $insert->execute();

        header("Location: pgCardapio.php");
    }
}

// Excluir
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir') {
    // echo "Cardapio Excluido: id= " . $_GET['id'] . "<br> Foto: " . $_GET['foto'];

    $id = $_GET['id'];
    $foto = $_GET['foto'];

    $del = $PDO->prepare("DELETE FROM cardapios WHERE id_cardapio = ? ");
    $del->bindValue(1, $id);
    $del->execute();

    unlink('img/' . $foto);
    header("Location: pgCardapio.php");
}

// Editar
if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
    // echo "Cardapio Excluido: id= " . $_GET['id'] . "<br> Foto: " . $_GET['foto'];

    $id = $_GET['id'];
    $fotoDB = $_GET['foto'];

    // TESTAR
    if ($_FILES['file_foto']['size'] == 0) {
        // echo 'Sem Foto';
        $edit = $PDO->prepare("UPDATE cardapios SET cardapio = ? WHERE id_cardapio = ?");
        $edit->bindValue(1, $cardapio);
        $edit->bindValue(2, $id);
        $edit->execute();

        header("Location: pgCardapio.php");
    } else {
        // echo 'Com Foto';

        unlink('img/' . $fotoDB);

        if (move_uploaded_file($foto_temp, $destino)) {
            $edit = $PDO->prepare("UPDATE cardapios SET cardapio = ?, foto = ? WHERE id_cardapio = ?");
            $edit->bindValue(1, $cardapio);
            $edit->bindValue(2, $foto);
            $edit->bindValue(3, $id);

            $edit->execute();

            header("Location: pgCardapio.php");
        }
    }
}

// echo "Cardapio: " . $cardapio . "<br> Foto: " . $foto;