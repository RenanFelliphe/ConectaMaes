<?php

$hostname = '162.240.17.101';
$username = 'projetos_nlessa';
$password = 'Gc&sgY74PK$}';
$database = 'projetos_INF2023_G10';

$conn = mysqli_connect($hostname, $username, $password, $database);

    // Função para registrar uma novo deficiência
    function signUpDef($conn)
    {
        $err = array();

        //variaveis
        $nomeDeficienciaRegistro = mysqli_real_escape_string($conn, $_POST['nomeDeficienciaRegistro']);
        $categoriaCIDRegistro = mysqli_real_escape_string($conn, $_POST['categoriaCIDRegistro']);
        $descricaoDeficienciaRegistro = mysqli_real_escape_string($conn, $_POST['descricaoDeficienciaRegistro']);

        //validar categoria CID
        $queryCategoriaCID = "SELECT categoriaCID FROM Deficiencia WHERE categoriaCID = '$categoriaCIDRegistro'";
        $searchCategoriaCID = mysqli_query($conn, $queryCategoriaCID);
        $verifyRowNum = mysqli_num_rows($searchCategoriaCID);

        if (!empty($verifyRowNum)) {
            $err[] = "Categoria CID já registrada!";
        }

        if (empty($err)) {
            $insertNewDef = "INSERT INTO Deficiencia (nomeDeficiencia,categoriaCID,descricao) VALUES ('$nomeDeficienciaRegistro','$categoriaCIDRegistro','$descricaoDeficienciaRegistro')";
            $executeSignDef = mysqli_query($conn, $insertNewDef);

            if ($executeSignDef) {
                echo "Deficiência registrada com sucesso!";
            } else {
                echo "<p>Erro ao registrar deficiência: " . mysqli_error($conn) . "!<p>";
            }
        } else {
            foreach ($err as $e) {
                echo "<p>e</p><br>";
            }
        }
        
    }

    // USER QUERY FUNCTIONS - READ
        function queryDefData($conn, $id){
            $sDQuery = "SELECT * FROM Deficiencia WHERE idDeficiencia =" . (int) $id;

            $sDExec = mysqli_query($conn, $sDQuery);
            $sDReturn = mysqli_fetch_assoc($sDExec);

            return $sDReturn;
        }
        function queryMultipleDefData($conn, $where = 1, $order = ""){
            if(!empty($order))
            {
                $order = "ORDER BY $order";
            }

            $gQuery = "SELECT * FROM Deficiencia WHERE $where $order ";

            $gExec = mysqli_query($conn,$gQuery);
            $gReturn = mysqli_fetch_all($gExec, MYSQLI_ASSOC);

            return $gReturn;
        }

    // EDIT ACCOUNT - UPDATE
        function editDef($conn, $defId) {
            $err = array();

            $nomeDeficienciaEdit = !empty($_POST['nomeDeficienciaEdit']) ? mysqli_real_escape_string($conn, $_POST['nomeEdit']) : null;
            $categoriaCIDEdit = !empty($_POST['categoriaCIDEdit']) ? mysqli_real_escape_string($conn, $_POST['categoriaCIDEdit']) : null;
            $descricaoEdit = !empty($_POST['descricaoEdit']) ? mysqli_real_escape_string($conn, $_POST['descricaoEdit']) : null;
            

            // Verificação de categoriaCID duplicado
            if($categoriaCIDEdit) {
                $querycategoriaCID = "SELECT categoriaCID FROM Deficiencia WHERE categoriaCID = '$categoriaCIDEdit' AND idDeficiencia != '$defId'";
                $searchcategoriaCID = mysqli_query($conn, $querycategoriaCID);
                $verifycategoriaCIDRowNum = mysqli_num_rows($searchcategoriaCID);

                if(!empty($verifycategoriaCIDRowNum)){
                    $err[] = "Deficiencia já registrada!";
                }
            }
            
            if(empty($err)){
                $fields = [];
                if($categoriaCIDEdit) $fields["categoriaCID"] = $categoriaCIDEdit;
                if($nomeDeficienciaEdit) $fields["nomeDeficiencia"] = $nomeDeficienciaEdit;
                if($descricaoEdit) $fields["descricao"] = $descricaoEdit;

                if(!empty($fields)) {
                    $setFields = [];
                    foreach ($fields as $field => $value) {
                        $setFields[] = "$field = '$value'";
                    }

                    $setFieldsStr = implode(", ", $setFields);
                    $updateDef = "UPDATE Deficiencia SET $setFieldsStr WHERE idDeficiencia = '$defId'";
                    $executeUpdate = mysqli_query($conn, $updateDef);
                    if(!$executeUpdate){
                        echo "Erro ao atualizar deficiência: " . mysqli_error($conn) . "!";
                    }
                }
            } else {
                foreach($err as $e){
                    echo "<p>$e</p>";
                }
            }
            
        }
        
    // DELETE ACCOUNT - DELETE
        function deleteDef($conn, $table, $id){
            if(!empty($id)){         
                $dQuery = "DELETE FROM Deficiencia WHERE idDeficiencia = ". (int) $id;
                $dExec = mysqli_query($conn, $dQuery);

                if(!$dExec){
                    echo "Não foi possível deletar a deficiência!";
                }
            }    
        }
