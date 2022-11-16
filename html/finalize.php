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
    <body>
        <?php
            if(isset($_COOKIE["isLogged"]))
            {
                if($_COOKIE["isLogged"] == true)
                {
                    echo'
                        <div class="header">
                            <div class="headerElement">
                                
                                <p style="float: left; font-size: 20px; margin-left: 10px"><span> zalogowany jako: ' .$_COOKIE["asWho"]. '</span>
                                
                                ';
                                
                                if($_COOKIE["isAdmin"] == 1)
                                {
                                    echo'
                                        <span> [administrator]</span>
                                    ';
                                }
                                
                            echo'
                                <form action="login.php" method="POST">

                                    <input type="hidden" name="logout" value="true">

                                    <button class="headerButton" type="submit"> Wyloguj się </button>
                                    
                                    
                                </form>
                                
                                <form action="profilBuy.php">
                                    <button class="headerButton" type="submit"> Profil </button>
                                </form>
                                
                                <form action="advertisments.php">
                                    <button class="headerButton" type="submit"> Ogłoszenia </button>
                                </form>
                                    
                            </div>
                        </div>
                    ';
                }
            }
            else
            {
                echo'
                    <div class="header">
                        <div class="headerElement">
                            <p style="float: left; font-size: 20px; margin-left: 10px"> zalogowany jako: Nie zalogowany</p>
                        </div>
                        
                        <form action="login.php">
                            <button class="headerButton" type="submit"> Zaloguj się </button>
                        </form>     
                    </div>   
                ';
            }
            
        
            
            if(isset($_GET["a"]))
            {
                if($_GET["a"] == "yess")
                {
                   echo'
                        <h1> OGŁOSZENIE WYSTAWIONE </h1>
                    ';  
                }
                else if($_GET["a"] == "no")
                {
                   echo'
                        <h1> PRODUKT ZOSTAŁ ZAKUPIONY </h1>
                    '; 
                }
            }
            
            
            $db->close();
        ?>
        
    </body>
</html>