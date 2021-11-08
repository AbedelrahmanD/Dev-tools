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

        $fields = array();
        $values = array();
        $params = array();

        foreach ($record as $rec) {
            $fields[] = $rec["field"];
            $values[] = $rec["value"];
            $params[] = ":" . $rec["field"];
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
            $response["status"] = "failed";
        }

        return $response;
    }

    public function pdoUpdate($tableName, $record, $conditions)
    {

        $sql = "UPDATE $tableName SET ";
        $counter = 0;
        $params = array();
        $values = array();
        foreach ($record as $rec) {
            $counter++;
            $field = $rec["field"];
            $bindParam = ":" . $field;
            $params[] = $bindParam;
            $values[] = $rec["value"];
            $sql .= "$field = $bindParam ";

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
            $sql .= " and $field $searchCondition $bindParam ";
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
            $response["status"] = "failed";
        }
        return $response;
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
        return $response;
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
        return $result;
    }
}
