<?php


$data = json_decode(file_get_contents('php://input'), true);
// {
//     "tableName":"general_user",
//     "record":{
//         "general_user_username":"abed",
//         "general_user_country":"77"
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
    isset($data["record"]) &&
    isset($data["conditions"])
) {

    include("sql/sql.php");

    $sql = new Sql();
    $tableName = $data["tableName"];
    $record = $data["record"];
    $conditions = $data["conditions"];
    $sql->pdoUpdate($tableName, $record, $conditions);
}
