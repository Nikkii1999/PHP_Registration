<?php
    $nameErr = $emailErr = $genderErr = $websiteErr = $mobileErr=$uploadErr="";
    $name = $email = $gender = $website=$mobile=$dob=$address=$about=$qualification=$upload="";

    if(isset($_POST["submit"]))
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            if (empty($_POST["name"])) {
                $nameErr = "Name is required";
            }
            else {
                $name = test_input($_POST["name"]);
            }
            if (empty($_POST["email"])) {
             $emailErr = "Email is required";
            }
            else {
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format"; 
                }
            }
            if (empty($_POST["gender"])) {
                $genderErr = "Gender is required";
            }
            else{
                $gender = test_input($_POST["gender"]);
            }
            $website = test_input($_POST["links"]);
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
                $websiteErr = "Invalid URL"; 
            }
            else{
                $website=test_input($_POST["links"]);
            }
                $mobile=test_input($_POST["mobile"]);
            if(!preg_match('/^[0-9]{10}$/', $_POST["mobile"])){
                $mobileErr="Invalid Format";
            }
            else{
                $mobile=test_input($_POST["mobile"]);
            }
            if(!empty($_FILES["image"]["name"]))
            {
                if($_FILES["image"]["error"] == 0)
                {
                    $allowed_types = array("image/jpeg", "image/jpg", "image/png", "image/gif");
                    if((in_array($_FILES["image"]["type"], $allowed_types)))
                    {
                        if($_FILES["image"]["size"] < 990000)
                        {
                            $uploaded = move_uploaded_file($_FILES["image"]["tmp_name"],"/home/nikitab/repos/php_learning/upload/" .$_FILES["image"]["name"]);
                            if($uploaded)
                            {
                                $upload="File uploaded sucessfully";
                            }
                            else
                            {
                                $uploadErr="File could not be uploaded";
                            }   
                        }
                        else
                        {
                            $uploadErr="File should be less than 10KB " . $_FILES["image"]["size"];
                        }
                    }   
                    else
                    {
                        $uploadErr="Please upload JPG or PNG files";
                    }
                }
                else
                {
                    $uploadErr="There are some errors with the file";
                }
            }
            else
            {
                $uploadErr="Please browse a file to upload";
            }
        }
    }
    $dob=test_input($_POST["dob"]);
    $address=test_input($_POST["address"]);
    $about=test_input($_POST["about"]);
    $qualification=test_input($_POST["qualification"]);
    $picture=htmlspecialchars(basename($_FILES["image"]["name"]));
    function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
?>