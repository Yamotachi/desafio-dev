<?php
    switch ($_REQUEST["acao"]) {
        case 'cadastrar':
            session_start();
            include_once("env.php");

            $msg = false;
            // $arquivo = $_FILES['arquivo'];

            if(isset($_FILES['arquivo'])){

                $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
                $dados = file($arquivo_tmp);

                foreach ($dados as $linha) {
                    $linha = trim($linha);
                    $valor_exp = explode(',', $linha);
                    // var_dump($valor_exp);
                    
                    $tipo_transacao = $valor_exp[0];
                    $data = $valor_exp[1];
                    $valor = $valor_exp[2];
                    $cpf = $valor_exp[3];
                    $cartao = $valor_exp[4];
                    $hora = $valor_exp[5];
                    $dono_loja = $valor_exp[6];
                    $nome_loja = $valor_exp[7];
                    $id = $valor_exp[8];

                    $cnab_result = "INSERT INTO cnab_doc (TIPO_TRANSACAO, DATA, VALOR, CPF, CARTAO, HORA, DONO_LOJA, NOME_LOJA, ID)
                    VALUES ('$tipo_transacao', '$data', '$valor', '$cpf', '$cartao', '$hora', '$dono_loja', '$nome_loja', '$id')";

                    $cnab_resultado = mysqli_query($conn, $cnab_result);
                }

                if($cnab_resultado==true){
                    print "<script>alert('Arquivo enviado com sucesso!');</script>";
                    print "<script>location.href='?page=listar';</script>";
                } else {
                    print "<script>alert('Falha ao enviar o arquivo.');</script>";
                    print "<script>location.href='?page=listar';</script>";
                }

            }
            break;

        case 'editar':
            
            $tipo_transacao = $_POST["tipo_transacao"];
            $data = $_POST["data_transacao"];
            $valor = $_POST["valor_transacao"];
            $cpf = $_POST["cpf"];
            $cartao = $_POST["cartao_transacao"];
            $hora = $_POST["hora_transacao"];
            $dono_loja = $_POST["loja"];
            $nome_loja = $_POST["dono_loja"];
            $id = $_POST["id"];

            $cnab_result = "UPDATE cnab_doc SET
                                TIPO_TRANSACAO='{$tipo_transacao}',
                                DATA='{$data}',
                                VALOR='{$valor}',
                                CPF='{$cpf}',
                                CARTAO='{$cartao}',
                                HORA='{$hora}',
                                DONO_LOJA='{$dono_loja}',
                                NOME_LOJA='{$nome_loja}'
                            WHERE
                                ID=".$_REQUEST["id"];

            $cnab_resultado = mysqli_query($conn, $cnab_result);

            if($cnab_resultado==true){
                print "<script>alert('Editado com sucesso!');</script>";
                print "<script>location.href='?page=listar';</script>";
            } else {
                print "<script>alert('Não foi possível editar.');</script>";
                print "<script>location.href='?page=listar';</script>";
            }
            break;

        case 'excluir':
            
            $cnab_result = "DELETE FROM cnab_doc WHERE id=".$_REQUEST["id"];

            $cnab_resultado = mysqli_query($conn, $cnab_result);

            if($cnab_resultado==true){
                print "<script>alert('Excluido com sucesso!');</script>";
                print "<script>location.href='?page=listar';</script>";
            } else {
                print "<script>alert('Não foi possível excluir o registro.');</script>";
                print "<script>location.href='?page=listar';</script>";
            }
            break;
    }