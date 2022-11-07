<h1>Listar transações</h1>

<form action="" method="POST">
    <div class="row">
        <div class="col">
            <label>Buscar por loja</label>
            <input type="text" name="busca_loja" class="form-control" value="<?php $busca ?>">
        </div>
        <div class="col d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </div>
</form><br>

<?php

    $listagem = "SELECT * FROM cnab_doc";

    $resultado_listar = mysqli_query($conn, $listagem);

    $qtd_linhas = $resultado_listar->num_rows;

    if(!isset($_POST['busca_loja'])) {

        if ($qtd_linhas > 0) {
        
            print "<table class='table table-hover table-bordered'>";
            print "<tr>";
                print "<th>#</th>";
                print "<th>Tipo da transação</th>";
                print "<th>Data</th>";
                print "<th>Valor</th>";
                print "<th>CPF</th>";
                print "<th>Cartão</th>";
                print "<th>Hora</th>";
                print "<th>Proprietário</th>";
                print "<th>Nome da loja</th>";
                print "<th>Ação</th>";
            print "</tr>"; 

            while($linha = $resultado_listar->fetch_object()) {

                print "<tr>";
                print "<td>" . $linha->ID . "</td>";
                print "<td>" . $linha->TIPO_TRANSACAO . "</td>";
                print "<td>" . date("d/m/Y", strtotime($linha->DATA)) . "</td>";
                print "<td>R$" . $linha->VALOR . "</td>";
                print "<td>" . $linha->CPF . "</td>";
                print "<td>" . $linha->CARTAO . "</td>";
                print "<td>" . $linha->HORA . "</td>";
                print "<td>" . $linha->DONO_LOJA . "</td>";
                print "<td>" . $linha->NOME_LOJA . "</td>";
                print "<td>
                        <button onclick=\"location.href='?page=editar&id=" . $linha->ID 
                        . "';\" class='btn btn-success'>
                        Editar</button>
                        
                        <button onclick=\"
                        if(confirm('Tem certeza que deseja excluir este registro?')){location.href='?page=salvar&acao=excluir&id=" . $linha->ID . "';}else{false;}\" 
                        class='btn btn-danger'>
                        Excluir</button>
                       </td>";
                print "</tr>";       
            }
            print "</table>";
        } else {
            print "<p class='alert alert-danger'> Nenhum resultado encontrado!</p>";
        }
    } else if(isset($_POST['busca_loja'])) {

        $lista_filtrada = "SELECT * FROM cnab_doc WHERE NOME_LOJA LIKE '%" . $_POST['busca_loja'] . "%'";
        $saldo_total = "SELECT ID, sum(case when TIPO_TRANSACAO = 2 OR TIPO_TRANSACAO = 3 OR TIPO_TRANSACAO = 9 THEN -VALOR ELSE VALOR END) AS 'VALOR' FROM cnab_doc GROUP BY ID ORDER BY ID";
        

        $resultado_filtro = mysqli_query($conn, $lista_filtrada);
        $resultado_saldo = mysqli_query($conn, $saldo_total);

        if ($resultado_filtro && $resultado_saldo) {
            
            print "<table class='table table-hover table-bordered'>";
            print "<tr>";
                print "<th>#</th>";
                print "<th>Tipo da transação</th>";
                print "<th>Data</th>";
                print "<th>Valor</th>";
                print "<th>CPF</th>";
                print "<th>Cartão</th>";
                print "<th>Hora</th>";
                print "<th>Proprietário</th>";
                print "<th>Nome da loja</th>";
                // print "<th>Saldo em conta</th>";
                print "<th>Ação</th>";
            print "</tr>";

            while (($filtro = mysqli_fetch_assoc($resultado_filtro)) && ($filtro_saldo = mysqli_fetch_assoc($resultado_saldo))) {
                print "<tr>";
                print "<td>" . $filtro['ID'] . "</td>";
                print "<td>" . $filtro['TIPO_TRANSACAO'] . "</td>";
                print "<td>" . $filtro['DATA'] . "</td>";
                print "<td>R$" . $filtro['VALOR'] . "</td>";
                print "<td>" . $filtro['CPF'] . "</td>";
                print "<td>" . $filtro['CARTAO'] . "</td>";
                print "<td>" . $filtro['HORA'] . "</td>";
                print "<td>" . $filtro['DONO_LOJA'] . "</td>";
                print "<td>" . $filtro['NOME_LOJA'] . "</td>";
                // print "<td>" . $filtro_saldo['VALOR'] . "</td>";
                print "<td>
                    <button onclick=\"location.href='?page=editar&id=" . $filtro['ID'] 
                    . "';\" class='btn btn-success'>
                    Editar</button>
                    
                    <button onclick=\"
                    if(confirm('Tem certeza que deseja excluir este registro?')){location.href='?page=salvar&acao=excluir&id=" . $filtro['ID'] . "';}else{false;}\" 
                    class='btn btn-danger'>
                    Excluir</button>
                    </td>";
                print "</tr>";
            }
            print "</table>";
        } else {
            print "<p class='alert alert-danger'> Nenhum resultado encontrado!</p>";
        }
    }

?>