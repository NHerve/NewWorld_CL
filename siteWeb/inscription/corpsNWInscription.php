<?php
?>
		<div class="cl-12 corp" style="height:100%;">
		
			<form method="post" class="formulaire_inscription" action="inscriptionFonction.php">
		
			<div class="cl-6">

	
				<label>Pseudo* :<br /><input type="text" name="pseudo" required/></label><br/><br/>

				<label>Nom* : <br /><input type="text" name="nom" required/></label><br/><br/>
	
				<label>Prenom* : <br /><input type="text" name="prenom" required/></label><br/><br/>

				<label>Telephone fixe : <br /><input type="text" name="tel_fixe"/></label><br/><br/>

				<label>Telephone portable : <br /><input type="text" name="tel_portable"/></label><br/><br/>

				<label>Adresse e-mail* : <br /><input type="email" name="email" required/></label><br/><br/>

				<label>Adresse* : <br /><input type="text" name="adresse" required/></label><br/><br/>

				<label>Code-Postal* : <br /><input type="text" name="code_postal" required/></label><br/><br/>

				<label>Ville* : <br /><input type="text" name="ville" required/></label><br/><br/>

				Type d'utilisateur* :
					<label><input type= "radio" name="type_user" value="producteur" onclick="afficher('visible','hidden')">Producteur</label>
					<label><input type= "radio" name="type_user" value="consommateur" onclick="afficher('hidden','hidden')" checked>Consommateur</label>
					<label><input type= "radio" name="type_user" value="point_de_vente" onclick="afficher('visible','visible')">Point de vente</label>
				<br/><br />

			
				<input type="submit" value="M'inscrire">
			
			</div>

			<script>
				function afficher(etat,etat2){
				document.getElementById('producteur').style.visibility=etat;	
				document.getElementById('point_vente').style.visibility=etat2;	
				}
			</script>

			<div class="cl-6 liste_deroulante">
			
				<label>Choisir une question secrete* : <br/>
				<select name="question" size="1">
				<option value="1">Quel est le nom de votre premier animal de compagnie ?</option>
				<option value="2">Quel est le nom de jeune fille de votre mere ?</option>
				<option value="3">Quel est le nom de votre premiere ecole?</option>
				<option value="4">Quel est votre couleur prefere ?</option>
				</select>
				</label><br/><br/>
				<label>Reponse* :<br /><input type="text" name="reponse" required/></label><br/><br/>

				
				<div id="producteur" style="visibility:hidden;">
						<label>IBAN :<br /><input type="text" name="iban"/></label><br/><br/>
				</div>

				<div id="point_vente" style="visibility:hidden;">
						<div class=input_number>
							<label>Horaire :<br /></label>	
							<label>Lundi :<br /><input type="number" min="0" max="23" name="j1h1" size="10"/></label>:<input type="number" min="0" max="59" name="j1m1"/><label>
								a<input type="number" min="0" max="23" name="j1h2" size="10"/></label>:<input type="number" min="0" max="59" name="j1m2"/><br />

							<label>Mardi :<br /><input type="number" min="0" max="23" name="j2h1"/></label>:<input type="number" min="0" max="59" name="j2m1"/><label>
								a<input type="number" min="0" max="23" name="j2h2" size="10"/></label>:<input type="number" min="0" max="59" name="j2m2"/><br />

							<label>Mercredi :<br /><input type="number" min="0" max="23" name="j3h1"/></label>:<input type="number" min="0" max="59" name="j3m1"/><label>
								a<input type="number" min="0" max="23" name="j3h2" size="10"/></label>:<input type="number" min="0" max="59" name="j3m2"/><br />

							<label>Jeudi :<br /><input type="number" min="0" max="23" name="j4h1"/></label>:<input type="number" min="0" max="59" name="j4m1"/><label>
								a<input type="number" min="0" max="23" name="j4h2" size="10"/></label>:<input type="number" min="0" max="59" name="j4m2"/><br />

							<label>Vendredi :<br /><input type="number" min="0" max="23" name="j5h1"/></label>:<input type="number" min="0" max="59" name="j5m1"/><label>
								a<input type="number" min="0" max="23" name="j5h2" size="10"/></label>:<input type="number" min="0" max="59" name="j5m2"/><br />

							<label>Samedi :<br /><input type="number" min="0" max="23" name="j6h1"/></label>:<input type="number" min="0" max="59" name="j6m1"/><label>
								a<input type="number" min="0" max="23" name="j6h2" size="10"/></label>:<input type="number" min="0" max="59" name="j6m2"/><br />

							<label>Dimanche :<br /><input type="number" min="0" max="23" name="j7h1"/></label>:<input type="number" min="0" max="59" name="j7m1"/><label>
								a<input type="number" min="0" max="23" name="j7h2" size="10"/></label>:<input type="number" min="0" max="59" name="j7m2"/><br />

						</div>




				</div>


			</div>
			</form>

		</div>

