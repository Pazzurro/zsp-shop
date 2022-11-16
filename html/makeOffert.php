<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");
    
    $sqlNewOffert = 'INSERT INTO advertisments (title, content, price, accounts_id, product_type_id) VALUES';

    $sqlProductType = "SELECT type FROM product_type";
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
            
        
            $a = 1;
            $b = 2;
            $c = 3;
                    
            echo'
                <h1>WYSTAWIASZ</h1>
                        
                        
                <form action="makeOffert.php" method="POST">
                        
                    <div>
                        <h1> DANE OGŁOSZENIA <h2>
                        <br>
                        <label> Nazwa ogłoszenia <input type="text" name="title"></label><br>
                        <label> Opis <input type="text" name="content"></label><br>
                        <label> Cena <input type="text" name="price"></label><br>

                        <p> Stan przedmiotu </p>

                        <label style="font-size: 17px;"> Nowy <input type="radio" name="nr" value='.$a.'></label><br>
                        <label style="font-size: 17px;"> Używany <input type="radio" name="nr" value='.$b.'></label><br>
                        <label style="font-size: 17px;"> uszkodzony <input type="radio" name="nr" value='.$c.'></label><br>

                        <br>

                        <input type="hidden" name="make" value="true">

                        <br><br><br>

                        <button type="submit">WYSTAW</button>
                    </div>
                </form>
            ';
                    
                    
                    
            if(isset($_POST["make"]) )
            {
                if($_POST["make"] == "true")
                {
                    if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["price"]) && isset($_POST["nr"]))
                    {
                        if($_POST["title"] != "" || $_POST["content"] != "" || $_POST["price"] != "" || $_POST["nr"] != "")
                        {
                           $a = 1;

                            $db->query($sqlNewOffert .'("'.$_POST["title"].'", "'.$_POST["content"].'", '.$_POST["price"].', '.$_COOKIE["loggedID"].', '.$_POST["nr"].');');

                            header('Location: finalize.php?a=yess'); 
                        }
                        else
                        {
                            echo'
                                <h3> Nie podano wszystkich danych </h3>
                            ';
                        }

                    }
                    else
                    {
                        echo'
                            <h3> Nie podano wszystkich danych </h3>
                        ';
                    }
                }
            }
                
            
        
            $db->close();
        ?>
        
    </body>
</html>