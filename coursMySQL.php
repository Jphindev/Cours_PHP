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
////////// CRÉATION D'UNE BASE DE DONNÉES AVEC PDO

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

  //À utiliser seulement si on créé une base de données et une table en même temps
  //$sqltb = "use pdodb";
  //$dbco->exec($sqltb);

  $sqltb = "CREATE TABLE Clients(
		Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Nom VARCHAR(30) NOT NULL,
		Prenom VARCHAR(30) NOT NULL,
		Adresse VARCHAR(70) NOT NULL,
		Ville VARCHAR(30) NOT NULL,
		Codepostal INT UNSIGNED NOT NULL,
		Age INT(3) UNSIGNED NOT NULL,
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


//Quand on attend un résultat -> prepare execute de PDOStatement
//Sinon exec de PDO

//
////////// INSERTION

//// INSERT INTO

// INSERT INTO nom_de_table (nom_colonne1, nom_colonne2, nom_colonne3, …)
// VALUES (valeur1, valeur2, valeur3, …)

try {
  $sql0 = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
    VALUES('Giraud','Pierre','Quai d\'Europe','Toulon',83000,29,'pierre.giraud@edhec.com')";
  //pas de Id (AUTO_INCREMENT) et DateInscription (TIMESTAMP) car ces valeurs sont automatiquements mises à jour.
  $dbco->exec($sql0);

  $sql1 = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
    VALUES('Durand','Victor','Rue des Acacias','Brest',29200,34,'v.durand@gmail.com')";
  $dbco->exec($sql1);

  $sql2 = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
    VALUES('Julia','Joly','Rue du Hameau','Lyon',69001,21,'july@gmail.com')";
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

  $sql3 = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
		VALUES('Doe','John','Rue des Lys','Nantes',44000,29,'j.doe@gmail.com')";
  $dbco->exec($sql3);

  $sql4 = "INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
		VALUES('Dupont','Jean','Bvd Original','Bordeaux',33000,45,'jd@gmail.com')";
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
  $age6 = 29;
  $mail6 = 'flodc@gmail.com';

  //template $sth6 appartient à la classe PDOStatement
  $sth6 = $dbco->prepare("INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
		VALUES (:nom6, :prenom6, :adresse6, :ville6, :cp6, :age6, :mail6)
	"); //marqueurs nommés
  $sth6->execute([
    ':nom6' => $nom6,
    ':prenom6' => $prenom6,
    ':adresse6' => $adresse6,
    ':ville6' => $ville6,
    ':cp6' => $cp6,
    ':age6' => $age6,
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
  $age7 = 29;
  $mail7 = 'duboistom@gmail.com';

  $sth7 = $dbco->prepare("INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
		VALUES (?, ?, ?, ?, ?, ?, ?)
	");
  $sth7->execute([$nom7, $prenom7, $adresse7, $ville7, $cp7, $age7, $mail7]);
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
  $age8 = 25;
  $mail8 = 'lauradb@gmail.com';

  //$sth appartient à la classe PDOStatement
  $sth8 = $dbco->prepare("INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
		VALUES (:nom8, :prenom8, :adresse8, :ville8, :cp8, :age8, :mail8)
	");
  //La constante de type par défaut est STR
  $sth8->bindValue(':nom8', $nom8); //associe directement une valeur à un paramètre
  $sth8->bindValue(':prenom8', $prenom8);
  $sth8->bindValue(':adresse8', $adresse8);
  $sth8->bindValue(':ville8', $ville8);
  $sth8->bindValue(':cp8', $cp8, PDO::PARAM_INT);
  $sth8->bindValue(':age8', $age8);
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
  $age9 = 38;
  $mail9 = 'mathplz@gmail.com';

  $sth9 = $dbco->prepare("INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
		VALUES (?, ?, ?, ?, ?, ?, ?)
	");
  $sth9->bindValue(1, $nom9); //associe directement une valeur à un paramètre
  $sth9->bindValue(2, $prenom9);
  $sth9->bindValue(3, $adresse9);
  $sth9->bindValue(4, $ville9);
  $sth9->bindValue(5, $cp9, PDO::PARAM_INT);
  $sth9->bindValue(6, $age9);
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
  $age10 = 19;
  $mail10 = 'jbb@gmail.com';

  $sth10 = $dbco->prepare("INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
		VALUES (:nom10, :prenom10, :adresse10, :ville10, :cp10, :age10, :mail10)
	");
  $sth10->bindParam(':nom10', $nom10);
  $sth10->bindParam(':prenom10', $prenom10);
  $sth10->bindParam(':adresse10', $adresse10);
  $sth10->bindParam(':ville10', $ville10);
  $sth10->bindParam(':cp10', $cp10, PDO::PARAM_INT); //attend execute pour être associé
  $sth10->bindParam(':age10', $age10);
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
  $age11 = 45;
  $mail11 = 'philou@gmail.com';

  $sth11 = $dbco->prepare("INSERT INTO Clients(Nom,Prenom,Adresse,Ville,Codepostal,Age,Mail)
		VALUES (?, ?, ?, ?, ?, ?, ?)
	");
  $sth11->bindParam(1, $nom11); //attend execute pour être associé
  $sth11->bindParam(2, $prenom11);
  $sth11->bindParam(3, $adresse11);
  $sth11->bindParam(4, $ville11);
  $sth11->bindParam(5, $cp11, PDO::PARAM_INT);
  $sth11->bindParam(6, $age11);
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
  $sthUpdt = $dbco->prepare("UPDATE Clients
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
  $sqlAddCol = "ALTER TABLE Clients
		ADD AgeCol INT(3) UNSIGNED
	";

  $dbco->exec($sqlAddCol);
  echo 'Colonne ajoutée<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

// Supprimer une colonne (DROP COLUMN)
try {
  $sqlDelCol = "ALTER TABLE Clients
		DROP COLUMN AgeCol
	";

  $dbco->exec($sqlDelCol);
  echo 'Colonne supprimée<br>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}

// Modifier une colonne (MODIFY COLUMN)

try {
  $sqlModCol = "ALTER TABLE Clients
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
<?php //


/*______________________________
Id	Nom			Prenom		Adresse						Ville			CP			Age		Mail												DateInscription

1		Giraud	Pierre		Quai d'Europe			Toulon		83000		29		pierre.giraud@edhec.com			2024-11-15 17:49:49
2		Durand 	Victor 		Rue des Acacias 	Brest 		29200 	34 		victor.durand@edhec.com 		2024-11-15 17:49:49
3 	Julia 	Joly 			Rue du Hameau 		Lyon 			69001 	21 		july@gmail.com 							2024-11-15 17:49:49
4 	Doe 		John 			Rue des Lys 			Nantes 		44000 	29 		j.doe@gmail.com 						2024-11-15 17:49:49
5 	Dupont 	Jean 			Bvd Original 			Bordeaux 	33000 	45 		jd@gmail.com 								2024-11-15 17:49:49
6 	Dechand Flo 			Rue des Moulins 	Marseille 13001 	29 		flodc@gmail.com 						2024-11-15 17:49:49
9 	Palaz 	Mathilde 	Rue des Cerisiers Rouen 		76000 	38 		mathplz@gmail.com 					2024-11-15 17:49:49
10 	Bombeur Jean 			Rue des Bouchers 	Toulouse 	31001 	19 		jbb@gmail.com 							2024-11-15 17:49:49
11 	Gérard 	Philippe 	Impasse sans Nom 	Nantes 		44000 	45 		philou@gmail.com 						2024-11-15 17:49:49
______________________________*/

//
////////// SELECTION SIMPLE (SELECT)

try {
  echo 'Affiche les colonnes prenom et mail';
  $sthSel = $dbco->prepare('SELECT prenom, mail FROM Clients');
  //SELECT * FROM Clients pour récupérer toutes les données
  $sthSel->execute(); // classe PDOStatement
  $resultatSel = $sthSel->fetchAll(PDO::FETCH_ASSOC);
  //Retourne un tableau associatif avec le nom des colonnes en clefs
  echo '<pre>';
  print_r($resultatSel);
  echo '</pre>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}
echo '<hr>';

//// Que les valeurs uniques, sans les doublons (DISTINCT)

try {
  echo 'Prénoms sans les doublons';
  $sthUni = $dbco->prepare('SELECT DISTINCT prenom FROM Clients');
  $sthUni->execute();

  $resultatUni = $sthUni->fetchAll(PDO::FETCH_ASSOC);

  echo '<pre>';
  print_r($resultatUni); // 2 Jean dans la table, un seul affiché
  echo '</pre>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}
echo '<hr>';

//// Trier selon un ordre (ORDER BY)

try {
  echo 'Tri croissant par prénoms puis décroissant par noms';
  $sthTri = $dbco->prepare('SELECT prenom, nom
		FROM Clients
		ORDER BY prenom ASC, nom DESC
	');
  $sthTri->execute();

  $resultatTri = $sthTri->fetchAll(PDO::FETCH_ASSOC);

  echo '<pre>';
  print_r($resultatTri);
  echo '</pre>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage() . '<br>';
}
echo '<hr>';

//
////////// CRITÈRES DE SÉLECTION

//// WHERE

try {
  echo 'Sélectionne tous les clients dont le nom = Jean';
  $sthJean = $dbco->prepare("SELECT prenom, nom, mail
		FROM clients
		WHERE prenom = 'Jean'
	");
  $sthJean->execute();

  $resultatJean = $sthJean->fetchAll(PDO::FETCH_ASSOC);

  echo '<pre>';
  print_r($resultatJean);
  echo '</pre>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
}
echo '<hr>';

//// Opérateurs AND OR NOT

try {
  echo "Sélectionne tous les users dont l'id est spérieur à 4
   ET dont soit le prénom n'est pas Jean OU soit le nom est Bombeur";
  $sthOp = $dbco->prepare("SELECT prenom, nom, mail
		FROM clients
		WHERE id > 4 AND NOT prenom = 'Jean' OR nom = 'Bombeur'
	"); //id AND (NOT prenom OR nom)
  $sthOp->execute();

  $resultatOp = $sthOp->fetchAll(PDO::FETCH_ASSOC);

  echo '<pre>';
  print_r($resultatOp);
  echo '</pre>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
}
echo '<hr>';

//// LIMIT et OFFSET

try {
  echo 'Sélectionne 2 résultats à partir de la 4è entrée de la table';
  $sthLim = $dbco->prepare("SELECT prenom, nom, mail
		FROM clients
		LIMIT 2 OFFSET 3
	"); //1ere entrée = OFFSET 0
  $sthLim->execute();

  $resultatLim = $sthLim->fetchAll(PDO::FETCH_ASSOC);

  echo '<pre>';
  print_r($resultatLim);
  echo '</pre>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
}
echo '<hr>';

//// LIKE et wildcards

/*______________________________
% de 0 à plusieurs caractères
_ 1 caractère exactement

p%		Cherche les valeurs qui commencent par un «p»
%e		Cherche les valeurs qui se terminent par «e»
%e%		Cherche les valeurs qui possèdent un «e»
p%e		Cherche les valeurs qui commencent par «p» et se terminent par «e»
p__e	4 caractères exactement qui commencent par «p» et se terminent par «e»
p_%		Cherche des valeurs de 2 caractères ou plus qui commencent par «p»
______________________________*/

try {
  echo 'Cherche tous les prénoms de 4 lettres commençant par "Jo"';
  $sthLike = $dbco->prepare("SELECT prenom, nom, mail
		FROM clients
		WHERE prenom LIKE 'Jo__'
	");
  $sthLike->execute();

  $resultatLike = $sthLike->fetchAll(PDO::FETCH_ASSOC);

  echo '<pre>';
  print_r($resultatLike);
  echo '</pre>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
}
echo '<hr>';

//// IN et BETWEEN

try {
  echo 'Cherche tous les utilisateurs dont le prénom est Jean ou John';
  $sthIn = $dbco->prepare("SELECT prenom, nom, mail
		FROM clients
		WHERE prenom IN ('Jean', 'John')
	");
  $sthIn->execute();
  $resultatIn = $sthIn->fetchAll(PDO::FETCH_ASSOC);
  echo '<pre>';
  print_r($resultatIn);
  echo '</pre>';

  echo 'Cherche les noms entre G et Julia (inclus)';
  $sthBet = $dbco->prepare("SELECT prenom, nom
		FROM clients
		WHERE nom BETWEEN 'G' AND 'Julia'
		ORDER BY nom ASC
	");
  $sthBet->execute();
  $resultatBet = $sthBet->fetchAll(PDO::FETCH_ASSOC);
  echo '<pre>';
  print_r($resultatBet);
  echo '</pre>';
} catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
}
echo '<hr>';
?>
<!-- ------------------------------------ -->
<h2>FONCTIONS D'AGRÉGATIONS ET SCALAIRES</h2>
<!-- ------------------------------------ -->
<?php
//

//
////////// FONCTIONS D'AGRÉGATIONS min, max, count, avg, sum

//// min et max

//Sélectionne la valeur la plus petite dans la colonne age
$sthMin = $dbco->prepare('SELECT MIN(Age), MAX(Age) FROM clients');
$sthMin->execute();
$resultatMin = $sthMin->fetch(PDO::FETCH_ASSOC); //ne renvoie qu'une valeur
echo '<pre>';
print_r($resultatMin); //[MIN(Age)] => 19 [MAX(Age)] => 45
echo '</pre>';
echo '<br>';

//// count (nb de valeurs dans une colonne)

//Retourne le nb d'utiilsateurs qui ont plus de 30 ans
$sthCount = $dbco->prepare("SELECT COUNT(age)
FROM clients
WHERE age > 30
");
$sthCount->execute();
$resultatCount = $sthCount->fetch(PDO::FETCH_ASSOC);
print_r($resultatCount); //[COUNT(age)] => 5
echo '<br>' . $resultatCount['COUNT(age)'] . '<br>';

//// avg (valeur moyenne d'une colonne)

$sthAvg = $dbco->prepare('SELECT AVG(age) FROM clients');
$sthAvg->execute();
$resultatAvg = $sthAvg->fetch(PDO::FETCH_ASSOC);
print_r($resultatAvg); //[AVG(age)] => 31.5556
echo '<br>';

//// sum (somme des valeurs d'une colonne)
$sthSum = $dbco->prepare('SELECT SUM(age) FROM clients');
$sthSum->execute();
$resultatSum = $sthSum->fetch(PDO::FETCH_ASSOC);
print_r($resultatSum); //[SUM(age)] => 284
echo '<br>';

//
////////// FONCTIONS SCALAIRES lcase ucase length round now

//// lcase (minuscule) et ucase (majuscule)

//Retourne les prénoms en majuscules
$sthUc = $dbco->prepare("SELECT UCASE(nom) FROM clients WHERE prenom='Jean'");
$sthUc->execute();
$resultatUc = $sthUc->fetchAll(PDO::FETCH_ASSOC);
print_r($resultatUc); //DUPONT, BOMBEUR
echo '<br>';

//// length en bytes (octets)

$sthLen = $dbco->prepare("SELECT prenom, LENGTH(prenom)
	FROM clients
	WHERE id = 1
");
$sthLen->execute();
$resultatLen = $sthLen->fetch(PDO::FETCH_ASSOC);
print_r($resultatLen); //Pierre, 6
echo '<br>';

//// round (arrondir)

//On arrondie 2.55 à 1 décimale
$sthRou = $dbco->prepare('SELECT ROUND(2.55, 1)');
$sthRou->execute();
$resultatRou = $sthRou->fetch(PDO::FETCH_ASSOC);
print_r($resultatRou);
echo '<br>';

//// now (date courante)

/*Retourne les prénoms avec la date d'extraction*/
$sthNow = $dbco->prepare('SELECT prenom, NOW() 
	FROM clients WHERE prenom = "Jean"');
$sthNow->execute();
$resultatNow = $sthNow->fetchAll(PDO::FETCH_ASSOC);
print_r($resultatNow); //[prenom] => Jean [NOW()] => 2024-11-18 15:14:20
echo '<br><hr>';

//
////////// FONCTIONS D'AGRÉGATIONS ET CRITÈRES DE SÉLECTIONS

//// GROUP BY (groupe les résultats dans une colonne)

echo "Affiche le nombre d'occurence pour chaque age";
$sthGrp = $dbco->prepare("SELECT COUNT(id), age 
	FROM clients
	GROUP BY age 
	ORDER BY COUNT(id) DESC
	LIMIT 3 OFFSET 0
");
$sthGrp->execute();
$resultatGrp = $sthGrp->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>';
print_r($resultatGrp);
echo '</pre>';

/* La colonne des 29 a 3 entrées
COUNT(id)	age
3					29
2					45
...*/
echo '<br><hr>';

//// HAVING (WHERE pour les fonctions d'agrégations)

echo 'Affiche les prénoms qui reviennent plusieurs fois';
$sthHav = $dbco->prepare("SELECT COUNT(id), prenom 
	FROM clients
	GROUP BY prenom
	HAVING COUNT(id) > 1
	ORDER BY prenom
");
$sthHav->execute();
$resultatHav = $sthHav->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>';
print_r($resultatHav); //2 Jean
echo '</pre>';
echo '<br>';
?>

<!-- ---------------------------------- -->
<h2>JOINTURES, UNIONS ET SOUS REQUETES</h2>
<!-- ---------------------------------- -->
<?php
//
?>
    </body>
</html>
