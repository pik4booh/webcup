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
        $statement->bindParam(':test', $test, PDO::PARAM_INT);
        $statement->execute();
        $statement->closeCursor();
    };
?>