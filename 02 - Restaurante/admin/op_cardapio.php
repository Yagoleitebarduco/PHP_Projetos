<?php

require_once "config.php";

$cardapio = $_POST['txt_cardapio'];
$foto = $_FILES['file_foto']['name'];

echo "Cardapio: " . $cardapio . "<br> Foto: " . $foto;