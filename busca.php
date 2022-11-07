<?php
    include_once("env.php");

    if (!isset($_GET['busca_loja'])) {
        header("Location: index.php");
        exit;
    }

    $loja_nome = "%".trim($_GET['busca_loja'])."%";

    $busca_loja = "SELECT * FROM cnab_doc WHERE NOME_LOJA LIKE '%".$loja_nome."%'";
    $resultado_busca = mysqli_query($conn, $busca_loja);
    $linha = $resultado_busca->fetch_object();

    echo "<pre>";
    var_dump($linha);
?>