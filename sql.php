<?php
include("connection.php");

class Sql extends connect
{
    public $conn;

    public function __construct()
    {
        $this->conn = $this->podConnect();
    }


    public  function pdoInsert($tableName, $record)
    {

        //pdo way

        $fields = array();
        $values = array();
        $params = array();

        foreach ($record as $key => $val) {
            $fields[] = $key;
            $values[] = $val;
            $params[] = ":" . $key;
        }
        $allFields = implode(",", $fields);
        $allParams = implode(",", $params);


        $sql = "INSERT INTO $tableName ( $allFields )";
        $sql .= "values( $allParams)";
        $stmt = $this->conn->prepare($sql);

        for ($i = 0; $i < count($params); $i++) {
            $stmt->bindParam($params[$i], $values[$i]);
        }

        $stmt->execute();
        $insertedId = $this->conn->lastInsertId();
        $response = array();
        if ($insertedId > 0) {
            $response["status"] = "success";
            $response["id"] = $insertedId;
        } else {
            $response["status"] = "failure";
        }

        echo json_encode($response);
    }

    public function pdoUpdate($tableName, $record, $conditions)
    {

        $sql = "UPDATE $tableName SET ";
        $counter = 0;
        $params = array();
        $values = array();
        foreach ($record as $key => $val) {
            $counter++;
            $field = $key;
            $bindParam = ":" . $field;
            $params[] = $bindParam;
            $values[] = $val;
            $sql .= "$field=$bindParam ";

            if ($counter < count($record)) {
                $sql .= ", ";
            } else {
                $sql .= " WHERE 1=1 ";
            }
        }
        foreach ($conditions as $condition) {
            $field = $condition["field"];
            $bindParam = ":" . $field;
            $params[] = $bindParam;
            $searchCondition = $condition["condition"];
            $values[] = $condition["value"];

            $sql .= " and $field $searchCondition $bindParam";
        }

        $stmt = $this->conn->prepare($sql);

        for ($i = 0; $i < count($params); $i++) {
            $stmt->bindParam($params[$i], $values[$i]);
        }

        $stmt->execute();
        $response = array();

        if ($stmt->rowCount() > 0) {
            $response["status"] = "success";
        } else {
            $response["status"] = "failure";
        }
        echo json_encode($response);
    }


    public function pdoDelete($tableName, $conditions)
    {
        $sql = "DELETE FROM $tableName WHERE 1=1";

        $params = array();
        $values = array();
        foreach ($conditions as $condition) {
            $field = $condition["field"];
            $bindParam = ":" . $field;
            $params[] = $bindParam;
            $searchCondition = $condition["condition"];
            $values[] = $condition["value"];
            $sql .= " and $field $searchCondition $bindParam";
        }

        $stmt = $this->conn->prepare($sql);
        for ($i = 0; $i < count($params); $i++) {
            $stmt->bindParam($params[$i], $values[$i]);
        }

        $stmt->execute();
        $response = array(
            "status" => "success"
        );
        echo json_encode($response);
    }


    public function pdoSelect($tableName, $selectedFields, $conditions)
    {
        if ($selectedFields[0] == "*") {
            $fields = "*";
        } else {
            $fields = implode(", ", $selectedFields);
        }
        $sql = "SELECT $fields FROM $tableName where 1=1 ";
        $params = array();
        $values = array();
        foreach ($conditions as $condition) {
            $bindParam = ":" . $condition["field"];
            $params[] = $bindParam;
            $field = $condition["field"];
            $values[] = $condition["value"];
            $searchCondition = $condition["condition"];
            $sql .= " and $field $searchCondition $bindParam";
        }

        $stmt = $this->conn->prepare($sql);

        for ($i = 0; $i < count($params); $i++) {
            $stmt->bindParam($params[$i], $values[$i]);
        }

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        echo json_encode($result);
    }
}

// $record = array(
//     "general_user_username" => "joe",
//     "general_user_country" => 3,
//     "general_user_account_date" => date("Y-m-d h:i:s"),
// );

// $conditions = array(
//     array(
//         "field" => "general_user_username",
//         "condition" => "=",
//         "value" => "yugi"
//     ),
// );

// $sql = new Sql();

// //$sql->pdoInsert("general_user", $record); //insert done


// //$sql->pdoUpdate("general_user", $record, $conditions); //update done

// //$sql->pdoDelete("general_user", $conditions); //delete done

// $fields = array(
//     "general_user_username"
// );
// $condition = array(
//     array(
//         "field" => "general_user_username",
//         "condition" => "=",
//         "value" => "joe"
//     ),

// );

// $sql->pdoSelect("general_user", $fields, $condition);// select done
