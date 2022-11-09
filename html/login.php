<!DOCTYPE HTML>

<html>
    <head>
        <title>zsp-shop</title>
        <meta charset="utf-8">
    </head>
    <body>
    
        <form action="login.php" method="post">
            <div style="text-align: center">
                <h1>ZSP-Shop</h1>
                
                <p><label> login: <input type="text" name="userName"></label></p>
                <p><label> hasło: <input type="password" name="userPassword"></label></p>
                
                <p><span><button type="submit">Log in</button></span><span> --------- </span><span><a href="register.php">Create account</a></span></p>
            </div>
        </form>
        
        
        <?php
            $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");
            
            $username = 0;
            $password = 0;
        
        
            if(isset($_POST["userName"]) || isset($_POST["userPassword"]))
            {
                echo'
                    <h3>Nie podano wszystkich danych</h3>
                ';  
                
                $username = $_POST["userName"];
                $password = $_POST["userPassword"];
                
                $sql = 'SELECT nick_name, password FROM accounts WHERE nick_name = "' .$username. '" AND password = "' .$password. '";';
                
                if($result = $db->query($sql))
                {
                    while($row = $result->fetch_array())
                    {
                        echo'
                            <p> Zalogowałeś się jako ' .$row["nick_name"]. '</p>
                        ';
                    }
                }
                
            }
        
            
                    
            $db->close();
        ?>
    </body>
</html>