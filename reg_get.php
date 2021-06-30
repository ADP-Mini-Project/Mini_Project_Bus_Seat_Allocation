<html>
    <head>
        <title>Redirect(Register)</title>
    </head>
    <body>
        <?php 
        session_start();
        include("config.php");

        $login = mysqli_connect($server, $user, $password); 
        if (!$login){ 
            echo "<h2>Couldn't Connect</h2>. ";
        }

        $_SESSION = $_POST["fname"];
        $_SESSION = $_POST["lname"];
        $_SESSION = $_POST["email"];
        $_SESSION = $_POST["pass"];

        $regdb = "CREATE DATABASE registration";

        if(mysqli_query($login,$regdb)){
            ;
        }
        else{
            echo "DB Error" . mysqli_error($login);
        }
        $db = "registration";

        $login = mysqli_connect($server, $user, $password,$db); 
        if (!$login){ 
            echo "<h2>Couldn't Connect 2</h2>. ";
        }

        $regtble = "CREATE TABLE Register (fname VARCHAR(20) NOT NULL,
        lname VARCHAR(20) NOT NULL,
        email VARCHAR(40) NOT NULL,
        pass VARCHAR(15) NOT NULL)";

        if(mysqli_query($login,$regtble)){
            ;
        }
        else{
            echo "Table Error" . mysqli_error($login);
        }

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];

        $regins = "INSERT INTO Register(fname,lname,email,pass)
        VALUE ('$fname','$lname','$email','$pass')";

        if(mysqli_query($login,$regins)){
            ;
        }
        else{
            echo "Ins Error" . mysqli_error($login);
        }
        mysqli_close($login);
        ?>
    </body>
</html>