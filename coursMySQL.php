<!DOCTYPE html>
<html>
    <head>
        <title>Cours PHP / MySQL</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>MySQL</h1>  
<!-- ------------------------------ -->
<h2>BASE DE DONNÉES MYSQL AVEC PDO</h2>
<!-- ------------------------------ -->
<?php
//
////////// COMMANDES À CONNAITRE

//// Commandes SQL
/*______________________________
SELECT - extracts data from a database
UPDATE - updates data in a database
DELETE - deletes data from a database
INSERT INTO - inserts new data into a database
CREATE DATABASE - creates a new database
ALTER DATABASE - modifies a database
CREATE TABLE - creates a new table
ALTER TABLE - modifies a table
DROP TABLE - deletes a table
CREATE INDEX - creates an index (search key)
DROP INDEX - deletes an index
______________________________*/

//// Types de valeurs
/*______________________________
INT(length) : entiers relatifs [-2 147 483 648, 2 147 483 647]
INT(length) UNSIGNED : entiers positifs [0, 4 294 967 295] ;
BIGINT(length) : entiers plus grands que INT
FLOAT : nombre décimal
DOUBLE
VARCHAR(length) : chaine (entre 0 et 65 535 caractères) ;
TEXT : chaine de 65 535 caractères max;
DATE : date entre le 01/01/1000 et le 31/12/9999.
DATETIME : avec l'heure
TIMESTAMP : date courante
______________________________*/

//// Attributs
/*______________________________
NOT NULL – doit contenir une valeur;
UNIQUE – Chacune des valeurs doit être unique;
PRIMARY KEY – chaque table doit obligatoirement posséder une colonne avec une PRIMARY KEY pour identifier de manière unique chaque nouvelle entrée dans une table = NOT NULL + UNIQUE
FOREIGN KEY – pour les liens entre des tables;
CHECK – vérifie une certaine condition;
DEFAULT - valeur par défaut si aucune valeur n’est fournie ;
AUTO_INCREMENT – va automatiquement s'incrémenter pour chaque nouvelle entrée ;
UNSIGNED – limiter aux nombres positifs (0 inclus).
______________________________*/

//
////////// CRÉATION D'UNE BDD

$servname = 'localhost';
$dbname = 'pdodb';
$user = 'root';
$pass = 'root';

