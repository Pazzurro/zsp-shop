<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");
        
    $sql = "SELECT advertisments.title, advertisments.price FROM advertisments LEFT JOIN orders ON advertisments.id = orders.advertisments_id WHERE orders.id IS NULL;";
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
                                
                                <p style="float: left; font-size: 20px; margin-left: 10px"> zalogowany jako: ' .$_COOKIE["asWho"]. '</p>
                            
                                <form action="login.php" method="POST">

                                    <input type="hidden" name="logout" value="true">

                                    <button class="headerButton" type="submit"> Wyloguj się </button>
                                    
                                    
                                </form>
                                
                                <form action="profil.php">
                                    <button class="headerButton" type="submit"> Profil </button>
                                </form
                                
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
                        
                        <form action="advertisments.php">
                            <button class="headerButton" type="submit"> Ogłoszenia </button>
                        </form>
                    </div>   
                ';
            }

        ?>
        
        
        <div class="offertsLogo">
            <h2>Ogłoszenia</h2>
            <hr style="color: orange; background-color: orange; height: 3px; border-width:0;">
        </div>
        
        
        <?php
            
            if($res = $db->query($sql))
            {
                while($row = $res->fetch_array())
                {
                    echo'
                        <button class="offert">
                            <h3> ' .$row["title"]. ' <h3>
                            <h4> ' .$row["price"]. 'PLN</h4>
                        </button>
                    ';
                }
            }
            
            $db->close();
        ?>
        
    </body>
</html>