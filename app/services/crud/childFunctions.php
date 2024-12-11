<?php
    include_once(__DIR__ .'/../helpers/dateChecker.php');
    include_once(__DIR__ .'/../helpers/conn.php');

        // Função para registrar um novo filho
            function addChild($conn, $idParent) {
                $messages = array();  // Array para armazenar mensagens de erro e sucesso
            
                if (isset($_POST['enviarFilho'])) {
                    $sexoFilho = mysqli_real_escape_string($conn, $_POST['addChildSex']);
                    $nomeFilho = mysqli_real_escape_string($conn, $_POST['addChildName']);
                    $dataNascimentoFilho = mysqli_real_escape_string($conn, $_POST['addChildBirthDate']);
                    $categoriaCID = mysqli_real_escape_string($conn, $_POST['addChildDisability']);
            
                    // Verifica se os dados obrigatórios estão preenchidos
                    if (empty($nomeFilho) || empty($dataNascimentoFilho) || empty($sexoFilho)) {
                        $messages[] = "<p class='error-message'>Por favor, preencha todos os campos obrigatórios.</p>";
                    } else {
                        // Insere os dados do filho
                        $insertNewChild = "INSERT INTO Filho (nomeFilho, dataNascimentoFilho, sexo, idUsuario) VALUES ('$nomeFilho', '$dataNascimentoFilho', '$sexoFilho', '$idParent')";
                        $executeChildSignUp = mysqli_query($conn, $insertNewChild);
            
                        if ($executeChildSignUp) {
                            $idFilho = mysqli_insert_id($conn);
            
                            // Se a categoria CID for informada, tenta associar uma deficiência ao filho
                            if (!empty($categoriaCID)) {
                                $queryDeficiencia = "SELECT idDeficiencia FROM Deficiencia WHERE categoriaCID = '$categoriaCID'";
                                $resultDeficiencia = mysqli_query($conn, $queryDeficiencia);
            
                                if (mysqli_num_rows($resultDeficiencia) > 0) {
                                    $idDeficiencia = mysqli_fetch_assoc($resultDeficiencia)['idDeficiencia'];
                                    $insertDisability = "INSERT INTO filhoDeficiencia (idFilho, idDeficiencia) VALUES ('$idFilho', '$idDeficiencia')";
                                    $executeInsertDisability = mysqli_query($conn, $insertDisability);
            
                                    if (!$executeInsertDisability) {
                                        $messages[] = "<p class='error-message'>Não foi possível associar a deficiência: " . mysqli_error($conn) . ".</p>";
                                    }
                                } else {
                                    $messages[] = "<p class='error-message'>Deficiência não encontrada para o CID informado.</p>";
                                }
                            }
            
                            // Se tudo ocorrer bem, adiciona a mensagem de sucesso
                            $messages[] = "<p class='success-message'>Filho(a) cadastrado(a) com sucesso!</p>";
                        } else {
                            $messages[] = "<p class='error-message'>Não foi possível registrar o filho. Erro: " . mysqli_error($conn) . ".</p>";
                        }
                    }
                }
            
                return $messages;  // Retorna todas as mensagens (erro ou sucesso)
            }
            
            if (isset($_POST['enviarFilho'])) {
                $idParent = filter_var(mysqli_escape_string($conn,$_POST['parentIdToAddChild']), FILTER_SANITIZE_NUMBER_INT);
                $add_child_messages = addChild($conn, $idParent); 
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
                $nomeFilho = !empty($_POST['editChildName']) ? mysqli_real_escape_string($conn, $_POST['editChildName']) : null;
                $sexoFilho = !empty($_POST['editChildSex']) ? mysqli_real_escape_string($conn, $_POST['editChildSex']) : null;
                $dataNascimentoFilho = !empty($_POST['editChildBirthDate']) ? mysqli_real_escape_string($conn, $_POST['editChildBirthDate']) : null;
                $deficienciaFilho = !empty($_POST['editChildDisability']) ? $_POST['editChildDisability'] : null;
            
                $fields = [];
                if ($nomeFilho) $fields["nomeFilho"] = "'$nomeFilho'";
                if ($sexoFilho) $fields["sexo"] = "'$sexoFilho'";
                if ($dataNascimentoFilho) $fields["dataNascimentoFilho"] = "'$dataNascimentoFilho'";
            
                if (!empty($fields)) {
                    $setFields = [];
                    foreach ($fields as $field => $value) {
                        $setFields[] = "$field = $value";
                    }
                    $setFieldsStr = implode(", ", $setFields);
            
                    $updateChild = "UPDATE Filho SET $setFieldsStr WHERE idFilho = " . (int)$childId;
                    if (!mysqli_query($conn, $updateChild)) {
                        echo "Erro ao atualizar filho: " . mysqli_error($conn);
                        return;
                    }
                }
            
                if ($deficienciaFilho !== null) {
                    $checkCurrentDeficiencyQuery = "SELECT fd.idFilho, fd.idDeficiencia, d.categoriaCID FROM filhoDeficiencia fd JOIN Deficiencia d ON fd.idDeficiencia = d.idDeficiencia WHERE fd.idFilho = " . (int)$childId;
                    $result = mysqli_query($conn, $checkCurrentDeficiencyQuery);
                    $currentDeficiency = mysqli_fetch_assoc($result);
            
                    if ($currentDeficiency) {
                        if ($currentDeficiency['categoriaCID'] !== $deficienciaFilho) {
                            $updateDeficiencyQuery = "UPDATE filhoDeficiencia fd JOIN Deficiencia d ON fd.idDeficiencia = d.idDeficiencia SET fd.idDeficiencia = (SELECT idDeficiencia FROM Deficiencia WHERE categoriaCID = '$deficienciaFilho') WHERE fd.idFilho = " . (int)$childId . " AND d.categoriaCID = '" . mysqli_real_escape_string($conn, $currentDeficiency['categoriaCID']) . "'";
                            if (!mysqli_query($conn, $updateDeficiencyQuery)) {
                                echo "Erro ao atualizar deficiência: " . mysqli_error($conn);
                                return;
                            }
                        }
                    } else {
                        // Se não existe deficiência associada, adicionar uma nova
                        $insertDeficiencyQuery = "INSERT INTO filhoDeficiencia (idFilho, idDeficiencia) SELECT $childId, idDeficiencia FROM Deficiencia WHERE categoriaCID = '" . mysqli_real_escape_string($conn, $deficienciaFilho) . "'";
                        if (!mysqli_query($conn, $insertDeficiencyQuery)) {
                            echo "Erro ao associar deficiência: " . mysqli_error($conn);
                            return;
                        }
                    }
                }
            }
        
            if(isset($_POST['confirmarEditarFilho'])) {
                $childId = filter_var(mysqli_escape_string($conn,$_POST['childEditIdentifier']), FILTER_SANITIZE_NUMBER_INT);
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
                $childId = filter_var(mysqli_escape_string($conn,$_POST['childIdentifier']), FILTER_SANITIZE_NUMBER_INT);
                deleteChild($conn, $childId);
            }
