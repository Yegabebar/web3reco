<?php 
    try{
        require("../included/dbconnect.php");
        require("../misc/formbuilder.php");
        $form = new formbuilder();
        $bookListSuppr="";
        
        // Query scrolling
        $sql = "SELECT idProduct, nameProduct FROM Product ";
        $result = $dbh->query($sql);
        while(($oneBook = $result->fetch(PDO::FETCH_ASSOC)) !=FALSE){
            $bookListSuppr .= '<option value ='.$oneBook['idProduct'].' >' .$oneBook['nameProduct']. '</option>';
        };

        $selectedBook = (string) filter_input(INPUT_GET,'namestring',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sql = "DELETE FROM Product WHERE nameProduct = '$selectedBook'";
        $resultDelete = $dbh->query($sql);
        
    }catch(Exception $e){
        echo '<!DOCTYPE html>';
        echo '<html lang="fr"><head>';
        echo '<meta charset="utf-8">';
        echo '<title>Problème rencontré</title>';
        echo '</head><body>';
        echo '</body></html>';

        // Stop script
        die;
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Péhachepet Market - Customer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" type="text/css" href="../css/styles.css">
    </head>
    <body>
        <?php include_once("../included/banner.html") ?>
        <main>
            <article>
                <header class="sub-banner">
                    <h2>Remove products from inventory</h2>
                </header>
                <section>
                    <div class = "operation">
                        <?php
                            echo $form-> deleteBook($bookListSuppr);
                           
                        ?>
                    </div>
                    <div class = "result">
                        <?php
                            echo $resultDelete;
                        ?>
                    </div>
                </section>
                <ul>
                    <li class="back"><a href="../admin.php">Previous page</a></li>
                </ul>
            </article>
        </main>
        <?php include_once("../included/footer.html") ?>
    </body>
</html>