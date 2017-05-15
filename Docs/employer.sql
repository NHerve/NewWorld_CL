CREATE TABLE IF NOT EXISTS `employer`(
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `tel_fixe` varchar(255) DEFAULT NULL,
  `tel_portable` varchar(255) DEFAULT NULL,
  `mail` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `code_postal` varchar(255) NOT NULL,
  `ville` varchar(45) NOT NULL,
  `type_utilisateur`varchar(255) NOT NULL,
  `etat_validation`varchar(255) DEFAULT '0',
  `date_inscription` date,
  `iban`varchar(34) DEFAULT NULL,

   PRIMARY KEY (`login`),
   FOREIGN KEY (`ville`) REFERENCES villes_france(ville_nom),
   FOREIGN KEY (`code_postal`) REFERENCES villes_france(ville_code_postal)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `employer`(login,`mdp`,`nom`,`prenom`,`mail`,`adresse`,`code_postal`,`ville`,`type_utilisateur`) VALUES ('gestionnaire','gestionnaire','aymes','prenom','herve.04@hotmail.fr','place de l acacia','04700','entrevennes','gestionnaire');
INSERT INTO `employer`(login,`mdp`,`nom`,`prenom`,`mail`,`adresse`,`code_postal`,`ville`,`type_utilisateur`) VALUES ('controleur','controleur','aymes','prenom','herve.04@hotmail.fr','place de l acacia','04700','entrevennes','controleur');
