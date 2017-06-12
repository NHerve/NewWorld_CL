<?php session_start();
    include 'fonctionPhp/connexionSql.php';
    ini_set("display_errors",0);error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>NewWorld</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    if(isset($_SESSION['type_utilisateur']) && $_SESSION['type_utilisateur'] == producteur)
    {
    ?>
    <!--Navbar-->
    <nav class="navbar navbar-toggleable-md navbar-dark scrolling-navbar fixed-top colorNavbar">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapseEx2" aria-controls="collapseEx2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="connexionReussi.php">
                <strong>NW</strong>
            </a>
            <div class="collapse navbar-collapse" id="collapseEx2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a href="catalogue.php"class="nav-link">Acheter</a>
                    </li>
                    <li class="nav-item">
                        <a href="proposer.php" class="nav-link">Produire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Distribuer</a>
                    </li>
                    <li class="nav-item">
                        <a href="panier.php"class="nav-link">Panier</a>
                    </li>
                </ul>
                    <a href="profil.php" class="nav-link">Profil</a>
                <form class="form-inline waves-effect waves-light">
                    <input class="form-control" type="text" placeholder="Search">
                </form>
                <a href="fonctionPhp/deconnexionFonction.php" class="nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
        </div>
    </nav>
    <!--/.Navbar-->
    <!-- Main container-->
    <br/>
    <div class="container">

        <div class="divider-new">
            <h2 class="h2-responsive wow bounceIn">Ajouterun produit</h2>
        </div>

        <!--Section: Info-->
        <section id="about" class="text-center wow bounceIn" data-wow-delay="0.2s">
            <div id="rayon">
            <?php
                $sql = "select libelle, noRayon from rayon where etat_rayon ='valide';"; 

                 $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

                if($req)
                {

                    while($data = mysql_fetch_assoc($req))
                    {
                        echo "<button type='button' onclick='loadCat(\"".$data['noRayon']."\")' class='btn btn-primary wow fadeInDown' data-wow-delay='0.2s' type='submit' value='Connexion'>".$data['libelle']."</button>"; 
                    }
                 
                }

            ?>    
            </div>
            <div id="categorie">
            </div>
            <div id="produit">
            </div>
            <div id="lot">
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                <script language="javascript">

                function loadCat(noRayon)
                {
                    $.ajax({
                        url : "fonctionPhp/ajaxFonctionCat.php",
                        type : "POST",
                        dataType : "JSON",
                        data : {noRayon : noRayon},
                        success : function(data)
                        {
                            $('#categorie').html(data)
                        }
                    });
                }

                function loadProd(noCat)
                {
                    $.ajax({
                        url : "fonctionPhp/ajaxFonctionProd.php",
                        type : "POST",
                        dataType : "JSON",
                        data : {noCat : noCat},
                        success : function(data)
                        {
                            $('#produit').html(data)
                        }
                    });
                }

                function loadLot(noProd)
                {
                    $.ajax({
                        url : "fonctionPhp/ajaxFonctionAddLot.php",
                        type : "POST",
                        dataType : "JSON",
                        data : {noProd : noProd},
                        success : function(data)
                        {
                            $('#lot').html(data)
                        }
                    });
                }
                </script>
        </section>
        <!--Section: Info-->
    
    </div>
    <!--/ Main container-->



    <!--Footer-->
    <footer class="page-footer center-on-small-only mdb-color darken-4 fixed-bottom">
        <hr>

        <!--Call to action-->
        <div class="call-to-action">
            <h4>NewWorld</h4>

        </div>
        <!--/.Call to action-->

    </footer>
    <!--/.Footer-->


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>

    <!--Google Maps-->
    <script src="https://maps.google.com/maps/api/js"></script>

    <!-- Animations init-->
    <script>
        new WOW().init();
    </script>

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/tether.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
		
    <?php
        }
        else
        {
            header('Location: connexion.php');
        }
    ?>
</body>

</html>
