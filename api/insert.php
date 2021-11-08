<?php


$data = json_decode(file_get_contents('php://input'), true);
// {
//     "tableName":"general_user",
//     "record":[
//               {
//               "field":"general_user_username",
//               "value":"mike",
//               "type":"text"
//               }
//     ]
// }



if (
    isset($data["tableName"]) &&
    isset($data["record"])
) {

    include("../sql/sql.php");
    include("../tools/fome_validation.php");

    $sql = new Sql();
    $tableName = $data["tableName"];
    $record = $data["record"];

    $formValidation = new FormValidation();
    $validation = $formValidation->validateFormData($record);
    if ($validation["status"] == "failed") {
        echo json_encode($validation);
        return;
    }

    $response = $sql->pdoInsert($tableName, $record);
    echo json_encode($response);
}
