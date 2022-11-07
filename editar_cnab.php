<h1>Editar CNAB</h1>

<?php

    $cnab_result = "SELECT * FROM cnab_doc WHERE ID=".$_REQUEST["id"];
    $cnab_resultado = mysqli_query($conn, $cnab_result);
    $linha = $cnab_resultado->fetch_object();
    // var_dump($linha);
?>

<form action="?page=salvar" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?php print $linha->ID; ?>">
    <div class="mb-3">
        <label>Tipo da transação</label>
        <input type="text" name="tipo_transacao" value="<?php print $linha->TIPO_TRANSACAO ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Data</label>
        <input type="date" name="data_transacao" value="<?php print $linha->DATA ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Valor</label>
        <input type="text" name="valor_transacao" value="<?php print $linha->VALOR ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>CPF</label>
        <input type="text" name="cpf" value="<?php print $linha->CPF ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Cartão</label>
        <input type="text" name="cartao_transacao" value="<?php print $linha->CARTAO ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Hora da transação</label>
        <input type="time" name="hora_transacao" value="<?php print $linha->HORA ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Loja</label>
        <input type="text" name="loja" value="<?php print $linha->NOME_LOJA ?>" class="form-control">
    </div>
    <div class="mb-3">
        <label>Dono da loja</label>
        <input type="text" name="dono_loja" value="<?php print $linha->DONO_LOJA ?>" class="form-control">
    </div>
    <div class="mb-3" style="margin-top: 13px;">
        <input class="btn btn-primary" type="submit">
    </div>
</form>