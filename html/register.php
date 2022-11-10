<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk")
?>

<html>
    <head>
        <title>zsp-shop</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="styl.css">
    </head>
    <body style="width: 40%; margin: auto">
        
        <form action="register.php" method="post">
            <div style="text-align: center">
                <h1>ZSP-Shop</h1>
                <h2>Tworzenie konta</h2>
                
                <div style="text-align: right">
                    <p><label> Podaj login: <input type="text" name="userNick"></label></p>
                    <p><label> Podaj hasło: <input type="password" name="userPassword"></label></p>
                    <p><label> Podaj imie: <input type="text" name="userName"></label></p>
                    <p><label> Podaj nazwisko: <input type="text" name="userLastname"></label></p>
                    <p><label> Podaj numer telefonu: <input type="text" name="userPhone"></label></p>
                    
                </div>
                
                <p><span><button type="submit">Create Account</button></span><span> ------- </span><span><a href="login.php">have account? Log in</a></span></p>
            </div>
        </form>
        
        
        <?php
            
            $canCreate = 1;
            $zero = 0;

            if(isset($_POST["userNick"]) and isset($_POST["userPassword"]) and isset($_POST["userName"]) and isset($_POST["userLastname"]) and isset($_POST["userPhone"]))
            {
                if($_POST["userNick"] != "" and $_POST["userPassword"] != "" and $_POST["userName"] != "" and $_POST["userLastname"] != "" and $_POST["userPhone"] != "")
                {
                    
                    $sql = 'INSERT INTO accounts (nick_name, password, name, lastname, phone, is_admin) VALUES ("'.$_POST["userNick"].'", "'.$_POST["userPassword"].'", "'.$_POST["userName"].'", "'.$_POST["userLastname"].'", "'.$_POST["userPhone"].'",' .$zero. ');';
                    
                    
                    $db->query($sql);
                    
                    echo'
                        <h2> Konto stworzone </h2>
                    ';
                    
                }
                else
                {
                    echo'
                        <h2> Nie wszystkie dane są uzupełnione </h2>
                    ';
                }
            }

            $db->close();
        
        ?>
        
    </body>
</html>