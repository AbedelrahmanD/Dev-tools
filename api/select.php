<?php


$data = json_decode(file_get_contents('php://input'), true);
// {
//     "tableName":"general_user",
//     "fields":{
//         "general_user_username",
//         "general_user_country"
//     },
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
    isset($data["fields"]) &&
    isset($data["conditions"])
) {

    include("../sql/sql.php");

    $sql = new Sql();
    $tableName = $data["tableName"];
    $fields = $data["fields"];
    $conditions = $data["conditions"];
    $response = $sql->pdoSelect($tableName, $fields, $conditions);
    echo json_encode($response);
}
