<?php


$data = json_decode(file_get_contents('php://input'), true);
// {
//     "tableName":"general_user",
//     "record":{
//         "general_user_username":"abed",
//         "general_user_country":"77"
//     }
// }



if (
    isset($data["tableName"]) &&
    isset($data["record"])
) {

    include("sql.php");

    $sql = new Sql();
    $tableName = $data["tableName"];
    $record = $data["record"];
    $sql->pdoInsert($tableName, $record);
}
