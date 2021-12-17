<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        header("Content-type: text/html;charset=utf-8");
        $con = mysql_connect();
        if (!$con) {
            die('Could not connect: ' . mysql_error());
        }
        echo "connect success<br>";

        if (mysql_query("CREATE DATABASE my_db",$con))
        {
            echo "Database created";
        }else{
            echo "Error creating database: " . mysql_error();
        }
        mysql_select_db("my_db", $con);

        $sql = "CREATE TABLE User (userName varchar(15) NOT NULL,Sno varchar(15) NOT NULL,Emile varchar(50) NOT NULL,Pass varchar(30) NOT NULL,Adminor int NOT NULL,PRIMARY KEY(Sno))";
        mysql_query($sql,$con);
    ?>
</body>
</html>