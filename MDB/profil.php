<?php session_start();
    include 'fonctionPhp/connexionSql.php';
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

    if(isset($_SESSION['type_utilisateur']))
    {
        $Login = $_SESSION['Login'];
        $sql = "select mdp, nom, prenom, tel_fixe, tel_portable, mail, adresse, code_postal, ville, question_secrete, reponse_question_secrete from utilisateurs where login = '$Login';"; 
        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

        if($req)
        {
        $data = mysql_fetch_assoc($req);

        $mdp = $data['mdp'];
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $tel_fixe = $data['tel_fixe'];
        $tel_portable = $data['tel_portable'];
        $_SESSION['mail'] = $data['mail'];
        $adresse = $data['adresse'];
        $code_postal = $data['code_postal'];
        $ville = $data['ville'];
        $_SESSION['question_secrete']=$data['question_secrete'];
        $_SESSION['reponse_question_secrete'] = $data['reponse_question_secrete'];

        //var_dump($_SESSION['erreurModification'])

        }
         if(!isset($_SESSION['erreurModification']))
        {                           
            $_SESSION['erreurModification']=10;
        }
        else
        {
            if($_SESSION['erreurModification']==0)
            {
               echo "<script type='text/javascript'>alert('Mot de passe modifier');</script>";
               $_SESSION['erreurModification']=10;
            }
            if($_SESSION['erreurModification']==1)
            {
               echo "<script type='text/javascript'>alert('Erreur lors de la modification');</script>";
               $_SESSION['erreurModification']=10;
            }
            if($_SESSION['erreurModification']==2)
            {
                echo "<script type='text/javascript'>alert('Erreur le nouveau mot de passe et le mot de passe de confirmation ne sont pas identique');</script>";
                $_SESSION['erreurModification']=10;
            }
            if($_SESSION['erreurModification']==3)
            {
                echo "<script type='text/javascript'>alert('Erreur ancien mot de passe incorrect');</script>";
                $_SESSION['erreurModification']=10;
            }
            if($_SESSION['erreurModification']==4)
            {
                echo "<script type='text/javascript'>alert('Adresse mail modifier');</script>";
                $_SESSION['erreurModification']=10;
            }
            if($_SESSION['erreurModification']==5)
            {
                echo "<script type='text/javascript'>alert('Erreur lors de la modification');</script>";
                $_SESSION['erreurModification']=10;
            }
            if($_SESSION['erreurModification']==6)
            {
                echo "<script type='text/javascript'>alert('Erreur reponse fausse');</script>";
                $_SESSION['erreurModification']=10;
            }
            if($_SESSION['erreurModification']==7)
            {
                echo "<script type='text/javascript'>alert('Erreur mauvaise question');</script>";
                $_SESSION['erreurModification']=10;
            }
            if($_SESSION['erreurModification']==8)
            {
                echo "<script type='text/javascript'>alert('Profil mis a jour');</script>";
                $_SESSION['erreurModification']=10;
            } 
        }
    ?>

    <!--Navbar-->
    <nav class="navbar navbar-toggleable-md navbar-dark scrolling-navbar fixed-top">
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

    <!--Mask-->
    <div class="view hm-black-strong" id="monIdMenu">
        <div class="full-bg-img flex-center">
            <ul class="Profile">
                <li>
                    <h1 class="h1-responsive wow fadeInDown" data-wow-delay="0.2s">Profil</h1>
                </li>
                <li>	
		            <div class="row">
			             	<div class="col-md-6">
                                <h5 class="h5-responsive wow fadeInDown" data-wow-delay="0.2s">Modification du mot de passe</h5>
								<form method="post" action="fonctionPhp/ModifPasswordFonction.php">
				            		<div class="md-form">
      					        		 <input type="Password" name="Mdp" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Ancien mot de passe" >
				            		</div>				            		
				           			<div class="md-form">
      					    	    	 <input type="Password" name="NewMdp" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Nouveau mot de passe" >
				            		</div>
				            		<div class="md-form">
      					    		     <input type="Password" name="NewMdp2" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Confirmez le nouveau mot de passe" >
				            		</div>
				            		<br/><br/>
				            		<input class="btn btn-primary wow fadeInDown" data-wow-delay="0.2s" type="submit" value="Modifier">	
				            	</form>
			             	</div>
                         	<div class="col-md-6">
                                <h5 class="h5-responsive wow fadeInDown" data-wow-delay="0.2s">Modification de l'adresse mail</h5><br/>
			            		<form method="post" action="fonctionPhp/ModifMailFonction.php">
                                    <label>Question Secrete :</label>
                                    <select name="questionSecrete" class="browser-default">
                                        <option value="0">quel est votre date de naissance ?</option>
                                        <option value="1">quel est le nom de votre annimal de compagnie ?</option>
                                        <option value="2">quel est votre surnom ?</option>
                                        <option value="3">quel est votre jeu préféré ?</option>
                                        <option value="4">quel est le nom de votre meilleur ami ?</option>
                                        <option value="5">quel est votre première voiture ?</option>
                                        <option value="6">quel est le nom de votre premier proffesseur ?</option>
                                        <option value="7">quel est le nom de jeune fille de votre mêre ?</option>
                                        <option value="8">quel est le prenom de votre premier enfant ?</option>   
                                    </select>
                            		<div class="md-form">
                            		     <input type="text" name="ReponseSecrete" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Reponse a la question secrete" >
                            		</div>
                                    <div class="md-form">
                                         <input type="email" name="NewMail" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Nouvelle adresse mail" >
                                    </div>
                            		<br/><br/>
                            		<input class="btn btn-primary wow fadeInDown" data-wow-delay="0.2s" type="submit" value="Modifier">
                            	</form>           
                         	</div>
		            </div>
                    <br/><br/>
                    <form method="post" action="fonctionPhp/ModifAdresseFonction.php">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="md-form">
                                 <br/>
                                 <input type="text" name="Adresse" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Adresse" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h5 class="h5-responsive wow fadeInDown" data-wow-delay="0.2s">Modification du mot de l'adresse</h5>
                            <div class="md-form">
                                 <input type="text" name="CodePostal" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Code Postal" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form">
                                 <br/>
                                 <input type="text" name="Ville" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Ville" >
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-primary wow fadeInDown" data-wow-delay="0.2s" type="submit" value="Modifier">
                    </form>
                    <br/>
                    <form method="post" action="fonctionPhp/ModifTelephonneFonction.php">
                    <h5 class="h5-responsive wow fadeInDown" data-wow-delay="0.2s">Modification du telephonne</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="md-form">
                                 <br/>
                                 <input type="text" name="TelFixe" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Telephonne fixe" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form">
                                 <br/>
                                 <input type="text" name="TelPort" class="form-control wow bounceIn whiteText" data-wow-delay="0.2s" placeholder="Telephonne portable" >
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-primary wow fadeInDown" data-wow-delay="0.2s" type="submit" value="Modifier">
                    </form>
                </li>
            </ul>
		</div>
    </div>

    <!--/.Mask-->
    <div class="container">

        <div class="divider-new">
            <h2 class="h2-responsive wow bounceIn">Iban</h2>
        </div>
                </form>
                    <form method="post" action="fonctionPhp/ModifIbanFonction.php">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                 <input type="text" name="Iban" class="form-control wow bounceIn blackText" data-wow-delay="0.2s" placeholder="Iban" >
                            </div>
                        </div>
                    </div>
                    <center><input class="btn btn-primary wow fadeInDown" data-wow-delay="0.2s" type="submit" value="Modifier"></center>
                </form>
        <!--Section: Info-->
        <section id="about" class="text-center wow bounceIn" data-wow-delay="0.2s">



        </section>
        <!--Section: Info-->
    </div>

   <!--Footer-->
    <footer class="page-footer center-on-small-only mdb-color darken-4">
        <hr>

        <!--Call to action-->
        <div class="call-to-action">
            <h4>NewWorld</h4>
            <ul>
                <li>
                    <h5>Connecter vous des maintenant</h5></li></br>
                <li><a target="_blank" href="https://mdbootstrap.com/material-design-for-bootstrap/" class="btn btn-default">Connexion</a></li>
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
		
    <?php
        }
        else
        {
            header('Location: connexion.php');
        }
    ?>
</body>

</html>
