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
    $nameErr = $emailErr = $idErr = $passwordErr = "";
    $name = $email = $identify = $password = "";

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

        if (empty($_POST["identify"])) {
            $idErr = "identify is required";
        } else {
            $identify = test_input($_POST["identify"]);
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

    <h2>web期末机考，20195653周小茜</h2>
    <p id="err"></p>
    <p><span class="error">* required field</span></p>
    <form method="post" name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        请选择账号身份:
        <input type="radio" name="identify" <?php if (isset($identify) && $identify == "admin") echo "checked"; ?> value="admin">管理员
        <input type="radio" name="identify" <?php if (isset($identify) && $identify == "normal") echo "checked"; ?> value="normal">普通用户
        <span class="error">* <?php echo $idErr; ?></span>
        <br><br>
        姓名: <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error">* <?php echo $nameErr; ?></span>
        <br><br>
        E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
        <br><br>
        密码: <input type="password" name="password" value="<?php echo $password; ?>">
        <span class="error">* <?php echo $passwordErr; ?></span>
        <br><br>

        <input type="button" value="注册" onclick="zc()">
        <input type="button" value="登录" onclick="dl()">


    </form>

    <script>
        function dl(){
            var id=document.form1.identify.value;
            if(id=="normal"){
                window.location.href="normal.php";
            }else{
                window.location.href="admin.php";
            }
        }

        function zc(){
            var id=document.form1.identify.value;
            if(id=="normal"){
                window.location.href="register.php";
            }else{
                alert("管理员不可注册");
                // document.getElementById("err").innerHTML = "管理员不可注册";
            }
        }
    </script>

    <?php
    echo "<h2>Your Input:</h2>";
    echo $identify;
    echo "<br>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $password;
    echo "<br>";
    ?>

        
</body>

</html>