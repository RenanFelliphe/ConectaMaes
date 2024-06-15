<?php

$hostname = '162.240.17.101';
$username = 'projetos_nlessa';
$password = 'Gc&sgY74PK$}';
$database = 'projetos_INF2023_G10';

$conn = mysqli_connect($hostname, $username, $password, $database);

    // Função para registrar um novo usuário
    function addChild($conn,$idParent)
    {
        if (isset($_POST['registrar'])) {
            $err = array();
    
            $nomeFilho = mysqli_real_escape_string($conn, $_POST['nomeFilho']);
            $dataNascimentoFilho = mysqli_real_escape_string($conn, $_POST['dataNascimentoFilho']);
            $sexoFilho= mysqli_real_escape_string($conn, $_POST['sexo']);
            
            if (empty($err)) {
                $insertNewUser = "INSERT INTO Filho (nomeFilho, dataNascimentoFilho, sexo, idUsuario) VALUES ('$nomeFilho','$dataNascimentoFilho', '$sexoFilho','$idParent')";
                $executeChildSignUp = mysqli_query($conn, $insertNewUser);
    
                if (!$executeChildSignUp) {
                    echo "<p>Erro ao registrar filho: " . mysqli_error($conn) . "!<p>";
                }
            }
        }
    }

    // USER QUERY FUNCTIONS - READ
        function queryChildData($conn, $table, $id){
            $sUQuery = "SELECT * FROM $table WHERE idFilho =" . (int) $id;

            $sUExec = mysqli_query($conn, $sUQuery);
            $sUReturn = mysqli_fetch_assoc($sUExec);

            return $sUReturn;
        }
        function queryMultipleChildrenData($conn, $table, $where = 1, $order = ""){
            if(!empty($order))
            {
                $order = "ORDER BY $order";
            }

            $gQuery = "SELECT * FROM $table WHERE $where $order ";

            $gExec = mysqli_query($conn,$gQuery);
            $gReturn = mysqli_fetch_all($gExec, MYSQLI_ASSOC);

            return $gReturn;
        }

    // EDIT ACCOUNT - UPDATE
        function editChild($conn, $childId) {
            if(isset($_POST['editarFilho'])) {
                $err = array();
        
                $nomeFilho = !empty($_POST['nomeEditFilho']) ? mysqli_real_escape_string($conn, $_POST['nomeEditFilho']) : null;
                $sexoFilho = !empty($_POST['sexoEditFilho']) ? mysqli_real_escape_string($conn, $_POST['sexoEditFilho']) : null;
                $dataNascimentoFilho = !empty($_POST['dataNascimentoEditFilho']) ? mysqli_real_escape_string($conn, $_POST['dataNascimentoEdit']) : null;
        
                
                if(empty($err)){
                    $fields = [];
                    if($nomeFilho) $fields["nomeFilho"] = $nomeFilho;
                    if($sexoFilho) $fields["sexo"] = $sexoFilho;
                    if($dataNascimentoFilho) $fields["dataNascimentoFilho"] = $dataNascimentoFilho;
        
                    if(!empty($fields)) {
                        $setFields = [];
                        foreach ($fields as $field => $value) {
                            $setFields[] = "$field = '$value'";
                        }
        
                        $setFieldsStr = implode(", ", $setFields);
                        $updateUser = "UPDATE Filho SET $setFieldsStr WHERE idFilho = '$childId'";
                        $executeUpdate = mysqli_query($conn, $updateUser);
        
                        if(!$executeUpdate){
                            echo "Erro ao atualizar perfil: " . mysqli_error($conn) . "!";
                        }
                    } else {
                        echo "Nenhuma alteração foi realizada.";
                    }
                }
            }
        }
        
    // DELETE ACCOUNT - DELETE
        function deleteChild($conn, $table, $id)
        {
            if(!empty($id))
            {         
                $dQuery = "DELETE FROM $table WHERE idFilho = ". (int) $id;
                $dExec = mysqli_query($conn, $dQuery);

                if(!$dExec){
                    echo "Não foi possível excluir o filho!";
                }
            }    
        }
