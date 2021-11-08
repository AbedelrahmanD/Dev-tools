<?php

class FormValidation
{
    public $emailRegx = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
    public $passRegxNumber = "/[0-9]/";
    public $passRegxSmallLetter = "/[a-z]/";
    public $passRegxCapitalLetter = "/[A-Z]/";

    public function __construct()
    {
    }
    public function validateFormData($formData)
    {
        $response = array();
        $response["status"] = "success";
        $invaledFields = array();
        foreach ($formData as $data) {
            $type = $data["type"];
            $value = $data["value"];
            if ($type == "text") {
                $result = $this->validateText($value);
            } else if ($type == "email") {
                $result = $this->validateEmail($value);
            } else if ($type == "password") {
                $result = $this->validatePassword($value);
            } else if ($type == "number") {
                $result = $this->validateNumber($value);
            }
            if ($result == false) {
                $response["status"] = "failed";
                $invaledFields[] = $data["field"];
            }
        }
        $response["invalidFields"] = $invaledFields;
        return $response;
    }

    public function validateText($text)
    {
        if (trim($text) != "" && $text != null) {
            return true;
        } else {
            return false;
        }
    }

    public function validateEmail($email)
    {
        return preg_match($this->emailRegx, $email);
    }
    public function validateNumber($number)
    {
        return  is_numeric($number);
    }


    public function validatePassword($password)
    {
        return (preg_match($this->passRegxNumber, $password) &&
            preg_match($this->passRegxSmallLetter, $password) &&
            preg_match($this->passRegxCapitalLetter, $password) &&
            (strlen($password) >= 8));
    }
}
   
//    $form=new Form();
//    $formData = array(
//             array(
//                 "type" => "text",
//                 "value" => "example"
//             ),
//             array(
//                 "type" => "email",
//                 "value" => "example@gmail.com
//             ),
//             array(
//                 "type" => "password",
//                 "value" => "Aa1qweqw"
//             ),
//         );
//    $result=$form->validateFormData($formData);
//    echo $result;