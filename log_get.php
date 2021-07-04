<html>
    <head>
        <title>Redirect(Login)</title>
    </head>
    <body>
        <?php
        session_start();
        include("config.php");

        $db = "registration";
        $login = mysqli_connect($server, $user, $password,$db); 
        if (!$login){ 
            echo "<h2>Couldn't Connect</h2>. ";
        }

        $db = "registration";
        $emaillog = $_POST["email"];
        $passlog = $_POST["pass"];

        $find = "";
        $sql1 = "SELECT * FROM register";
        $check = mysqli_query($login,$sql1);
        if($check){
            while($find = mysqli_fetch_assoc($check)){
                if(($emaillog == $find["email"])&&($passlog == $find["pass"])){
                    echo "Successful";
                    header("location: index.html");
                    break;
                }
            }
            if(1){
                echo "<style>body{background-color:navy;}</style><br><h1 style='text-align:center;color:#FFC145;'>Wrong Password or Invalid MailID</h1>";
                header("refresh: 2; url=login.html");
            }
        }
        else{
            echo "<br>Sorry Coudn't Connect" . mysqli_error($login);
        }
        mysqli_close($login);
        ?>
    </body>
</html>