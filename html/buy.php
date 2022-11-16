<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");

    $sqlOffert = 'SELECT advertisments.title, advertisments.price FROM advertisments WHERE advertisments.id = '.$_POST["id"].';';
    
    $sqlNewOrder = 'INSERT INTO orders (accounts_id, advertisments_id, status_id, created_at, post_number, city, street, house_number) VALUES';
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
            
        
            if($result = $db->query($sqlOffert))
            {
                if($row = $result->fetch_array())
                {
                    echo'
                        <div>
                            <h1>KUPUJESZ</h1>
                            <b><p style="font-size: 20">'.$row["title"].'      '.$row["price"].'PLN; 
                            <br><br><br>
                        </div>
                        <form action="buy.php" method="POST">
                        
                        <div>
                            <h1> DANE DO ZAMÓWIENIA <h2>
                            <br>
                            <label> Kod pocztowy <input type="text" name="post"></label><br>
                            <label> Miasto <input type="text" name="city"></label><br>
                            <label> Ulica <input type="text" name="street"></label><br>
                            <label> Numer domu <input type="text" name="nr"></label><br>
                            
                            <input type="hidden" name="id" value='.$_POST["id"].'>
                            <input type="hidden" name="buy" value="true">
                            <br><br><br>
                            
                            <button type="submit">KUP</button>
                            
                        </div>
                    ';
                    
                    if(isset($_POST["buy"]))
                    {
                        if(isset($_POST["post"]) && isset($_POST["city"]) && isset($_POST["street"]) && isset($_POST["nr"]))
                        {
                            $a = 1;
                            
                            $db->query($sqlNewOrder .'('.$_COOKIE["loggedID"].', '.$_POST["id"].', '.$a.','.date('y-m-d').', "'.$_POST["post"].'", "'.$_POST["city"].'", "'.$_POST["street"].'", '.$_POST["nr"].');');
                            
                            header('Location: finalize.php?a=no');
                        }
                        else
                        {
                            echo'
                                <h3> Nie podano wszystkich danych </h3>
                            ';
                        }
                    }
                }
            }
        
            $db->close();
        ?>
        
    </body>
</html>