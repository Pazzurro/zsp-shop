<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");

    $sql = 'SELECT advertisments.title, advertisments.content, advertisments.price, product_type.type FROM advertisments JOIN product_type ON advertisments.product_type_id = product_type.id WHERE advertisments.id = '.$_GET["id"].';';

    $sqlStatus = 'SELECT status.status FROM status JOIN orders ON status.id = orders.status_id WHERE orders.advertisments_id = '.$_GET["id"].';';

    
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
        
            
            if($result = $db->query($sql))
            {
                if($row = $result->fetch_array())
                {
                    if(!isset($_GET["canBuy"]))
                    {
                        
                        echo'
                            <h1> ZAKOŃCZONE </h1>
                        ';
                        
                        if($res = $db->query($sqlStatus))
                        {
                            if($rowStatus = $res->fetch_array())
                            {
                                echo'
                                    <h2> Status zamówienia: '.$rowStatus["status"].' </h2>
                                ';
                            }
                        }
                    }
                    
                    
                    echo'

                        <h1>Ogłoszenie nr: '.$_GET["id"].'</h1>
                        <br><br>

                        <h1>'.$row["title"].'</h1>
                        <h2>'.$row["type"].'</h2>
                        <h2>'.$row["price"].'</h2>
                        <br><br>
                        <h3>OPIS:</h3>
                        <h4>'.$row["content"].'</h4>
                    ';  
                    
                    if(isset($_GET["canBuy"]) && isset($_COOKIE["isLogged"]))
                    {
                        echo'
                            <form action="buy.php" method="POST">
                                <input type="hidden" name="id" value='.$_GET["id"].'>

                                <button type="submit"> KUP </button>
                            </form>
                        ';  
                        
                    }
                }
            }
              
            $db->close();
        ?>
    </body>
</html>