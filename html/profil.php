<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");

    $sql_buyList = 'SELECT advertisments.title, advertisments.price FROM advertisments JOIN orders ON advertisments.id = orders.advertisments_id WHERE advertisments.id = '.$_COOKIE["loggedID"].';';


    $sql_offertList = 'SELECT id, title, price FROM `advertisments` WHERE accounts_id = '.$_COOKIE["loggedID"].';';
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
                                
                                <form action="profil.php">
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
        
            
            echo'
                <div class="offertsLogo">
                    <h2 style="text-align: left">Profil użytkownika: '.$_COOKIE["asWho"].'</h2>
                    <hr style="color: orange; background-color: orange; height: 3px; border-width:0">
                </div>
            ';
        
        ?>
        
        
        
        
        
        <div style="width: 80%; margin: auto">
            <div style="width: 50%; float: left; text-align: center">
                <h2>Sprzedajesz</h2>
                
                <?php
                    
                    if($res = $db->query($sql_offertList))
                    {
                        while($row = $res->fetch_array())
                        {
                            echo'
                            
                                <button class="offert">
                                    <h3> ' .$row["title"]. ' </h3>
                                    <b> ' .$row["price"]. 'ZŁ </b>
                                    <br>
                                    
                                    <form action="offert.php" method="GET">
                                    
                                        <input type="hidden" name="id" value='.$row["id"].'>
                                        <input type="hidden" name="canBuy" value="false">
                                        <button type="submit"> Edytuj </button>
                                    </form>
                                </button>
                                <br>
                                <br>
                                <br>
                            ';
                        }
                    }
                ?>
                
            </div>
            <div style="width: 50%; float: left; text-align: center">
                <h2>Kupujesz</h2>
                
                <?php
                    
                    if($res = $db->query($sql_buyList))
                    {
                        while($row = $res->fetch_array())
                        {
                            echo'
                                <button class="offert">
                                    <h3> ' .$row["title"]. ' <h3>
                                    <h4> ' .$row["price"]. 'PLN</h4>
                                </button>
                                <br>
                            ';
                        }
                    }
                
                    $db->close();
                ?>
            </div>
        </div>
    </body>
</html>