<?php 
    session_start();
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




    <!--Navbar-->
    <nav class="navbar navbar-toggleable-md navbar-dark scrolling-navbar fixed-top">
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#collapseEx2" aria-controls="collapseEx2" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <strong>NW</strong>
            </a>
            <div class="collapse navbar-collapse" id="collapseEx2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a href="catalogue.php"class="nav-link">Acheter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Produire</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Distribuer</a>
                    </li>
                </ul>
                <form class="form-inline waves-effect waves-light">
                    <input class="form-control" type="text" placeholder="Search">
                </form>
            </div>
        </div>
    </nav>
    <!--/.Navbar-->

    <!--Mask-->
    <div class="view hm-black-strong" id="monIdMenu">
        <div class="full-bg-img flex-center">
            <ul>
                <li>
                    <h1 class="h1-responsive wow fadeInDown" data-wow-delay="0.2s">Connexion</h1></li>
                <li>
                <?php 

                        if(!isset($_SESSION['erreurConnexion']))
                        {
                            $_SESSION['erreurConnexion']=0;
                        }
                        else
                        {
                            if($_SESSION['erreurConnexion']==1)
                            {
                                $_SESSION['erreurConnexion']=0;
                                echo "<script type='text/javascript'>alert('Erreur identifiant ou mot de passe incorrecte');</script>";
                            }
                            if($_SESSION['erreurConnexion']==2)
                            {
                                $_SESSION['erreurConnexion']=0;
                                echo "<script type='text/javascript'>alert('Inscription valider');</script>";
                            }
                        }

                ?>
			<form method="post" class="formulaire_connexion" action="fonctionPhp/connexionFonction.php">
		<div class="row">

			<div class="col-md-12">
	
				<div class="md-form">
      					 <input type="text" name="Login" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" required>
   					 <label class=" wow bounceIn" data-wow-delay="0.2s" for="form2">Login*</label>
				</div>

				<div class="md-form">
      					 <input type="Password" name="Password" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Mot de passe*" required>
   			    </div>

				</br></br>

			
				<input class="btn btn-primary wow fadeInDown" data-wow-delay="0.2s" type="submit" value="Connexion">			
			
			</div>

		    </form>
		</div>
                </li>
            </ul>
        </div>
    </div>
    <!--/.Mask-->

   <!--Footer-->
    <footer class="page-footer center-on-small-only mdb-color darken-4">
        <hr>

        <!--Call to action-->
        <div class="call-to-action">
            <h4>NewWorld</h4>
            <ul>
                <li>
                    <h5>Connecter vous des maintenant</h5></li></br>
                <li><a href="connexion.php" class="btn btn-default">Connexion</a></li>
            </ul>
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
		

</body>

</html>
