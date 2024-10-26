<?php
    include_once(__DIR__ .'/../helpers/dateChecker.php');
    include_once(__DIR__ .'/../helpers/conn.php');

        // Função para registrar um novo usuário
        function addChild($conn, $idParent) {
            $err = array();
            $nomeFilho = mysqli_real_escape_string($conn, $_POST['nomeFilho']);
            $dataNascimentoFilho = mysqli_real_escape_string($conn, $_POST['dataNascimentoFilho']);
            $sexoFilho = mysqli_real_escape_string($conn, $_POST['sexoFilho']);
            $categoriaCID = mysqli_real_escape_string($conn, $_POST['deficienciaFilho']);
            
            if (empty($err)) {
                $insertNewChild = "INSERT INTO Filho (nomeFilho, dataNascimentoFilho, sexo, idUsuario) VALUES ('$nomeFilho', '$dataNascimentoFilho', '$sexoFilho', '$idParent')";
                $executeChildSignUp = mysqli_query($conn, $insertNewChild);
        
                if ($executeChildSignUp) {
                    $idFilho = mysqli_insert_id($conn);
                    if ($categoriaCID) {
                        // Buscar o id da deficiência com base no código CID
                        $queryDeficiencia = "SELECT idDeficiencia FROM Deficiencia WHERE categoriaCID = '$categoriaCID'";
                        $resultDeficiencia = mysqli_query($conn, $queryDeficiencia);
                        
                        if (mysqli_num_rows($resultDeficiencia) > 0) {
                            $idDeficiencia = mysqli_fetch_assoc($resultDeficiencia)['idDeficiencia'];
                            $insertDeficiency = "INSERT INTO filhoDeficiencia (idFilho, idDeficiencia) VALUES ('$idFilho', '$idDeficiencia')";
                            $executeInsertDeficiency = mysqli_query($conn, $insertDeficiency);
        
                            if (!$executeInsertDeficiency) {
                                echo "<p>Não foi possível associar deficiência: " . mysqli_error($conn) . "!<p>";
                            }
                        }
                    }
                } else {
                    echo "<p>Não foi possível registrar filho: " . mysqli_error($conn) . "!<p>";
                }
            }
        }        
        
        // USER QUERY FUNCTIONS - READ
            function queryChildData($conn, $id){
                $query = "
                    SELECT 
                        f.*, 
                        d.nomeDeficiencia 
                    FROM 
                        Filho f
                    LEFT JOIN 
                        filhoDeficiencia fd ON f.idFilho = fd.idFilho
                    LEFT JOIN 
                        Deficiencia d ON fd.idDeficiencia = d.idDeficiencia
                    WHERE 
                f.idFilho = " . (int) $id;

                $fQuery = mysqli_query($conn, $query);

                return mysqli_fetch_assoc($fQuery);
            }

            function queryMultipleChildrenData($conn, $where = 1, $order = "") {
                if (!empty($order)) {
                    $order = "ORDER BY $order";
                }

                $query = "
                    SELECT 
                        f.*, 
                        GROUP_CONCAT(d.nomeDeficiencia) AS deficiencias
                    FROM 
                        Filho f
                    LEFT JOIN 
                        filhoDeficiencia fd ON f.idFilho = fd.idFilho
                    LEFT JOIN 
                        Deficiencia d ON fd.idDeficiencia = d.idDeficiencia
                    WHERE 
                        $where
                    GROUP BY 
                        f.idFilho
                    $order";

                $mFQuery = mysqli_query($conn, $query);

                return mysqli_fetch_all($mFQuery, MYSQLI_ASSOC);
            }
        // EDIT ACCOUNT - UPDATE
            function editChild($conn, $childId) {
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
            
        // DELETE ACCOUNT - DELETE
            function deleteChild($conn, $id){
                if(!empty($id)){         
                    $dQuery = "DELETE FROM Filho WHERE idFilho = ". (int) $id;
                    $dExec = mysqli_query($conn, $dQuery);

                    $dfQuery = "DELETE FROM filhoDeficiencia WHERE idFilho = ". (int) $id;
                    $dfExec = mysqli_query($conn, $dfQuery);

                    if(!$dExec){
                        echo "Não foi possível excluir o filho!";
                    }
                    if(!$dfExec){
                        echo "Não foi possível excluir o registro de deficiência do filho!";
                        echo "( Contate a equipe de suporte para mais informações. )";
                    }
                }    
            }
