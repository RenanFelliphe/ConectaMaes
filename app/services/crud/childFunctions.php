<?php
    include_once(__DIR__ .'/../helpers/dateChecker.php');
    include_once(__DIR__ .'/../helpers/conn.php');

        // Função para registrar um novo filho
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
                        $queryDeficiencia = "SELECT idDeficiencia FROM Deficiencia WHERE categoriaCID = '$categoriaCID'";
                        $resultDeficiencia = mysqli_query($conn, $queryDeficiencia);
                        
                        if (mysqli_num_rows($resultDeficiencia) > 0) {
                            $idDeficiencia = mysqli_fetch_assoc($resultDeficiencia)['idDeficiencia'];
                            $insertDisability = "INSERT INTO filhoDeficiencia (idFilho, idDeficiencia) VALUES ('$idFilho', '$idDeficiencia')";
                            $executeInsertDisability = mysqli_query($conn, $insertDisability);
        
                            if (!$executeInsertDisability) {
                                echo "<p>Não foi possível associar deficiência: " . mysqli_error($conn) . "!<p>";
                            }
                        }
                    }
                } else {
                    echo "<p>Não foi possível registrar filho: " . mysqli_error($conn) . "!<p>";
                }
            }
        }        
        
        // CHILD QUERY FUNCTIONS - READ
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

            function queryChildDisability($conn, $id) {
                $query = "
                    SELECT d.categoriaCID
                    FROM Deficiencia d
                    JOIN filhoDeficiencia fd ON d.idDeficiencia = fd.idDeficiencia
                    WHERE fd.idFilho = $id
                ";
                $cdQuery = mysqli_query($conn, $query);
                return mysqli_fetch_all($cdQuery, MYSQLI_ASSOC);
            }
            

        // EDIT CHILD - UPDATE
            function editChild($conn, $childId) {
                $err = array();
                
                // Recebendo dados do formulário
                $nomeFilho = !empty($_POST['nomeFilho']) ? mysqli_real_escape_string($conn, $_POST['nomeFilho']) : null;
                $sexoFilho = !empty($_POST['sexoFilho']) ? mysqli_real_escape_string($conn, $_POST['sexoFilho']) : null;
                $dataNascimentoFilho = !empty($_POST['dataNascimentoFilho']) ? mysqli_real_escape_string($conn, $_POST['dataNascimentoFilho']) : null;
                $deficienciaFilho = !empty($_POST['deficienciaFilho']) ? $_POST['deficienciaFilho'] : null; // Mantendo a categoriaCID, incluindo "N/a"
            
                if (empty($err)) {
                    $fields = [];
                    if ($nomeFilho) $fields["nomeFilho"] = $nomeFilho;
                    if ($sexoFilho) $fields["sexo"] = $sexoFilho;
                    if ($dataNascimentoFilho) $fields["dataNascimentoFilho"] = $dataNascimentoFilho;
            
                    if (!empty($fields)) {
                        $setFields = [];
                        foreach ($fields as $field => $value) {
                            $setFields[] = "$field = ?";
                        }
                        $setFieldsStr = implode(", ", $setFields);
                        $updateChild = "UPDATE Filho SET $setFieldsStr WHERE idFilho = ?";
                        $stmt = mysqli_prepare($conn, $updateChild);
                        $values = array_values($fields);
                        $values[] = $childId; 
                        $types = str_repeat('s', count($values) - 1) . 'i'; // tipos para bind_param
                        mysqli_stmt_bind_param($stmt, $types, ...$values);
            
                        if (!mysqli_stmt_execute($stmt)) {
                            echo "Erro ao atualizar filho: " . mysqli_error($conn) . "!";
                            return;
                        }
                    }
            
                    if ($deficienciaFilho !== null) {
                        $checkCurrentDeficiencyQuery = "SELECT fd.idFilho, fd.idDeficiencia, d.categoriaCID 
                                                        FROM filhoDeficiencia fd
                                                        JOIN Deficiencia d ON fd.idDeficiencia = d.idDeficiencia
                                                        WHERE fd.idFilho = ?";
                        $stmt = mysqli_prepare($conn, $checkCurrentDeficiencyQuery);
                        mysqli_stmt_bind_param($stmt, 'i', $childId);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $currentDeficiency = mysqli_fetch_assoc($result);
            
                        if ($currentDeficiency) {
                            if ($currentDeficiency['categoriaCID'] !== $deficienciaFilho) {
                                $updateDeficiencyQuery = "UPDATE filhoDeficiencia fd
                                                        JOIN Deficiencia d ON fd.idDeficiencia = d.idDeficiencia
                                                        SET fd.idDeficiencia = (SELECT idDeficiencia FROM Deficiencia WHERE categoriaCID = ?)
                                                        WHERE fd.idFilho = ? AND d.categoriaCID = ?";
                                $stmtUpdate = mysqli_prepare($conn, $updateDeficiencyQuery);
                                mysqli_stmt_bind_param($stmtUpdate, 'sis', $deficienciaFilho, $childId, $currentDeficiency['categoriaCID']);
                                mysqli_stmt_execute($stmtUpdate);
                            }
                        }
                    }
                } else {
                    foreach ($err as $e) {
                        echo "<p>$e</p>";
                    }
                }
            }
        

         
            if(isset($_POST['confirmarEditarFilho'])) {
                $childId = $_POST['childEditIdentifier'];
                editChild($conn, $childId);
            } 
        // DELETE CHILD - DELETE
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

                    echo "<script>window.location.href = window.location.href;</script>";
                    exit; 
                }    
            }

            if(isset($_POST['deletarFilho'])){
                $childId = $_POST['childIdentifier'];
                deleteChild($conn, $childId);
            }
