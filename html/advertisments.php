<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");
        
    $sql = "SELECT advertisments.id, advertisments.title, advertisments.price FROM advertisments LEFT JOIN orders ON advertisments.id = orders.advertisments_id WHERE orders.id IS NULL;";
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
                        <form class="offertList" action="offert.php" method="GET">
                        
                            <input type="hidden" name="id" value='.$row["id"].'>
                            <input type="hidden" name="canBuy" value="true">
                        
                            <button class="offert" type="submit">
                                <h3> ' .$row["title"]. ' <h3>
                                <h4> ' .$row["price"]. 'PLN</h4>
                            </button>
                            <br>
                            <br>
                            <br>
                        </form>
                    ';
                }
            }
            
            $db->close();
        ?>
        
    </body>
</html>