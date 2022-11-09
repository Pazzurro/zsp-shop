<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");
?>

<html>
    <head>
        <title>zsp-shop</title>
        <meta charset="utf-8">
    </head>
    <body style="width: 30%; margin: auto">
    
        <?php
            if(isset($_POST["accountCreating"]))
            {
                if($_POST["accountCreating"] = "true")
                {
                    $sql = 'INSERT INTO accounts (name, lastname, phone, nick_name, password, is_admin) VALUES
                        ('.$_POST["userName"].', '.$_POST["userLastname"].', '.$_POST["userPhone"].', '.$_POST["userNick"].', '.$_POST["userPassword"].');
                    ';

                    // $db->query($sql);

                    echo'
                        <h2 style="text-align: center"> Konto stworzone! </h2>
                    ';
                }
            }
        ?>
        
        
        
        <form action="login.php" method="post">
            <div style="text-align: center">
                <h1>ZSP-Shop</h1>
                <h2>Logowanie</h2>
                
                <p><label> login: <input type="text" name="userName"></label></p>
                <p><label> hasło: <input type="password" name="userPassword"></label></p>
                
                <p><span><button type="submit">Log in</button></span><span> --------- </span><span><a href="register.php">Create account</a></span></p>
            </div>
        </form>
        
        
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