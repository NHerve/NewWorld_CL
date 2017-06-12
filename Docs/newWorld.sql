CREATE TABLE `employer`(`login` varchar(255),`mdp` varchar(255),`nom` varchar(255),`prenom` varchar(255),`tel_fixe` varchar(255),`tel_portable` varchar(255),`mail` varchar(255),`adresse` varchar(255),`code_postal` varchar(255),`ville` varchar(45),`type_utilisateur` varchar(255),`etat_validation` varchar(255),`date_inscription` date,`iban` varchar(34),primary key(`login`));

CREATE TABLE `pointDeVente`(`noPDV` varchar(11),`adresse` varchar(50),`codePostal` varchar(10),`nom` varchar(50),`activite` varchar(50),`ville` varchar(30),`tel` varchar(20),`responsable` int(11),`horaire` varchar(255),primary key(`noPDV`));

CREATE TABLE `rayon`(`noRayon` varchar(11),`libelle` varchar(30),primary key(`noRayon`));

CREATE TABLE `utilisateurs`(`login` varchar(255),`mdp` varchar(255),`nom` varchar(255),`prenom` varchar(255),`tel_fixe` varchar(255),`tel_portable` varchar(255),`mail` varchar(255),`adresse` varchar(255),`code_postal` varchar(255),`ville` varchar(255),`type_utilisateur` varchar(255),`question_secrete` int(2),`reponse_question_secrete` varchar(255),`etat_validation` varchar(255),`date_inscription` date,`iban` varchar(34),`rib` varchar(255),`horraire_point_vente` varchar(255),primary key(`login`));

CREATE TABLE `villes_france`(`ville_id` mediumint(8),`ville_departement` varchar(3),`ville_slug` varchar(255),`ville_nom` varchar(45),`ville_nom_simple` varchar(45),`ville_nom_reel` varchar(45),`ville_nom_soundex` varchar(20),`ville_nom_metaphone` varchar(22),`ville_code_postal` varchar(255),`ville_commune` varchar(3),`ville_code_commune` varchar(5),`ville_arrondissement` smallint(3),`ville_canton` varchar(4),`ville_amdi` smallint(5),`ville_population_2010` mediumint(11),`ville_population_1999` mediumint(11),`ville_population_2012` mediumint(10),`ville_densite_2010` int(11),`ville_surface` float,`ville_longitude_deg` float,`ville_latitude_deg` float,`ville_longitude_grd` varchar(9),`ville_latitude_grd` varchar(8),`ville_longitude_dms` varchar(9),`ville_latitude_dms` varchar(8),`ville_zmin` mediumint(4),`ville_zmax` mediumint(4),primary key(`ville_id`));

CREATE TABLE `visite`(`id` INTEGER,`dateVisite` DATE,`hDeb` TIME,`hFin` TIME,`commentaire` VARCHAR(255),`login` varchar(255) NOT NULL, foreign key (`login`) references employer(`login`),primary key(`id`));

CREATE TABLE `visiteProd`(`hArr` TIME,`hFin` TIME,`etat` VARCHAR(255),`commentaire` VARCHAR(255),`login` varchar(255) NOT NULL,`id` INTEGER NOT NULL, foreign key (`login`) references utilisateurs(`login`), foreign key (`id`) references visite(`id`),primary key(`login`,`id`));

CREATE TABLE `categorie`(`noCat` varchar(11),`libelle` varchar(30),`noRayon` varchar(11) NOT NULL, foreign key (`noRayon`) references rayon(`noRayon`),primary key(`noCat`));

CREATE TABLE `produit`(`numero` int(11),`libelle` varchar(100),`pu` float,`qte` int(11),`etat_produit` varchar(50),`noCat` varchar(11) NOT NULL, foreign key (`noCat`) references categorie(`noCat`),primary key(`numero`));

CREATE TABLE `lot`(`id` INTEGER,`qte` INTEGER,`dateRecolte` DATE,`nbJourConservation` INTEGER,`uniteVente` VARCHAR(255),`modeProduction` VARCHAR(255),`ramassageManuelle` VARCHAR(255),`pu` FLOAT,`login` varchar(255) NOT NULL,`numero` int(11) NOT NULL, foreign key (`login`) references utilisateurs(`login`), foreign key (`numero`) references produit(`numero`),primary key(`login`,`numero`,id));

CREATE TABLE `Propose`(`login` varchar(255) NOT NULL,`numero` int(11) NOT NULL,`id` INTEGER NOT NULL,`noPDV` varchar(11) NOT NULL, foreign key (`login`,`numero`,id) references lot(`login`,`numero`,id), foreign key (`noPDV`) references pointDeVente(`noPDV`),primary key(`login`,`numero`,id,`noPDV`));

CREATE TABLE `valider`(`login` varchar(255) NOT NULL,`id` INTEGER NOT NULL,`numero` int(11) NOT NULL, foreign key (`login`,`id`) references visiteProd(`login`,`id`), foreign key (`numero`) references produit(`numero`),primary key(`login`,`id`,`numero`));

CREATE TABLE `questions_secrete` (`id_question` INTEGER(11) NOT NULL , `libelle` varchar(255) DEFAULT NULL, PRIMARY KEY (`id_question`));


INSERT INTO `questions_secrete` (`id_question`, `libelle`) VALUES
(0,'quel est votre date de naissance ?'),
(1,'quel est le nom de votre annimal de compagnie ?'),
(2,'quel est votre surnom ?'),
(3,'quel est le nom de votre meilleur ami ?'),
(4,'quel est votre jeu préféré ?'),
(5,'quel est votre première voiture ?'),
(6,'quel est le nom de votre premier proffesseur ?'),
(7,'quel est le nom de jeune fille de votre mêre ?'),
(8,'quel est le prenom de votre premier enfant ?'),





insert into visite values(1,'2017-05-29','09:10;00','10:10:00','visite des produits','controleur','gestionnaire');

insert into visiteProd values('09:15:00','10:15:00','valide','produits de qualite','jbaron',1);
insert into visiteProd values('09:15:00','10:15:00','valide','verifier','ballec',1);

insert into lot values(0,10,'2017-06-02',5,'kg','verger','oui',4,'jbaron',5);
insert into lot values(1,10,'2017-06-02',5,'kg','elevage','oui',2,'jbaron',2);
insert into lot values(2,10,'2017-06-02',5,'kg','elevage','oui',5,'jbaron',3);
insert into lot values(3,10,'2017-06-02',5,'kg','elevage','oui',8,'jbaron',4);
