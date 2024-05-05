<?php
    function loginTest($mail,$mdp)
    {
        if($mail=="huhu" & $mdp=="huhu")
        {
            echo 1;
        }else{
            echo 0;
        }
    }
    function findtest(){
        global $database_connector;
    
        $sql_request = "SELECT * from testdonne";
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
    
        $statistics = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statistics_json = json_encode($statistics);
    
        $statement->closeCursor();
        echo '<pre>';
        print_r($statistics_json);
        echo '</pre>';
    };
    function inserttest($test){
        global $database_connector;
        $sql_request = "insert into testdonne values(null,:test)";
        $statement = $database_connector->prepare($sql_request);
        $statement->bindParam(':test', $test, PDO::PARAM_STR);
        $statement->execute();
        $statement->closeCursor();
    };


    // vraies
    function login($mail,$mdp)
    {
        global $database_connector;
    
        $sql_request = 'SELECT power_switch_user_id from power_switch_user where power_switch_user_email="'.$mail.'" and power_switch_user_password="'.$mdp.'"';
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statistics = $statement->fetch(PDO::FETCH_ASSOC);
        // $statistics_json = json_encode($statistics);

        // $statement->closeCursor();
        // echo '<pre>';
        // print_r($statistics_json);
        // echo '</pre>';
        return $statistics;
    }
    function singin($fn, $ln, $gender, $mail, $mdp, $nickname)
    {
        global $database_connector;
        $sql_request = 'INSERT INTO power_switch_user VALUES (null,"'.$fn.'", "'.$ln.'", "'.$gender.'", "'.$mail.'", "'.$mdp.'", "'.$nickname.'")';
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statement->closeCursor();
    }
    function addPower($idU, $pow1, $pow2, $pow3)
    {
        global $database_connector;
        
        // Insert into power_switch_transaction
        $sql_request = 'INSERT INTO power_switch_transaction VALUES 
                        (null, :idU, :pow1, :idU, :pow1, now(), now(), now()),
                        (null, :idU, :pow2, :idU, :pow2, now(), now(), now()),
                        (null, :idU, :pow3, :idU, :pow3, now(), now(), now())';
        $statement = $database_connector->prepare($sql_request);
        $statement->bindParam(':idU', $idU, PDO::PARAM_INT);
        $statement->bindParam(':pow1', $pow1, PDO::PARAM_INT);
        $statement->bindParam(':pow2', $pow2, PDO::PARAM_INT);
        $statement->bindParam(':pow3', $pow3, PDO::PARAM_INT);
        $statement->execute();
        
        // Insert into power_switch_user_superpowers
        $sql_request = 'INSERT INTO power_switch_user_superpowers VALUES 
                        (null, :idU, :pow1, now()),
                        (null, :idU, :pow2, now()),
                        (null, :idU, :pow3, now())';
        $statement = $database_connector->prepare($sql_request);
        $statement->bindParam(':idU', $idU, PDO::PARAM_INT);
        $statement->bindParam(':pow1', $pow1, PDO::PARAM_INT);
        $statement->bindParam(':pow2', $pow2, PDO::PARAM_INT);
        $statement->bindParam(':pow3', $pow3, PDO::PARAM_INT);
        $statement->execute();
        
        $statement->closeCursor();
    }
    
    function shuffleItem()
    {
        global $database_connector;
    
        $sql_request = "SELECT * from listpouvoir  order by rand() limit 6";
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statistics = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statistics_json = json_encode($statistics);
    
        $statement->closeCursor();
        echo '<pre>';
        print_r($statistics_json);
        echo '</pre>';
    }
    function mespouvoirs($id)
    {
        global $database_connector;
    
        $sql_request = "SELECT * from listpouvoir  where power_switch_superpower_id in (select power_switch_superpower_id from power_switch_user_superpowers where power_switch_user_id=:id)";
        $statement = $database_connector->prepare($sql_request);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statistics = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statistics_json = json_encode($statistics);
    
        $statement->closeCursor();
        echo '<pre>';
        print_r($statistics_json);
        echo '</pre>';
    }
    function pouvoirsinsteressants($id,$minid)
    {
        global $database_connector;
    
        $sql_request = "select * from listpouvoir where power_switch_superpower_id not in (select power_switch_superpower_id from power_switch_user_superpowers where power_switch_user_id=:id) and power_switch_superpower_id>:minid";
        $statement = $database_connector->prepare($sql_request);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':minid', $minid, PDO::PARAM_INT);
        $statement->execute();
        $statistics = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statistics_json = json_encode($statistics);
        $statement->closeCursor();
        echo '<pre>';
        print_r($statistics_json);
        echo '</pre>';
    }
    function historique($id)
    {
        global $database_connector;
    
        $sql_request = "select * from listtransaction where power_switch_seller_id=:id or power_switch_buyer_id=:id";
        $statement = $database_connector->prepare($sql_request);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statistics = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statistics_json = json_encode($statistics);
        $statement->closeCursor();
        echo '<pre>';
        print_r($statistics_json);
        echo '</pre>';
    }
    function create($id,$obj)
    {
        global $database_connector;
        $sql_request = 'insert into power_switch_transaction values(null,"'.$id.'","'.$obj.'",null,null,now(),null,null)';
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statement->closeCursor();
    }
    function valide($idT,$id,$obj)
    {
        global $database_connector;
        $sql_request = 'update power_switch_transaction set power_switch_buyer_id="'.$id.'",power_switch_transaction_superpower="'.$obj.'",power_switch_confirm_transaction_datetime=now() where power_switch_transaction_id='.$idT.' delete from power_switch_user_superpowers where (power_switch_user_id='.$id.' and power_switch_superpower_id='.$obj.') or (power_switch_user_id=(select power_switch_seller_id from power_switch_transaction where power_switch_transaction_id='.$idT.') and power_switch_superpower_id=(select power_switch_selled_superpower from power_switch_transaction where power_switch_transaction_id='.$idT.'))';
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $sql_request = 'insert into power_switch_user_superpowers values(null,"'.$id.'",(select power_switch_selled_superpower from power_switch_transaction where power_switch_transaction_id='.$idT.')),(null,(select power_switch_selled_superpower from power_switch_transaction where power_switch_transaction_id='.$idT.'),"'.$obj.'")';
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statement->closeCursor();
    }
    function negate($idT,$id,$obj)
    {
        global $database_connector;
        $sql_request = 'update power_switch_transaction set power_switch_buyer_id="'.$id.'",power_switch_transaction_superpower="'.$obj.'",power_switch_reject_transaction_datetime=now() where power_switch_transaction_id='.$idT;
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statement->closeCursor();
    }
    function nonvalide($id)
    {
        global $database_connector;
        $sql_request = 'select * from listtransaction where power_buyer_id="'.$id.'" and power_switch_confirm_transaction_datetime is null and power_switch_reject_transaction_datetime is null';
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statistics = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statistics_json = json_encode($statistics);
        $statement->closeCursor();
        echo '<pre>';
        print_r($statistics_json);
        echo '</pre>';
    
    }
    function creerPouvoir($nom,$damage,$accuracy,$mana,$effect,$element,$type,$rarity)
    {
        global $database_connector;
        $sql_request = 'insert into power_switch_superpower values(null,"'.$nom.'","'.$damage.'","'.$accuracy.'","'.$mana.'","'.$effect.'",(select power_switch_element_id from power_switch_element where power_switch_element_id="'.$element.'"),(select power_switch_type_id from power_switch_type where power_switch_type_id="'.$type.'"),(select power_switch_rarity_id from power_switch_rarity where power_switch_rarity_id="'.$rarity.'")';
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statement->closeCursor();
    }
    function envoieMess($id1,$mess,$id2)
    {
        global $database_connector;
        $sql_request = 'insert into power_switch_chat values(null,"'.$id1.'","'.$mess.'",now(),"'.$id2.'",now())';
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statement->closeCursor();
    }
    function getMess($id1,$id2)
    {
        global $database_connector;
    
        $sql_request = 'select * from power_switch_chat where power_switch_chat_sender_id="'.$id1.'" or power_switch_chat_receiver_id="'.$id2.'"';
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statistics = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statistics_json = json_encode($statistics);
        $statement->closeCursor();
        echo '<pre>';
        print_r($statistics_json);
        echo '</pre>';
    }
    function get_genders()
    {
        global $database_connector;

        $sql_request = "select * from power_switch_gender";
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $genders = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $genders;
    }

    function get_last_superpower()
    {
        global $database_connector;

        $sql_request = "select max(power_switch_superpower_id) from power_switch_superpower";
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $superpower = $statement->fetchColumn();
        return $superpower;
    }

    function set_user_superpower($power_switch_user_id, $power_switch_superpower_id)
    {
        global $database_connector;

        $sql_request = "insert into power_switch_user_superpowers values(null, ".$power_switch_user_id.", ".$power_switch_superpower_id.", current_timestamp)";
        $statement = $database_connector->prepare($sql_request);
        $statement->execute();
        $statement->closeCursor();
    }
?>