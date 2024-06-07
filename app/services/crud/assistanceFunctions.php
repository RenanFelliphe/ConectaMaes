<?php

    $hostname = '162.240.17.101';
    $username = 'projetos_nlessa';
    $password = 'Gc&sgY74PK$}';
    $database = 'projetos_INF2023_G10';

    $conn = mysqli_connect($hostname, $username, $password, $database);

    // SEND ASSISTANCES - CREATE
        function sendAssistances($conn) {
            if(isset($_POST['enviar']) AND !empty($_POST['conteudoEnvio'])){
                $err = array();
                    
                if(isset($_GET['algumaCondicaoDeErro'])){
                    $err[] = "Algo deu Errado!";
                }
        
                if(empty($err)){
                    $insertNewUser = "INSERT INTO TABELA (ATRIBUTOS) VALUES ('$ VARIAVEIS')";
                    $executeSignUp = mysqli_query($conn, $insertNewUser);
        
                    if($executeSignUp){
                    }
                    else{
                        echo "<p>Erro ao enviar publicação: " . mysqli_error($conn) . "!<p>";
                    }
                }
                else{
                    foreach($err as $e){
                        echo "<p>$e</p><br>";
                    }
                }      
            }
        }

    // SEARCH ASSISTANCES - READ
        function querySpecificAssistance($conn, $table, $id){
            $sUQuery = "SELECT * FROM $table WHERE idPublicacao =" . (int) $id;

            $sUExec = mysqli_query($conn, $sUQuery);
            $sUReturn = mysqli_fetch_assoc($sUExec);

            return $sUReturn;
        }
        function queryMultipleAssistances($conn, $table, $where = 1, $order = ""){
            if(!empty($order))
            {
                $order = "ORDER BY $order";
            }

            $gQuery = "SELECT * FROM $table WHERE $where $order ";

            $gExec = mysqli_query($conn,$gQuery);
            $gReturn = mysqli_fetch_all($gExec, MYSQLI_ASSOC);

            return $gReturn;
        }
    
    // DELETE ASSISTANCE - DELETE
        function deleteAssistance($conn, $table, $id)
        {
            if(!empty($id)){         
                $dQuery = "DELETE FROM $table WHERE idPublicacao = ". (int) $id;
                $dExec = mysqli_query($conn, $dQuery);

                if(!$dExec){
                    echo "Algo deu errado, tente novamente mais tarde!";
                }
            }    
        }