try {
  $createdbco = new PDO("mysql:host=$servname", $user, $pass);
  $createdbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sqldb = 'CREATE DATABASE pdodb';
  $createdbco->exec($sqldb); //pour exécuter une commande SQL avec PDO

  echo 'Base de données bien créée !<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//
////////// CRÉATION D'UNE TABLE

try {
  $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
  $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sqltb = "CREATE TABLE Clients(
		Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Nom VARCHAR(30) NOT NULL,
		Prenom VARCHAR(30) NOT NULL,
		Adresse VARCHAR(70) NOT NULL,
		Ville VARCHAR(30) NOT NULL,
		Codepostal INT UNSIGNED NOT NULL,
		Pays VARCHAR(30) NOT NULL,
		Mail VARCHAR(50) NOT NULL,
		DateInscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		UNIQUE(Mail))";
  $dbco->exec($sqltb);
  echo 'Table bien créée !<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}
?>
<!-- ----------------------- -->
<h2>MANIPULATION DE DONNÉES</h2>
<!-- ----------------------- -->
<?php //


//
////////// INSERTION

//// INSERT INTO

// INSERT INTO nom_de_table (nom_colonne1, nom_colonne2, nom_colonne3, …)
// VALUES (valeur1, valeur2, valeur3, …)

try {
  $sql0 = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
    VALUES('Giraud','Pierre','Quai d\'Europe','Toulon',83000,'France','pierre.giraud@edhec.com')";
  //pas de Id (AUTO_INCREMENT) et DateInscription (TIMESTAMP) car ces valeurs sont automatiquements mises à jour.
  $dbco->exec($sql0);

  $sql1 = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
    VALUES('Durand','Victor','Rue des Acacias','Brest',29200,'France','v.durand@gmail.com')";
  $dbco->exec($sql1);

  $sql2 = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
    VALUES('Julia','Joly','Rue du Hameau','Lyon',69001,'France','july@gmail.com')";
  $dbco->exec($sql2);

  echo 'Entrées ajoutées dans la table<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//// Transaction (plus fiable)

// En cas de problème d'exécution, certaines entrées pourraient ne pas avoir toutes leurs données insérées.
// Pour éviter cela, méthodes beginTransaction(), commit() et rollBack()
try {
  $dbco->beginTransaction(); //désactive l'autocommit

  $sql3 = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
		VALUES('Doe','John','Rue des Lys','Nantes',44000,'France','j.doe@gmail.com')";
  $dbco->exec($sql3);

  $sql4 = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
		VALUES('Dupont','Jean','Bvd Original','Bordeaux',33000,'France','jd@gmail.com')";
  $dbco->exec($sql4);

  $dbco->commit(); //applique les modifications et valide la transaction
  echo 'Entrées ajoutées dans la table<br>';
} catch (PDOException $e) {
  $dbco->rollBack(); //annule la transaction en cas d'erreur
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//
////////// REQUETES PRÉPARÉES (template)

//// avec execute(array) et marqueurs nommés (:marqueur)

try {
  $nom6 = 'Dechand';
  $prenom6 = 'Flo';
  $adresse6 = 'Rue des Moulins';
  $ville6 = 'Marseille';
  $cp6 = 13001;
  $pays6 = 'France';
  $mail6 = 'flodc@gmail.com';

  //template $sth appartient à la classe PDOStatement
  $sth6 = $dbco->prepare("
		INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
			VALUES (:nom6, :prenom6, :adresse6, :ville6, :cp6, :pays6, :mail6)
	"); //marqueurs nommés
  $sth6->execute([
    ':nom6' => $nom6,
    ':prenom6' => $prenom6,
    ':adresse6' => $adresse6,
    ':ville6' => $ville6,
    ':cp6' => $cp6,
    ':pays6' => $pays6,
    ':mail6' => $mail6,
  ]);
  echo 'Entrée ajoutée dans la table<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//// avec execut(array) et marqueurs interrogatifs (?)

try {
  $nom7 = 'Dubois';
  $prenom7 = 'Tom';
  $adresse7 = 'Rue du Chene';
  $ville7 = 'Metz';
  $cp7 = 57000;
  $pays7 = 'France';
  $mail7 = 'duboistom@gmail.com';

  $sth7 = $dbco->prepare("
			INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
			VALUES (?, ?, ?, ?, ?, ?, ?)
	");
  $sth7->execute([$nom7, $prenom7, $adresse7, $ville7, $cp7, $pays7, $mail7]);
  echo 'Entrée ajoutée dans la table<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//// avec bindValue et des marqueurs nommés

try {
  $nom8 = 'Dubois';
  $prenom8 = 'Laura';
  $adresse8 = 'Rue du Chene';
  $ville8 = 'Metz';
  $cp8 = 57000;
  $pays8 = 'France';
  $mail8 = 'lauradb@gmail.com';

  //$sth appartient à la classe PDOStatement
  $sth8 = $dbco->prepare("
		INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
			VALUES (:nom8, :prenom8, :adresse8, :ville8, :cp8, :pays8, :mail8)
	");
  //La constante de type par défaut est STR
  $sth8->bindValue(':nom8', $nom8); //associe directement une valeur à un paramètre
  $sth8->bindValue(':prenom8', $prenom8);
  $sth8->bindValue(':adresse8', $adresse8);
  $sth8->bindValue(':ville8', $ville8);
  $sth8->bindValue(':cp8', $cp8, PDO::PARAM_INT);
  $sth8->bindValue(':pays8', $pays8);
  $sth8->bindValue(':mail8', $mail8);
  $sth8->execute();
  echo 'Entrée ajoutée dans la table<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//// avec bindValue et marqueurs interrogatifs

try {
  $nom9 = 'Palaz';
  $prenom9 = 'Mathilde';
  $adresse9 = 'Rue des Cerisiers';
  $ville9 = 'Rouen';
  $cp9 = 76000;
  $pays9 = 'France';
  $mail9 = 'mathplz@gmail.com';

  $sth9 = $dbco->prepare("
		INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
			VALUES (?, ?, ?, ?, ?, ?, ?)
	");
  $sth9->bindValue(1, $nom9); //associe directement une valeur à un paramètre
  $sth9->bindValue(2, $prenom9);
  $sth9->bindValue(3, $adresse9);
  $sth9->bindValue(4, $ville9);
  $sth9->bindValue(5, $cp9, PDO::PARAM_INT);
  $sth9->bindValue(6, $pays9);
  $sth9->bindValue(7, $mail9);
  $sth9->execute();
  echo 'Entrée ajoutée dans la table<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//// avec bindParam et marqueurs nommés

try {
  $nom10 = 'Bombeur'; //on pourrait écrire ces valeurs après bindParam
  $prenom10 = 'Jean';
  $adresse10 = 'Rue des Bouchers';
  $ville10 = 'Toulouse';
  $cp10 = 31000;
  $pays10 = 'France';
  $mail10 = 'jbb@gmail.com';

  $sth10 = $dbco->prepare("
		INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
			VALUES (:nom10, :prenom10, :adresse10, :ville10, :cp10, :pays10, :mail10)
	");
  $sth10->bindParam(':nom10', $nom10);
  $sth10->bindParam(':prenom10', $prenom10);
  $sth10->bindParam(':adresse10', $adresse10);
  $sth10->bindParam(':ville10', $ville10);
  $sth10->bindParam(':cp10', $cp10, PDO::PARAM_INT); //attend execute pour être associé
  $sth10->bindParam(':pays10', $pays10);
  $sth10->bindParam(':mail10', $mail10);
  $cp10 = 31001; //la dernière valeur avant execute sera prise en compte
  $sth10->execute();
  echo 'Entrée ajoutée dans la table<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//// avec bindParam et marqueurs interrogatifs

try {
  $nom11 = 'Gérard';
  $prenom11 = 'Philippe';
  $adresse11 = 'Impasse des sans Noms';
  $ville11 = 'Nantes';
  $cp11 = 44000;
  $pays11 = 'France';
  $mail11 = 'philou@gmail.com';

  $sth11 = $dbco->prepare("
			INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Pays,Mail)
			VALUES (?, ?, ?, ?, ?, ?, ?)
	");
  $sth11->bindParam(1, $nom11); //attend execute pour être associé
  $sth11->bindParam(2, $prenom11);
  $sth11->bindParam(3, $adresse11);
  $sth11->bindParam(4, $ville11);
  $sth11->bindParam(5, $cp11, PDO::PARAM_INT);
  $sth11->bindParam(6, $pays11);
  $sth11->bindParam(7, $mail11);
  $sth11->execute();
  echo 'Entrée ajoutée dans la table<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//
////////// MODIFICATIONS

//// Données (UPDATE)

try {
  //On prépare la requête et on l'exécute
  $sthUpdt = $dbco->prepare("
		UPDATE Clients
		SET mail='victor.durand@edhec.com'
		WHERE id=2
	");
  //UPDTAE nom_table SET colonne='...' WHERE ligne(id)='...'
  $sthUpdt->execute();

  //On affiche le nombre d'entrées mise à jour
  $count = $sthUpdt->rowCount();
  print 'Mise à jour de ' . $count . ' entrée(s)<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>'; //nombre d’entrées affectées par la dernière requête
}

//// Structure (ALTER TABLE)

// Ajouter une colonne (ADD)
try {
  $sqlAddCol = "
		ALTER TABLE Clients
		ADD Age INT(3) UNSIGNED
	";

  $dbco->exec($sqlAddCol);
  echo 'Colonne ajoutée<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

// Supprimer une colonne (DROP COLUMN)
try {
  $sqlDelCol = "
		ALTER TABLE Clients
		DROP COLUMN Age
	";

  $dbco->exec($sqlDelCol);
  echo 'Colonne supprimée<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

// Modifier une colonne (MODIFY COLUMN)

try {
  $sqlModCol = "
		ALTER TABLE Clients
		MODIFY COLUMN Prenom VARCHAR(50)
	";

  $dbco->exec($sqlModCol);
  echo 'Colonne mise à jour<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//
////////// SUPPRESSION (DELETE FROM)

//// Suppression d'entrées (WHERE)

try {
  $sqlDelRow = "DELETE FROM Clients WHERE nom='Dubois'";
  $sthDelRow = $dbco->prepare($sqlDelRow);
  $sthDelRow->execute();

  $count = $sthDelRow->rowCount();
  print 'Effacement de ' . $count . ' entrées.<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

//// Suppression de toutes les données

/*______________________________
try {
  $sqlDelAll = 'DELETE FROM Clients'; // pas de WHERE
  $sthDelAll = $dbco->prepare($sqlDelAll);
  $sthDelAll->execute();
  $count = $sthDelAll->rowCount();
  print 'Effacement de ' . $count . ' entrées.';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
}
______________________________*/

//// Suppression d'une table (DROP TABLE)
/*______________________________
try {
  $sqlDelTable = 'DROP TABLE Clients';
  $dbco->exec($sqlDelTable);

  echo 'Table bien supprimée';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
}
______________________________*/

//// Suppression d'une base de données (DROP DATABASE)

/*______________________________
try {
  $sqlDelBdd = 'DROP DATABASE pdodb';
  $dbco->exec($sqlDelBdd);

  echo 'Base de données bien supprimée';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
}
______________________________*/
?>
<!-- -------------------- -->
<h2>SELECTION DE DONNÉES</h2>
<!-- -------------------- -->
<?php
//

//
////////// SELECTION SIMPLE (SELECT)
?>
    </body>
</html>
