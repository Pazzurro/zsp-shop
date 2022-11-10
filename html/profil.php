<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");

    $sql_buyList = 'SELECT advertisments.title, advertisments.price FROM advertisments JOIN orders ON advertisments.id = orders.advertisments_id WHERE advertisments.id = '.$_COOKIE["loggedID"].';';


    $sql_offertList = 'SELECT title, price FROM `advertisments` WHERE accounts_id = '.$_COOKIE["loggedID"].';';
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
                            
                                <div class="yourOffert">
                                    <h3> ' .$row["title"]. ' </h3>
                                    <span style="margin-left: 90px"> ' .$row["price"]. 'PLN </span> <button style="margin-left: 30px">edytuj</button>
                                </div>
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
                            
                                <div class="yourOffert">
                                    <h3> ' .$row["title"]. ' </h3>
                                    <span style="margin-left: 90px"> ' .$row["price"]. 'PLN </span> <button style="margin-left: 30px">edytuj</button>
                                </div>
                                <br>
                            ';
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>