<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");
?>

<html>
    <head>
        <title>zsp-shop</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="styl.css">
    </head>
    <body style="margin: auto">    
        
        <div class="header">
            <p>cos</p>
        </div>
        
        <form action="login.php" method="post">
            <div style="text-align: center">
                <h1>ZSP-Shop</h1>
                <h2 style="clear: both">Logowanie</h2>
                
                <p><label> login: <input type="text" name="userName"></label></p>
                <p><label> hasło: <input type="password" name="userPassword"></label></p>
                
                <p><span><button type="submit">Log in</button></span><span> --------- </span><span><a href="register.php">Create account</a></span></p>
            </div>
        </form>
        
        <div>
            <a href="advertisments.php">Lista ofert</a>
        </div>
        
        
        <?php
            $username = 0;
            $password = 0;
        
            if(isset($_POST["userName"]) and isset($_POST["userPassword"]))
            {
                if($_POST["userName"] != "" and $_POST["userPassword"] != "")
                {


                    $username = $_POST["userName"];
                    $password = $_POST["userPassword"];

                    $sql = 'SELECT nick_name, password, is_admin FROM accounts WHERE nick_name = "' .$username. '" AND password = "' .$password. '";';

                    if($result = $db->query($sql))
                    {
                        if($row = $result->fetch_array())
                        {
                            echo'
                                <p> Zalogowałeś się jako ' .$row["nick_name"]. '</p>
                            ';

                            setcookie ("isLogged", true);
                            setcookie ("asWho", $row["nick_name"]);
                            setcookie ("isAdmin", $row["is_admin"]);
                        }
                        else
                        {
                           echo'
                                <h3>Podano błędne dane logowania</h3>
                            ';  
                        }
                    }

                }
                else
                {
                    echo'
                        <h3>Nie podano wszystkich danych</h3>
                    '; 
                }
            }

            
                    
            $db->close();
        ?>
    </body>
</html>