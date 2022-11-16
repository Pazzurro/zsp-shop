<!DOCTYPE HTML>

<?php
    $db = new mysqli("127.0.0.1", "root", "", "zps-shop-dk");

    $sql = 'SELECT advertisments.title, advertisments.content, advertisments.price, product_type.id, product_type.type FROM advertisments JOIN product_type ON advertisments.product_type_id = product_type.id WHERE advertisments.id = '.$_POST["id"].';';
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
                    $a = 1;
                    $b = 2;
                    $c = 3;
                    
                    echo'
                        <form action="editOffert.php" method="POST">
                            <h1>Edycja ogłoszenia nr: '.$_POST["id"].'</h1>
                            <h3> Zostaw puste by nie zmieniać zawarości</h3>
                            
                            <br><br>

                            <h1><span>'.$row["title"].'</span><span> <input type="text" name="eTitle"></span></h1>
                            
                            <h2><span>'.$row["price"].'PLN</span><span> <input type="text" name="ePrice"></h2>
                            
                            <p> Stan przedmiotu </p>

                            <label style="font-size: 17px;"> Nowy <input type="radio" name="nr" value='.$a.'></label><br>
                            <label style="font-size: 17px;"> Używany <input type="radio" name="nr" value='.$b.'></label><br>
                            <label style="font-size: 17px;"> uszkodzony <input type="radio" name="nr" value='.$c.'></label><br>
                            
                            <br><br>
                            
                            <h3>OPIS:</h3>
                            <h4><span>'.$row["content"].'</span><span> <input type="text" name="eContent"></h4>
                            
                            <input type="hidden" name="id" value='.$_POST["id"].'>
                            <input type="hidden" name="edit" value="yes">
                            
                            
                            <button type="submit">ZATWIERDŹ</button>
                        </form>
                    '; 
                    
                    if(isset($_POST["edit"]))
                    {
                        $title = $row["title"];
                        $content = $row["content"];
                        $price = $row["price"];
                        $type = $row["id"];
                        
                        if($_POST["edit"] == "yes")
                        {
                            if($_POST["eTitle"] != "")
                            {
                                $title = $_POST["eTitle"];
                            }
                            
                            if($_POST["ePrice"] != "")
                            {
                                $price = $_POST["ePrice"];
                            }
                            
                            if($_POST["eContent"] != "")
                            {
                                $content = $_POST["eContent"];
                            }
                            
                            if(isset($_POST["nr"]))
                            {
                                $type = $_POST["nr"];
                            }
                            
                            
                            $sqlEditOffert = 'UPDATE advertisments SET title = "'.$title.'", content = "'.$content.'", price = '.$price.', product_type_id = '.$type.' WHERE id = '.$_POST["id"].';';
                            
                            
                            $db->query($sqlEditOffert);
                            
                            header("location: profilSell.php");
                        }
                    }
                }
            }
              
            $db->close();
        ?>
    </body>
</html>