<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $passwordErr = $snoerr = "";
    $name = $email = $password = $sno = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Password is required";
        } else {
            $password = test_input($_POST["password"]);
        }

        if (empty($_POST["sno"])) {
            $snoErr = "Sno is required";
        } else {
            $sno = test_input($_POST["sno"]);
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

    <h2>普通用户注册</h2>
    <p id="err"></p>
    <p><span class="error">* required field</span></p>
    <form method="post" name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        姓名: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        学号: <input type="text" name="sno" value="<?php echo $sno; ?>">
        <span class="error">* <?php echo $snoerr; ?></span>
        <br><br>
        E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        密码: <input type="password" name="password" value="<?php echo $password; ?>">
        <span class="error">* <?php echo $passwordErr; ?></span>
        <br><br>

        <input type="submit" name="submit" value="注册">


    </form>

    <?php
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $sno;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $password;
    echo "<br>";
    ?>

    <?php
        header("Content-Type: text/html; charset=utf8");

        if (isset($_POST['submit'])) {
        
            include('connect.php'); //链接数据库
            $sql = "INSERT INTO User (userName, Sno, Emile, Pass, Adminor) VALUES ('$_POST[name]','$_POST[sno]','$_POST[email]','$_POST[password]',0)";//向数据库插入表单传来的值的sql
            $reslut = mysql_query($q, $con); //执行sql

            if (!mysql_query($sql, $con)) {
                die('Error: ' . mysql_error()); //如果sql执行失败输出错误
            } else {
                echo "注册成功"; //成功输出注册成功
            }
            mysql_close($con); //关闭数据库
        }

    ?>


</body>

</html>