<?php


$data = json_decode(file_get_contents('php://input'), true);
// {
//     "tableName":"general_user",
//    
//     "conditions":{ 
//        {
//         "field" : "general_user_username",
//         "condition" : "=",
//         "value" : "jhon"
//      }
//   
// }



if (
    isset($data["tableName"]) &&
    isset($data["conditions"])
) {

    include("sql.php");

    $sql = new Sql();
    $tableName = $data["tableName"];
    $conditions = $data["conditions"];
    $sql->pdoDelete($tableName, $conditions);
}
