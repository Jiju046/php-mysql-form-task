<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forms-php</forms-php></title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

    <!-- validation -->
    <!-- variables -->
    <?php
    
    $name = $email = $website = $message = $skill = $department = $gender = "";
    //error
    $nameErr = $emailErr = $websiteErr = $messageErr = $skillErr = $departmentErr = $genderErr = "";

    // name
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Please Enter your Name";
        } else {
            $name = $_POST["name"];
        }

        // email
        if (preg_match("/.+@[^@]+\.[^@]{2,}$/", $_POST["email"])) {
            $email = sanitize($_POST["email"]);
        } else {
            $emailErr = "Please Enter a Valid Email";
        }

        // url
        if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $_POST["website"])) {
            $website = sanitize($_POST["website"]);
        } else {
            $websiteErr = "Please Enter a Valid URL";
        }
        // comments
        if (empty($_POST["message"])) {
            $messageErr = "Kindly Leave your Comments";
        } else {
            $message = sanitize($_POST["message"]);
        }
        // skill checkbox
        if (isset($skill) && $_POST["skill"] != "") {
            $skill = $_POST["skill"];
        } else {
            $skillErr = "Please Select One";
        }
        //gender
        if (isset($gender) && $_POST["gender"] != "") {
            $gender = $_POST["gender"];
        } else {
            $genderErr = "Please Select One";
        }
        // department
        if ($_POST["department"] == "") {
            $departmentErr = "Please Select One";
        } else {
            $department = $_POST["department"];
        }
    }

    // sanitizing function
    function sanitize($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }
    ?>

    <h1>PHP forms</h1><span class="warning">* are required fields</span>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">

            <!-- name -->
            <div class="inputs">
                <label for="name">Name</label>
                <input class="box" type="text" name="name" id="name" >
                <span class="warning"><sup>*</sup><?php echo $nameErr ?> </span>
            </div>
            <div class="inputs">
                <!-- E-mail -->
                <label for="email">E-mail</label>
                <input class="box" type="text" id="email" name="email" >
                <span class="warning"><sup>*</sup><?php echo $emailErr ?> </span>
            </div>
            <div class="inputs">
                <!-- url -->
                <label for="url">Website</label>
                <input class="box" type="text" name="website" >
                <span class="warning"><sup>*</sup><?php echo $websiteErr ?> </span>
            </div>
            <div class="inputs">
                <!-- text box -->
                <label for="message">Comments</label>
                <textarea class="box" id="message" name="message"></textarea>
                <span class="warning"><sup>*</sup><?php echo $messageErr ?> </span>
            </div>

            <!-- skills checkbox -->
            <div class="inputs">
                <p>Skills</p>
                <!-- name skill[] is treated as array -->
                <input type="checkbox" id="c" name="skill[]" value="C">
                <label for="c">C</label>
                <input type="checkbox" id="c++" name="skill[]" value="C++">
                <label for="c++">C++</label>
                <input type="checkbox" id="java" name="skill[]" value="Java">
                <label for="java">Java</label>
                <span class="warning"><sup>*</sup><?php echo $skillErr ?> </span>
            </div>
            <!-- select department -->
            <div class="inputs">
                <label>Department</label>
                <select name="department" class="select">
                    <option value="">Select</option>
                    <option>CSE</option>
                    <option>EEE</option>
                    <option>ECE</option>
                </select>
                <span class="warning"><sup >*</sup><?php echo $departmentErr ?> </span>
            </div>
    </div>

    <div class="inputs">
    
        <!-- radio gender -->
        <p>Gender</p>
        <input id="male" type="radio" name="gender" value="Male">
        <label for="male">Male</label>
        <input id="female" type="radio" name="gender" value="Female">
        <label for="female">Female</label>
        <input id="others" type="radio" name="gender" value="Others">
        <label for="others">Others</label>
        <span class="warning"><sup>*</sup><?php echo $genderErr ?> </span>
    </div>
    <!-- submit -->
    <input class="submit" type="submit">




    </form>
        
    <!-- input details -->
    <h3>Your Input Details:</h3>
    <?php include "./includes/dbh.inc.php"; ?>
    <p class='inputHeading'><span><?php ($name != "" ) && (print "Name: ". $name); ?></span></p>
    <p class='inputHeading'><span><?php ($email != "" )&& (print "Email: ". $email); ?></span></p>
    <p class='inputHeading'><span><?php ($website != "" )&& (print "Website: ". $website); ?></span></p>
    <p class='inputHeading'><span><?php ($message != "" )&& (print "Message: ". $message); ?></span></p>
    <p class='inputHeading'><span><?php ($skill!= "" )&& (print "Skill: ".  implode(", ", $skill) ); ?></span></p>
    <p class='inputHeading'><span><?php ($department != "" )&& (print "Department: ". $department); ?></span></p>
    <p class='inputHeading'><span><?php ($gender != "" )&& (print "Gender: ". $gender); ?></span></p>
    
    </div>
</body>

</html>