<!DOCTYPE HTML>

<html>
    <head>
        <title>zsp-shop</title>
        <meta charset="utf-8">
    </head>
    <body style="width: 30%; margin: auto">
        
        <form action="login.php" method="post">
            <div style="text-align: center">
                <h1>ZSP-Shop</h1>
                <h2>Tworzenie konta</h2>
                
                <div style="text-align: right">
                    <p><label> Podaj login: <input type="text" name="userNick"></label></p>
                    <p><label> Podaj hasło: <input type="password" name="userPassword"></label></p>
                    <p><label> Podaj imie: <input type="text" name="userName"></label></p>
                    <p><label> Podaj nazwisko: <input type="text" name="userLastname"></label></p>
                    <p><label> Podaj numer telefonu: <input type="text" name="userPhone"></label></p>
                    
                    <input type="hidden" name="accountCreating" value="true">
                </div>
                
                <p><span><button type="submit">Create Account</button></span><span> ------- </span><span><a href="login.php">have account? Log in</a></span></p>
            </div>
        </form>
        
    </body>
</html>