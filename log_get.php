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
        }
        else{
            echo "<br>Sorry Coudn't Connect" . mysqli_error($login);
        }
        mysqli_close($login);
        ?>
    </body>
</html>