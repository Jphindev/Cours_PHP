<!DOCTYPE html>
<html>
	<head>
		<title>Cours PHP & MySQL</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h1>Cours PHP</h1>
		<a href=#signet>Jump</a>
<?php
/*
PHP: PHP Hypertext Preprocessor
SQL: Structured Query Language
Le MySQL est un système de gestion de bases de données relationnelles.
*/
?>
<!-- --------- -->
<h2>VARIABLES</h2>
<!-- --------- -->
<?php
// Le nom des variables est sensible à la casse $prenom # $PRENOM

echo "Bonjour, je m'appelle Simon aka \"Sim\" <br>"; //affiche une chaîne de caractère qui peut interpréter les variables
echo 'Bonjour, je m\'appelle Simon aka "Sim" <br>'; //simple chaîne de caractères qui ne peut pas interpréter les variables
echo 'Bonjour <br>';
echo 29;
echo '<br> Il y en a ', 29, ' en tout<br>';
$prenom = 'Simon';
$age = 29;
echo "La variable \$prenom contient: ";
echo $prenom . '<br>';

//
////////// CONCATÉNATION

// avec guillemets pour interpréter
echo "$prenom est mon prénom et j'ai $age ans <br>"; //Simon est mon prénom et j'ai 29 ans
echo "{$prenom} est mon prénom et j'ai {$age} ans <br>"; //préférable
echo $prenom . " est mon prénom et j'ai " . $age . ' ans <br>'; //la meilleure

// avec apostrophes et points sinon considéré comme une chaîne de caractères
echo $prenom . ' est mon prénom et j\'ai ' . $age . ' ans <br>';

//
////////// OPÉRATEURS

/*______________________________
+	Addition
–	Soustraction
*	Multiplication
/	Division
%	Modulo (reste d’une division euclidienne)
**	Exponentielle = Puissance (le seul qui est calculé par la droite)
______________________________*/

$x = 2;
$y = $x + 1; //y vaut 3
$x += 2; //x vaut 4 - Opérateurs combinés correspond à $x = $x + 2
$bonjour = 'Bonjour ';
$bonjour .= $prenom; //Bonjour Simon
$x += $y -= 1;

//calculé par la droite: y=y-1 (2), puis x=x+y (6)

/////////////////////////////////////////////////////////////
?>
<!-- -------------- -->
<h2>LES CONDITIONS</h2>
<!-- -------------- -->
<?php
//
////////// OPÉRATEURS DE COMPARAISON

/*______________________________
==	Permet de tester l’égalité sur les valeurs
===	Permet de tester l’égalité en termes de valeurs et de types
!=	Permet de tester la différence en valeurs
<>	Permet également de tester la différence en valeurs
!==	Permet de tester la différence en valeurs ou en types
<	Permet de tester si une valeur est strictement inférieure à une autre
>	Permet de tester si une valeur est strictement supérieure à une autre
<=	Permet de tester si une valeur est inférieure ou égale à une autre
>=	Permet de tester si une valeur est supérieure ou égale à une autre
______________________________*/

$x = 4;
var_dump($x > 3); //bool(true) -> sert à afficher les informations d'une variable

//
////////// IF

if ($x > 1) {
  // if (test=true){code à exécuter}
  echo '$x contient une valeur supérieure à 1 <br>';
} else {
  echo '$x contient une valeur inférieure ou égale à 1 <br>';
}

// Priorité des opérateurs: [<, <=, >, >=] > [==, ===, !=, !==, <>] > [??]
var_dump(2 > 4 == false); //d'abord comparaison de 2>4 (false) puis false==false (true)

//
////////// Opérateurs logiques

/*______________________________
AND, &&	Renvoie true si toutes les comparaisons valent true
OR, ||	Renvoie true si une des comparaisons vaut true
XOR		Renvoie true si une des comparaisons exactement vaut true (soit l'une soit l'autre mais pas les deux)
!		Renvoie true si la comparaison vaut false (et inversement). false => 0, NULL ou tableau vide
______________________________*/

if (!($x >= 0 and $y >= 0)) {
  echo 'Soit $x contient une valeur stric. négative, soit $y contient une valeur stric. négative, soit les deux variables contiennent une valeur stric. négative';
}

//
////////// TERNAIRE ? ET FUSION NULL ??

echo $x >= 0 ? '$x stocke un nb positif <br>' : '$x stocke un nb négatif <br>'; //if ? then : else
$resultatx = $x ?? 'NULL'; //test ?? code à renvoyer si le résultat du test est NULL

//
////////// SWITCH

switch ($x) {
  case 0:
    echo '$x stocke la valeur 0';
    break;
  case 1:
    echo '$x stocke la valeur 1';
    break;
  case 2:
    echo '$x stocke la valeur 2';
    break;
  default:
    echo '$x ne stocke pas de valeur entre 0 et 4';
}

/////////////////////////////////////////////////////////////
?>
<!-- ----------- -->
<h2>LES BOUCLES</h2>
<!-- ----------- -->
<?php
//
// $x++ post incrémentation
// ++$x pré incrémentation

//
////////// WHILE

$x = 0;
while ($x <= 4) {
  echo '$x contient la valeur ' . $x . '<br>';
  $x++;
}

//
////////// DO ... WHILE

$x = 6;
do {
  //au moins un passage garanti
  echo '$x contient la valeur ' . $x . '<br>';
  $x++;
} while ($x <= 5);

//
////////// FOR

for ($x = 0; $x <= 5; $x++) {
  echo '$x contient la valeur ' . $x . '<br>';
}

//
////////// FOREACH

$resultat = '';
$tableau = ['Un', 'Deux', 'Trois'];
foreach ($tableau as $valeurs) {
  $resultat .= $valeurs . ', ';
}
echo $resultat;

/////////////////////////////////////////////////////////////
?>
<!-- ------------------ -->
<h2>INCLUDE ET REQUIRE</h2>
<!-- ------------------ -->
 <?php
/*______________________________
include 'menu.php'; //importe le code d'un autre fichier
include_once 'menu.php'; //possible de le faire une seule fois
require 'menu.php'; //plus stricte, stop le script en cas de problème
require_once 'menu.php';
______________________________*/

/////////////////////////////////////////////////////////////
?>
<!-- ------------- -->
<h2>LES FONCTIONS</h2>
<!-- ------------- -->
 <?php
 //Le nom des fonctions n'est pas sensible à la casse addition() = ADDITION()

 //// Création d'une fonction
 function nom_de_la_fonction($parametre1, $parametre2)
 {
   echo '<br>Paramètre 1 = ' . $parametre1 . '<br>';
   echo 'Paramètre 2 = ' . $parametre2 . '<br>';
 }

 //// Appel d'une fonction
 $argument1 = 'oui';
 $argument2 = 'non';
 $variable = 47.5;
 nom_de_la_fonction($argument1, $argument2);
 gettype($variable); // fonction interne déjà définie par PHP

 //// Exemple
 function addition($p1, $p2)
 {
   echo $p1 . ' + ' . $p2 . ' = ' . ($p1 + $p2) . '<br>';
 }
 addition(1, 1);
 addition($x, $y);

 //
 ////////// ARGUMENT PAR RÉFÉRENCE &

 // Pour autoriser la fonction à modifier la valeur de l'argument de départ

 $x = 0;
 function plus2($p)
 {
   $p = $p + 2;
   echo 'Valeur dans la fonction : ' . $p; //2
 }
 plus2($x);
 echo '<br>Valeur en dehors de la fonction : ' . $x; //0

 function plus3(&$p)
 {
   //on ajoute & devant le paramètre
   $p = $p + 3;
   echo '<br>Valeur dans la fonction : ' . $p; //3
 }
 plus3($x);
 echo '<br>Valeur en dehors de la fonction : ' . $x; //3, on a autorisé la modification de $x par la fonction

 //
 ////////// VALEURS PAR DÉFAUT $p=

 function bonjourdefaut($prenom, $role = 'abonné(e)')
 {
   echo '<br>Bonjour ' . $prenom . ' vous êtes un(e) ' . $role . '.<br>';
 }
 bonjourdefaut('Mathilde'); //Bonjour Mathilde vous êtes un(e) abonné(e).
 bonjourdefaut('Pierre', 'administrateur'); //Bonjour Pierre vous êtes un(e) administrateur.

 //
 ////////// NOMBRE VARIABLE D'ARGUMENTS ...

 function bonjournbvar(...$prenoms)
 {
   //va créer un tableau avec les différents arguments
   foreach ($prenoms as $p) {
     echo 'Bonjour ' . $p . '<br>';
   }
 }
 bonjournbvar('Mathilde', 'Pierre', 'Victor');

 //
 ////////// LE TYPAGE DES ARGUMENTS

 function sans_typage($a, $b)
 {
   echo $a . ' + ' . $b . ' = ' . ($a + $b) . '<br>';
 }
 function avec_typage(float $a, float $b)
 {
   echo $a . ' + ' . $b . ' = ' . ($a + $b) . '<br>';
 }
 sans_typage(3, 4); //3 + 4 = 7
 sans_typage(3, '4Pierre'); //3 + 4Pierre = 7 - '4Pierre' est converti en 4 par PHP
 // sans_typage(3, 'Pierre'); 	//3 + Pierre = 3 - 'Pierre' est converti en 0 par PHP
 avec_typage(3, 4); //3 + 4 = 7
 avec_typage(3, 4.5); //3 + 4.5 = 7.5
 avec_typage(3.5, 4.2); //3.5 + 4.2 = 7.7
 // avec_typage(3, '4Pierre');	//3 + 4 = 7 - '4Pierre' est converti en 4 par PHP
 // avec_typage(3, 'Pierre');	//Renvoie une erreur qui termine l'exécution

 //
 ////////// LE TYPAGE STRICT

 // Il faut ajouter: declare(strict_types= 1); en début de fichier
 // n'est possible que pour les types string, int, float et bool

 //
 ////////// RETURN

 function multreturn(float $a, float $b)
 {
   return $a * $b;
 }
 $res = multreturn(4, 5);
 echo $res += 2; //22

 function multreturn_avec_typage($a, $b): int
 {
   return $a * $b;
 }
 echo multreturn_avec_typage(2, 4.1); //8 – transformation de PHP pour correspondre au type attendu

 function multreturn_typage_strict($a, $b): int
 {
   return $a * $b;
 }
 echo multreturn_typage_strict(2, 4.1); //erreur
 echo '<br><br>';

 //
 ////////// PORTÉE DES VARIABLES

 // Une variable globale n'est pas accessible en local
 // Une variable locale n'est pas accessible en global

 //// Utilisation d'une variable globale en local
 $x = 10;
 function portee()
 {
   global $x; //on ajoute l'instruction >global pour pouvoir utiliser la variable globale
   echo 'La valeur de $x globale est : ' . $x . '<br>'; //10
   $x = $x + 5; //On ajoute 5 à la valeur de $x
 }
 portee();
 echo '$x contient maintenant : ' . $x . '<br>'; //15 – on a changé la valeur globale de la variable

 //// Utilisation d'une variable locale en global -> en utilisant >return

 //// Conserver la valeur d'une variable locale -> >static
 function compteur()
 {
   static $x = 0;
   echo '$x contient la valeur : ' . $x . '<br>';
   $x++;
 }
 compteur(); //0
 compteur(); //1

 //
 ////////// LES CONSTANTES

 // On écrit les constantes en MAJUSCULES sans $
 define('DIX', 10); //on met la valeur 10 dans la constante DIX
 const MIN_VALUE = 1; //écriture valable pour string, int, float, bool, array

 //// Constantes prédéfinies et magiques
 echo 'FILE: ' . __FILE__ . '<br>'; //Contient le chemin complet et le nom du fichier
 echo 'DIR: ' . __DIR__ . '<br>'; //Contient le nom du dossier dans lequel est le fichier
 echo 'LINE: ' . __LINE__ . '<br>'; //Contient le numéro de la ligne courante dans le fichier
 echo 'FUNCTION: ' . __FUNCTION__ . '<br>';

//Contient le nom de la fonction actuellement définie ou {closure} pour les fonctions anonymes

/////////////////////////////////////////////////////////////
?>
<!--------------- -->
<h2>LES TABLEAUX</h2>
<!-- ------------ -->
<?php
//
////////// TABLEAUX NUMÉROTÉS OU INDEXÉS

// clef => valeur, les clefs sont attribuées automatiquement à partir de 0 quand elles ne sont pas spécifiées

$prenoms = ['Mathilde', 'Pierre', 'Amandine', 'Florian']; //avec array
$ages = [27, 29, 21, 29]; //avec []
$prenoms[4] = 'John'; //ajout d'une valeur en précisant la clef
echo $prenoms[2] . '<br>'; //Amandine
$taille = count($prenoms);
echo $taille . '<br>'; //5 donne la taille du tableau

//// Affichage d'un tableau complet
$p = '';
for ($i = 0; $i < $taille; $i++) {
  $p .= $prenoms[$i] . ', ';
}
echo $p . '<br>';

$res = '';
foreach ($prenoms as $valeurs) {
  $res .= $valeurs . ', ';
}
echo $res . '<br>';

//
////////// TABLEAUX ASSOCIATIFS = CLEFS TEXTUELLES

$ages = ['Mathilde' => 27, 'Pierre' => 29];
$ages['Amandine'] = 21;
echo 'Pierre a ' . $ages['Pierre'] . ' ans.<br>'; //Pierre a 29 ans.

foreach ($ages as $clef_prenom => $valeur_age) {
  echo $clef_prenom . ' a ' . $valeur_age . ' ans.<br>';
}

//
////////// TABLEAUX MULTIDIMENSIONNELS = TABLEAU DANS UN TABLEAU

//// Un tableau numéroté stockant des tableaux numérotés
$suite = [[1, 2, 4, 8, 16], [1, 3, 9, 27, 81]];
echo $suite[0][2] . '<br>'; //4

//// Un tableau numéroté stockant des tableaux associatifs
$utilisateurs = [
  ['nom' => 'Mathilde', 'mail' => 'math@gmail.com'],
  ['nom' => 'Pierre', 'mail' => 'pierre.giraud@edhec.com'],
  ['nom' => 'Amandine', 'mail' => 'amandine@lp.fr'],
  'Florian',
];
$sous_util = $utilisateurs[2]; //['nom' => 'Amandine', 'mail' => 'amandine@lp.fr']
echo $sous_util['nom'] . '<br>'; //Amandine
echo $utilisateurs[2]['nom'] . '<br>'; //Amandine
echo $utilisateurs[3] . '<br>'; //Florian

//// Un tableau associatif stockant des tableaux associatifs
$produits = [
  'Livre' => ['poids' => 200, 'quantite' => 10, 'prix' => 15],
  'Stickers' => ['poids' => 10, 'quantite' => 100, 'prix' => 1.5],
];
echo $produits['Livre']['prix'] . '<br>'; //15

foreach ($produits as $clef => $produit) {
  echo 'Caractéristiques de ' . $clef . ' :<br>';
  foreach ($produit as $caracteristique => $valeur) {
    echo $caracteristique . ' : ' . $valeur . '<br>';
  }
  echo '<br>';
}
/*______________________________
Caractéristiques de Livre :
poids : 200
quantité : 10
prix: 15

Caractéristiques de Stickers :
...
______________________________*/

//
////////// AFFICHAGE RAPIDE D'UN TABLEAU

echo '<pre>'; //pour conserver la mise en forme du code
print_r($produits); //pour un affichage simple
var_dump($produits); //donne plus d'informations
echo '</pre>';

/////////////////////////////////////////////////////////////
?>
<!-- ------------------- -->
<h2>MANIPULER DES DATES</h2>
<!-- ------------------- -->
<?php
//
////////// TIMESTAMP UNIX

//// time() -> Nombre de secondes écoulés depuis le 1er janvier 1970
echo 'Timestamp actuel : ' . time() . '<br>'; //1548406800

//// mktime() -> Timestamp du GMT d'une date donnée en prenant compte les fuseaux horaires
echo 'Timestamp 25 janvier 2019 08h30 (GMT+1) : ' .
  mktime(8, 30, 0, 1, 25, 2019) .
  '<br>'; //donne le timestamp de 7h30

//// gmmktime() -> Timestamp exact d'une date donnée en donnant le GMT
echo 'Timestamp 25 janvier 2019 08h30 (GMT) : ' .
  gmmktime(8, 30, 0, 1, 25, 2019) .
  '<br>'; //donne le timestamp de 8h30

//// strtotime() -> Timestamp du GMT à partir d'une chaîne de caractère
$stt1 = strtotime('2019/01/25 08:30:00'); //plusieurs formats possible
$stt2 = strtotime('2019/01/25'); //à minuit quand ce n'est pas précisé
$stt3 = strtotime('next friday');
$stt4 = strtotime('2 days ago'); //il y a 48h
$stt5 = strtotime('+1 day'); //dans 24h

//// getdate() -> Obtenir une date à partir d'un Timestamp
echo '<pre>';
print_r(getdate()); //donne le tableau du timestamp actuel
echo '</pre><br>';

echo '<pre>';
print_r(getdate($stt2)); //donne le tableau du timestamp donné
echo '</pre>';

//
////////// OBTENIR ET FORMATER UNE DATE

//// date() locale
echo date('d/m/Y') . '<br>'; //26/01/2019
echo date('l d m Y h:i:s') . '<br>'; //Saturday 26 01 2019 10:14:43
echo date('c') . '<br>'; //2019-01-26T10:14:43+01:00
echo date('r') . '<br>'; //Sat. 26 Jan 2019 10:14:43 +0100

//// gmdate() date GMT et changement de fuseau horaire
echo date('d m Y h:i:s') . '<br>'; //26 01 2019 10:19:41
echo gmdate('d-m-Y h:i:s') . '<br>'; //26-01-2019 09:19:41
date_default_timezone_set('Europe/Moscow'); //On choisit le fuseau horaire de Moscou = GMT+3
echo date('d m Y h:i:s') . '<br>'; //26 01 2019 12:19:41
echo gmdate('d-m-Y h:i:s') . '<br>'; //26-01-2019 09:19:41

//// Transformer une date en français: setlocale() et strftime() /!\ deprecated
echo strftime('%A %d %B %Y %I:%M:%S') . '<br>'; //Saturday 26 January 2019 10:22:04
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']); //on active la localisation française
echo strftime('%A %d %B %Y %I:%M:%S') . '<br>'; //Samedi 26 Janvier 2019 10:22:04
echo strftime('%c') . '<br>'; //Sam 26 jan 10:22:04 2019

//
////////// COMPARER DES DATES

// Il faut comparer les Timestamp et pas les dates
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);
$d1 = '25-01-2019'; //on défini la date
$d2 = '30-June 2018'; //un autre format
$tmstp1 = strtotime($d1); //on récupère le timestamp
$tmstp2 = strtotime($d2);
$dfr1 = strftime('%A %d %B %Y', $tmstp1); //on localise en français
$dfr2 = strftime('%A %d %B %Y', $tmstp2);

if ($tmstp1 < $tmstp2) {
  echo 'Le ' . $dfr1 . ' est avant le ' . $dfr2;
} elseif ($tmstp1 == $tmstp2) {
  echo 'Les deux dates sont les mêmes';
} else {
  echo 'Le ' . $dfr2 . ' est avant le ' . $dfr1;
}
//Le Samedi 30 juin 2018 est avant le Vendredi 25 janvier 2019

//// checkdate() pour tester la validité d'une date
checkdate(1, 25, 2019); //true – le 25 jan 2019 est une date valide
checkdate(2, 29, 2015); //false – 2015 n'est pas une année bissextile

//// strptime() pour tester une date locale /!\ deprecated
setlocale(LC_TIME, ['fr', 'fra', 'fr_FR']);

$format1 = '%A %d %B %Y %H:%M:%S';
$format2 = '%H:%M:%S';

$date1 = strftime($format1);
$date2 = strftime($format1);
$date3 = strftime($format2);

echo $date1 . '<br>' . $date2 . '<br>' . $date3 . '<br>';

if (strptime($date1, $format1)) {
  echo '<pre>';
  print_r(strptime($date1, $format1)); //affichage d'un tableau car les formats sont les mêmes
  echo '</pre><br>';
}
if (strptime($date2, '%A %d %B %Y')) {
  echo '<pre>';
  print_r(strptime($date2, '%A %d %B %Y')); //tableau incomplet, les données non reconnues vont dans [unparsed]
  echo '</pre><br>';
}
if (strptime($date3, '%A %d %B %Y')) {
  echo '<pre>';
  print_r(strptime($date3, '%A %d %B %Y')); //false, les formats sont différents
  echo '</pre>';
}

/////////////////////////////////////////////////////////////
?>
<!-- ----------------------- -->
<h2>VARIABLES SUPERGLOBALES</h2>
<!-- ----------------------- -->
<?php
//
////////// $GLOBALS

//C'est un tableau nom => valeur de toutes les variables globales définies
$prenom = 'Pierre';
$nom = 'Giraud';
$age = 28;
function prez2()
{
  $mail = 'pierre.giraud@edhec.com';
  echo 'Je suis ' .
    $GLOBALS[prenom] .
    ' ' .
    $GLOBALS[nom] .
    ', j\'ai ' .
    $GLOBALS[age] .
    ' ans.<br>Mon adresse mail est : ' .
    $mail;
}

//// Rappel avec le mot clef global
//global $prenom, $nom, $age;
//echo 'Je suis ' .$prenom. ' ' .$nom. ', j\'ai ' .$age. ' ans.<br>Mon adresse mail est : ' .$mail;

//
////////// $_SERVER

//Tableau contenant les variables définis par le serveur

//Renvoie le nom du fichier contenant le script
echo $_SERVER['PHP_SELF'] . '<br>';
//Renvoie le nom du serveur qui héberge le fichier
echo $_SERVER['SERVER_NAME'] . '<br>';
//Renvoie l'adresse IP du serveur qui héberge le fichier
echo $_SERVER['SERVER_ADDR'] . '<br>';
//Retourne l'IP du visiteur demandant la page
echo $_SERVER['REMOTE_ADDR'] . '<br>';
//Renvoie une valeur non vide si le script a été appelé via le protocole HTTPS
echo $_SERVER['HTTPS'] . '<br>';
//Retourne le temps Unix du début de la requête
echo $_SERVER['REQUEST_TIME'] . '<br>';

//
////////// $_REQUEST

//tableau associatif qui va contenir les variables de $_GET, $_POST et $_COOKIE

//
////////// $_ENV

//Tableau contenant les variables d'environnement
echo $_ENV['USER']; //nom de l'utilisateur qui exécute le script

//
////////// $_FILES

//contient les informations d'un fichier, son type, sa taile, son nom, etc.

//
////////// $_GET et $_POST

//Pour manipuler les informations envoyées via un formulaire HTML

//
////////// $_COOKIE

/*______________________________
//Un cookie est un fichier texte qui peut contenir une quantité limitée de données.
//setcookie(name, value, expire, path, domain, secure, httponly) pour créer un cookie
// /!\ à écrire en début de fichier avant la balise html
setcookie('user_id', '1234');
setcookie('user_pref', 'dark_theme', time()+3600*24, '/', '', true, true);
setcookie('user_id', '5678'); //modification d'un cookie
setcookie('user_pref', '', time()-3600, '/', '', false, false); //suppression d'un cookie
______________________________*/

if (isset($_COOKIE['user_id'])) {
  //on vérifie si le cookie existe
  echo 'Votre ID de session est le ' . $_COOKIE['user_id'];
}

//
////////// $_SESSION

//Une session démarre dès que la fonction session_start() est appelée et se termine en général dès que la fenêtre courante du navigateur est fermée
session_start(); // /!\ à écrire en début de fichier avant setcookie
$_SESSION['prenom'] = 'Pierre'; //on définit des variables de session
$_SESSION['age'] = 29;
$id_session = session_id(); //on récupère d'id de session s'il existe
$id_sess_cookie = $_COOKIE['PHPSESSID']; //on peut aussi récupérer l'id de session avec $_COOKIE

//Il est possible d'accéder aux variables de session dans une autre page php si celle-ci débute par session_start();

unset($_SESSION['age']); //pour détruire une variable de session particulière
session_unset(); //pour détruire toutes les variables de la session courante
session_destroy(); //pour supprimer le fichier de session mais pas $_SESSION
echo '<br>';

/////////////////////////////////////////////////////////////
?>
<!-- ------------------------- -->
<h2>MANIPULATION DES FICHIERS</h2>
<!-- ------------------------- -->
<?php
//
////////// LECTURE DE FICHIER TXT

echo file_get_contents('test.txt') . '<br>'; //affiche le contenu du fichier
echo nl2br(file_get_contents('test.txt')) . '<br>'; //pour conserver les retours à la ligne

echo '<pre>';
print_r(file('test.txt')); //sous forme de tableau
echo '</pre>';

readfile('test.txt'); //pas besoin de echo

//
////////// OUVIRI, LIRE ET FERMER UN FICHIER

/*__ modes d'ouvertures ________
r	read only						r+	read + write				pointeur au début
a	write & keep				a+ write + read & keep			pointeur à la fin
w	write & replace		w+ write + read & replace			pointeur au début
x	create new & write		x+ create new & write + read		pointeur au début
c	write or create & keep	c+ write + read or create & keep	pointeur au début
b binary pour une meilleure compatibilité
______________________________*/

//// fopen() pour ouvrir un fichier
$ressource = fopen('test.txt', 'rb'); //r=read only – b=meilleure compatibilité

//// fread() pour lire un fichier ouvert depuis la position courante du curseur
echo fread($ressource, filesize('test.txt')); //on lit le fichier en entier et place le curseur à la fin

//// fgets() pour lire ligne par ligne
echo 'Ligne 1 : ' . fgets($ressource) . '<br>'; //pour lire un fichier ligne par ligne
echo 'Ligne 2(30) : ' . fgets($ressource, 30) . '<br>'; //pour lire 30 octets de la 2e ligne
echo 'Ligne 2 suite: ' . fgets($ressource, 30) . '<br>'; //pour lire la suite la 2e ligne

//// fgetc() pour lire caractère par caractère
echo 'Caractère 1 : ' . fgetc($ressource) . '<br>'; //affiche le 1er caractère du fichier
echo 'Caractère 2 : ' . fgetc($ressource) . '<br>'; //affiche le 2e caractère du fichier

//// feof() pour savoir si on est à la fin d'un fichier end of file)
//// ftell() pour connaitre la place du pointeur
while (!feof($ressource)) {
  //tant que end of file n'est pas atteint (false)
  echo 'Le pointeur est au niveau du caractère ' . ftell($ressource) . '<br>';
  $ligne = fgets($ressource); //on enregistre une ligne
  echo 'La ligne "' .
    $ligne .
    '" contient ' .
    strlen($ligne) .
    ' caractères <br>';
} //et on affiche le nombre de caractères de cette ligne grâce à strlen (string length)

//// fseek() pour déplacer le curseur
fseek($ressource, 20); //pour placer le pointeur derrière le 20e caractère
fseek($ressource, 40, SEEK_CUR); //avancer de 40 à partir de la position courante

//// fclose() pour fermer un fichier
fclose($ressource); //bonne pratique pour ne pas utiliser inutilement des ressources

//
////////// CRÉER ET ÉCRIRE DANS UN FICHIER

//// file_put_contents('chemin', 'contenu') pour créer ou écraser un fichier
file_put_contents('exemple.txt', 'Ecriture dans un fichier');
$texte = file_get_contents('exemple.txt'); //on sauvegarde le contenu
$texte .= "\n**NOUVEAU TEXTE**"; //on ajoute du contenu
file_put_contents('exemple.txt', $texte); //on écrase avec le contenu complet
file_put_contents('exemple.txt', "\n**AJOUT DE TEXTE**", FILE_APPEND); //meilleure méthode pour ajouter du texte

//// fwrite()
$fichier = fopen('exemple2.txt', 'c+b'); //on crée ou ouvre un fichier /!\ c+ pointeur au début
fseek($fichier, filesize('exemple2.txt')); //on place le curseur en fin de fichier sinon le début sera effacé
fwrite($fichier, 'Un premier texte dans mon fichier. '); //on insère du contenu
fwrite($fichier, 'Un autre texte. '); //un autre contenu à la suite

//
////////// TESTER L'EXISTENCE D'UN FICHIER

$f = 'exemple.txt';
if (file_exists($f)) {
  //true si le fichier ou répertoire existe
  if (is_file($f)) {
    //true si c'est un véritable fichier
    echo 'Le fichier ' . $f . ' existe et est bien un fichier.<br>';
  } else {
    echo $f . ' existe mais n\'est pas un fichier régulier';
  }
} else {
  echo $f . ' n\'existe pas';
}

//
////////// RENOMMER OU EFFACER UN FICHIER

$newf = 'fichier.txt';
$exemple2 = 'exemple2.txt';
rename($f, $newf); //exemple.txt a été renommé en fichier.txt
unlink($exemple2); //on supprime exemple2.txt

//
////////// PERMISSIONS DES FICHIERS ET CHMOD

/*______________________________
aucun droit					---	0
exécution seulement	--x	1
écriture seulement	-w-	2
écriture et exécution	-wx	3
lecture seulement	r--	4
lecture et exécution	r-x	5
lecture et écriture	rw-	6
tous les droits 	rwx	7

exemple 754 = author rwx / group r-x / user r--
______________________________*/

//// fileperms() donne les permissions
//// decoct() traduit en valeur octale (0 à 7)
echo decoct(fileperms('fichier.txt')) . '<br>'; //100644 -> permissions 644
echo var_dump(is_readable('fichier.txt')) . '<br>'; //true si permission r
echo var_dump(is_writable('fichier.txt')) . '<br>'; //true si permission w

//// chmod() pour modifier les permissions
if (chmod('fichier.txt', 0755)) {
  //chmod s'exécute et la condition est ensuite vérifiée
  echo 'Permissions du fichier bien modifiées.<br><br>';
}

/////////////////////////////////////////////////////////////
?>
<!-- -------------------------------------- -->
<h2>EXPRESSIONS REGULIERES OU RATIONNELLES</h2>
<!-- -------------------------------------- -->
<?php
//
////////// FONCTIONS PCRE PHP

/*______________________________
preg_filter()		 				Recherche et remplace
preg_grep()							Recherche et retourne un tableau avec les résultats
preg_last_error()				Retourne le code d’erreur de la dernière regex exécutée
preg_match() 						Compare une regex à une chaine de caractères (0 ou 1)
preg_match_all()				Pareil mais renvoie tous les résultats (tableau)
preg_quote()						Echappe les caractères spéciaux dans une chaine
preg_replace()					Recherche et remplace
preg_replace_callback()	Recherche et remplace en utilisant une fonction de rappel
preg_replace_callback_array()	Recherche et remplace en utilisant une fonction de rappel
preg_split()						Découpe une chaine
______________________________*/

//// preg_match et preg_match_all pour rechercher

$masque_r = '/r/';
$chaine1 = 'Je suis Pierre Giraud';

if (preg_match($masque_r, $chaine1)) {
  echo 'Le caractère "r" a été trouvé ' .
    preg_match_all($masque_r, $chaine1) .
    ' fois dans "' .
    $chaine1 .
    '"<br>';
} else {
  'Aucun "r" dans "' . $chaine1 . '"<br>';
}

$match = []; //On initialise $match et $match_all
$match_all = [];

preg_match($masque_r, $chaine1, $match); //r est enregistré dans $match
preg_match_all($masque_r, $chaine1, $match_all); //un tableau de 3 r est enregistré

echo '<pre>';
print_r($match);
echo '<br><br>';
print_r($match_all);
echo '</pre>';

$m2 = []; //On initialise $m2
$res_match = preg_match_all($masque_r, $chaine1, $m2, PREG_PATTERN_ORDER, 15);
echo 'On recherche "' .
  $match_all[0][0] .
  '" en partant 15 octets après le début de la chaine de caractères. ' .
  $res_match .
  ' résultat(s) trouvé(s).<br>';

//// preg_filter pour remplacer (renvoie null si non trouvé)

$masque_jour = '/jour/';
$masque_nuit = '/nuit/';
$chaine2 = 'Bonjour, je suis Pierre';
$res_filter = preg_filter($masque_jour, 'soir', $chaine2); //on remplace jour par soir
echo 'Initial: ' . $chaine2 . '<br>Filter: ' . $res_filter . '<br>'; //Bonsoir...

//// preg_replace pour remplacer (renvoie chaine de départ si non trouvé)

$res_replace = preg_replace($masque_jour, 'ne nuit', $chaine2);
echo 'Replace: ' . $res_replace . '<br>'; //Bonne nuit...
$res_replace2 = preg_replace($masque_nuit, 'ne nuit', $chaine2);
echo 'Non trouvé: ' . $res_replace2 . '<br>'; //Bonjour...

//// preg_grep pour rechercher dans un tableau

$masque_Pierre = '/Pierre/';
$tableau1 = ['Pierre Gr', 'Mathilde Ml', 'Pierre Dp', 'Florian Dc'];
$res_grep = preg_grep($masque_Pierre, $tableau1);
echo '<pre>';
print_r($res_grep); //[Pierre Gr, Pierre Dp]
echo '</pre>';

//// preg_split pour découper une chaine et mettre dans un tableau

$masque_j = '/j/';
$res_split = preg_split($masque_j, $chaine2);
echo '<pre>';
print_r($res_split); //[0] => Bon | [1] => our, | [2] => e suis Pierre
echo '</pre>';

//
////////// LES CLASSES DE CARACTÈRES [...]

// /.../ -> et, [...] -> ou
$masque_voyelle = '/[aeiouy]/'; //a ou e ou i ou u ou y
$masque_jvo = '/j[aeiouy]/'; //j suivi d'une voyelle
$masque_vovo = '/[aeiouy][aeiouy]/'; //une voyelle suivi d'une voyelle

preg_match_all($masque_jvo, $chaine2, $tab_jvo);
print_r($tab_jvo); //[0] => Array([0] => jo | [1] => je))
echo '<br><br>';

//
////////// MÉTACARACTÈRES DE CLASSES (DANS LES CROCHETS)

/*______________________________
	[]classe de caractères
	^ pour nier une classe si placé au début d'une classe [^...]
	- pour un intervalle [a-z][A-Z][0-9]
	\ pour protéger (échapper) -> /[...\]\-...]/ pour rechercher ] ou -
______________________________*/

$chaine_meta = '[Pierre-Alexandre] \0/ ^_^';
$masque_minmaj = '/[a-z][a\-z][A-Z]/'; //minuscule + [a ou - ou z] + majuscule
$masque_paslet = '/[^a-zA-Z]/'; //pas le lettres minuscules ou majuscules
$masque_chapeau = '/[\^]_[0-9^]/'; //chapeau + underscore + chiffre ou chapeau
// pour chercher un antislash, il faut en mettre 4: \\\\

preg_match_all($masque_minmaj, $chaine_meta, $res_minmaj);
echo 'minmaj: ' . implode(', ', $res_minmaj[0]); //e-A
//implode converti le tableau en string en séparant par des virgules

preg_match_all($masque_paslet, $chaine_meta, $res_paslet);
echo '<br>paslet: ' . implode('', $res_paslet[0]) . '<br>'; //[-] \0/ ^^

preg_match_all($masque_chapeau, $chaine_meta, $res_chapeau);
print_r($res_chapeau);
echo '<br><br>';

//
////////// CLASSES ABRÉGÉES OU PRÉDÉFINIES

/*______________________________
\w	word: un mot. Équivalent à [a-zA-Z0-9_]
\W	no Word: pas un mot. Equivalent à [^a-zA- Z0-9_]
\d	digit: un chiffre. Équivalent à [0-9]
\D	no Digit: pas un chiffre. Équivalent à [^0-9]
\s	space: un blanc (espace, retour chariot ou retour à la ligne)
\S	no Space: pas un blanc
\h	horizontal space: espace horizontal
\H	no Hz space: pas un espace horizontal
\v	vertical space: un espace vertical
\V	no Vt space: pas un espace vertical
______________________________*/

$masque_now = '/[\W]/';
$masque_d = '/[\d]/';
$masque_h = '/[\h]/';
$chaine3 = 'Salut Amandinedu93 ;-)';

preg_match_all($masque_now, $chaine3, $res_now);
preg_match_all($masque_d, $chaine3, $res_d);
$nb_espaces = preg_match_all($masque_h, $chaine3); //2

echo '<pre>';
print_r($res_now); // | |;|-|)
echo '<br>';
print_r($res_d); //9, 3
echo '</pre><br>';
echo '"' .
  $chaine3 .
  '" contient ' .
  $nb_espaces .
  ' espaces horizontaux<br><br><br>';

//
////////// MÉTACARACTÈRES REGEX PHP (EN DEHORS DES CROCHETS)

//// Le point pour chercher tout sauf un retour à la ligne (\n)
$masque_pasligne = '/./'; //tout sauf retour ligne
$masque_point = '/[.]/'; //cherche un point

//// L'alternative | (ou)
$masque_altou = '/er|re/'; //cherche "er" ou "re"

//// Les ancres début (^) et fin ($) de chaine
$masque_startp = '/^p|^P/'; //Cherche "p" ou "P" en début de chaine
$masque_startmaj = '/^[A-Z]/'; //Cherche une majuscule en début de chaine
$masque_endq = '/\?$/'; //Cherche "?" en fin de chaine
$masque_startp_endq = '/^p\?$|^P\?$/'; //On cherche exactement "p?" ou "P?"

//// Les quantificateurs
/*
a{X}		On veut une séquence de X « a »
a{X,Y}	On veut une séquence de X à Y fois « a »
a{X,}		On veut une séquence d’au moins X fois « a » sans limite supérieure
a?			On veut 0 ou 1 « a ». Équivalent à a{0,1}
a+			On veut au moins un « a ». Équivalent à a{1,}
a*			On veut 0, 1 ou plusieurs « a ». Équivalent à a{0,}
*/

$masque_er01 = '/er?/'; //1 "e" suivi de 0 ou 1 "r"
$masque_er1 = '/er+/'; //1 "e" suivi d'au moins 1 "r"
$masque_majet10 = '/^[A-Z].{10,}\?$/'; //Une majuscule suivi d'au moins 10 caractères qui ne sont pas des \n (retour ligne)
$masque_10nb = '/^\d{10,10}$/'; //exactement et uniquement 10 chiffres

//// Les sous masques ( et ) sont capturants et prioritise la recherche
$masque_erout = '/er|t/'; //Chercher "er" ou "t"
$masque_eret = '/e(r|t)/'; //Cherche "er", "et", "r" et "t"
$masque_err = '/er{2}/'; //Cherche "e" suivi de "r" suivi de "r"
$masque_erer = '/(er){2}/'; //Cherche "er" suivi de "er"

//// Les assertions (avant, arrière, positive, négative) ne sont pas capturantes

/*______________________________
a(?=b)	Cherche « a » suivi de « b » (assertion avant positive)
a(?!b)	Cherche « a » non suivi de « b » (assertion avant négative)
(?<=b)a	Cherche « a » précédé par « b » (assertion arrière positive)
(?<!b)a	Cherche « a » non précédé par « b » (assertion arrière négative)
______________________________*/

$masque_er = '/e(?=r)/'; //Chercher "e" suivi de "r"
$masque_enonr = '/e(?!r)/'; //Chercher "e" non suivi de "r"
$masque_is = '/(?<=i)s/'; //Cherche "s" précédé de "i"
$masque_nonis = '/(?<!i)s/'; //Cherche "s" non précédé de "i"

//// Résumé des métacaractères en dehors des classes

/*______________________________
\		Caractère dit d’échappement ou de protection qui va servir notamment 
		à neutraliser le sens d’un métacaractère ou à créer une classe abrégée
[		Définit le début d’une classe de caractères
]		Définit la fin d’une classe de caractères
.		Permet de chercher n’importe quel caractère à l’exception du caractère de nouvelle ligne
|		Caractère d’alternative qui permet de trouver un caractère ou un autre
^		Permet de chercher la présence d’un caractère en début de chaine
$		Permet de chercher la présence d’un caractère en fin de chaine
?		Quantificateur de 0 ou 1. Peut également être utilisé avec « ( » pour en modifier le sens
+		Quantificateur de 1 ou plus
*		Quantificateur de 0 ou plus
{		Définit le début d’un quantificateur
}		Définit la fin d’un quantificateur
(		Début de sous masque ou d’assertion
)		Fin de sous masque ou d’assertion
______________________________*/

//
////////// LES OPTIONS OU MODIFICATEURS /.../option

/*______________________________
i		Rend la recherche insensible à la casse
m		La recherche s'effectue sur une seule ligne (jusqu'à un retour ligne \n ou retour chariot \r)
s		Cette option permet au métacaractère . de remplacer n’importe quel caractère 
		y compris un caractère de nouvelle ligne
x		Permet d’utiliser des caractères d’espacement dans nos masques qui seront ignorés sauf pour les séquences spéciales
u		Cette option permet de désactiver les fonctionnalités additionnelles de PCRE qui ne sont pas compatibles avec le langage Perl. Cela peut être très utile dans le cas où on souhaite exporter nos regex
______________________________*/

$masque_piecasse = '/pie/'; //cherche "pie" en minuscule
$masque_piepascasse = '/pie/i'; //cherche pie en min ou maj
$masque_ende = '/e$/'; //cherche "e" à la fin d'une chaine de caractère
$masque4_endeline = '/e$/m'; //"e" à la fin d'une ligne ou chaine
echo '<br>';

//
////////// EXEMPLE CONCRET POUR UN MOT DE PASSE DE FORMULAIRE
?>

<form action='coursPHP.php' method='post'>
	<label for='pass'>Choisissez un mot de passe.</label>
	<input type='password' name='pass' id='pass'>
	<br>
	<p>Note : Le mot de passe doit possèder au moins 8 caractères dont
	au moins une majuscule, un chiffre et un caractère spécial</p>
	<br>
	<input type='submit' value='Envoyer'>
</form>

<?php
$m = '/^\S*(?=\S{8,})(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/';
//on désire un mdp sans espaces, avec 8 caractères minimum, au moins 1 majuscule, 1 chiffre et 1 caractère spécial

if (isset($_POST['pass'])) {
  if (preg_match($m, $_POST['pass'])) {
    echo 'Le mot de passe choisi convient<br>';
  } else {
    echo 'Le mot de passe choisi ne répond pas aux critères<br>';
  }
}

/////////////////////////////////////////////////////////////
?>
<!-- ---------------------------------------------------------- -->
<h2>LES CONCEPTS DE BASE DE LA PROGRAMMATION ORIENTÉ OBJET PHP</h2>
<!-- ---------------------------------------------------------- -->
<?php
//
////////// CLASSES, INSTANCES ET OBJETS

// Une classe est un bloc de code qui va contenir différentes variables, fonctions et éventuellement constantes et qui va servir de plan de création pour différents objets.

require 'classes/utilisateur.class.php';
$pierre_test = new Utilisateur_test();
//on crée une nouvelle instance (copie) de la classe Utilisateur_test qui va crée automatiquement un nouvel objet $pierre

/*__ utilisateur.class.php _____
class Utilisateur_test{
	public $user_name; //on déclare la propriété user_name
	public $user_pass; //public pour pouvoir le modifier en dehors de la class (dangereux)
}
______________________________*/

//
////////// PROPRIÉTÉS ET MÉTHODES

$mathilde_test = new Utilisateur_test();
$pierre_test->user_name = 'Pierre'; //l'opérateur objet permet d'accéder aux propriétés
$pierre_test->user_pass = 'abcdef';
$mathilde_test->user_name = 'Math';
$mathilde_test->user_pass = 123456;

/*__ utilisateur.class.php _____
class Utilisateur{
	private $user_name; //plus sécurisé, accessible seulement à l'intérieur de la classe
	private $user_pass;
	public function getNom(){ //on déclare une méthode accessible en dehors de la classe
		return $this->user_name; //pseudo variable qui correspond à l'objet utilisé
	}
	public function setNom($new_user_name){
		$this->user_name = $new_user_name;
	}
	public function setPasse($new_user_pass){
		$this->user_pass = $new_user_pass;
	}
}
______________________________*/

$pierre = new Utilisateur();
$mathilde = new Utilisateur();
$pierre->setNom('Pierre');
$mathilde->setNom('Math');
$pierre->setPasse('abcdef');
$mathilde->setPasse('123456');

echo $pierre->getNom() . '<br>';
echo $mathilde->getNom() . '<br>';

//
////////// LA MÉTHODE CONSTRUCTEUR

/*__ utilisateur.class.php _____
class User{
	private $user_name;
	private $user_pass;
	public function __construct($n, $p){ //méthode exécuté à la création d'un nouvel objet
		$this->user_name = $n;
		$this->user_pass = $p;
	}
	public function getNom(){
		return $this->user_name;
	}
}
______________________________*/

$pierre = new User('Pierre', 'abcdef');
$mathilde = new User('Math', 123456);
//$pierre = new User($_POST['nom'], $_POST['pass']); cas réel d'un formulaire
echo '<br>';

// la fonction __destruct() sert à exécuter du code avant la destruction d'un objet

//
////////// ENCAPSULATION (groupement des données au sein d'une classe)

/*__ Niveaux de visibilité _____
public= accessible partout (par défaut pour les méthodes et constantes)
private = accessible seulement à l'intérieur de la classe
protected = à l'intérieur + héritage ou parent
______________________________*/

//
////////// CLASSES ÉTENDUES ET HÉRITAGE

/*__ admin.class.php ___________
class Admin extends User{}
______________________________*/

require 'classes/admin.class.php'; //Admin est une classe "enfant" de User
$philadmin = new Admin('Phil', 'coucou'); //on utilise le construct du parent User car il est public
echo $philadmin->getNom() . '<br>';

/*__ admin.class.php ___________
class Admin extends User{
	public function getNom2(){ //nouvelle méthode
		return $this->user_name; //user_name est private dans User donc inaccessible
	}
	public function getNom(){ //on surcharge la méthode de User, elles sera donc utilsée par $phil
		return $this->user_name; //mais $user_name toujours inaccessible
	}
} //ces méthodes ne pourront pas marcher
______________________________*/

/*__ utilisateur.class.php _____
class User{
	protected $user_name; //protected pour que Admin puisse y accéder
	protected $user_pass;
	...
}//Les méthodes de Admin pourront ainsi marcher
______________________________*/

/*__ admin.class.php ___________
class Admin extends User{
	protected $ban;
  public function setBan($b) //création d'un tableau des bannis
  {
    $this->ban[] .= $b;
  }
  public function getBan()
  {
    echo "Utilisateurs bannis par " . $this->user_name . " : ";
    foreach ($this->ban as $valeur) {
      echo $valeur . ", ";
    }
  }
}
______________________________*/

$philadmin->setBan('Gontran'); //on bannit Gontran
$philadmin->setBan('Gaël');
echo $philadmin->getBan(); //Utilisateurs bannis par Phil : Gontran, Gaël,
echo '<br>';

////////// SURCHARGE ET OPÉRATEUR DE RÉSOLUTION DE PORTÉE ::

//surcharger = redéclarer une fonction parent avec le même nombre de paramètres

/*__ admin.class.php ___________
class Admin extends User{
	protected $ban;
	public function getNom(){ //on surcharge getNom()
		return strtoupper($this->user_name); //nom en majuscule
	}
	public function __construct($n, $p){ //on surcharge la méthode __construct
		$this->user_name = strtoupper($n); //nom directement en majuscule
		$this->user_pass = $p;
	}
	...
}
______________________________*/

echo $philadmin->getNom() . '<br>'; //PHIL en majuscule car $philadmin est un objet de classe Admin
$valadmin = new Admin('Valerie', 'valoche'); //nom directement en majuscule avec la surcharge construct
echo $valadmin->getNom() . '<br>';

//// parent::

/*__ utilisateur.class.php _____
class User{
	...
	public function getNom()
  {
    echo $this->user_name; 
  } //echo à la place du return pour permettre l'exécution du code après l'instruction
	...
}//Les méthodes de Admin pourront ainsi marcher
______________________________*/

/*__ admin.class.php ___________
class Admin extends User{
	...
	public function getNom(){
		parent::getNom(); //on appelle la méthode du parent (User)
		echo ' (depuis la classe étendue)<br>'; 
	} //on peut rajouter des instruction grâce à la suppression du return
	...
}
______________________________*/

//
////////// LES CONSTANTES DE CLASSE

// self:: on utilise la constante à l'intérieur de la classe

/*__ utilisateur.class.php _____
class UserAbo
{
  protected $prix_abo;
  protected $user_cat;
  public const ABONNEMENT = 15;

  public function __construct($n, $p, $c)
  {
    $this->user_name = $n;
    $this->user_pass = $p;
    $this->user_cat = $c;
  }
  public function setPrixAbo()
  {
    if ($this->user_cat === "mineur") {
      return $this->prix_abo = self::ABONNEMENT / 2;
    } else {
      return $this->prix_abo = self::ABONNEMENT;
    }
  }
  public function getPrixAbo()
  {
    echo $this->prix_abo;
  }
	...
}
______________________________*/

// parent:: on utilise la constante de la classe parent

/*__ admin.class.php ___________
class AdminAbo extends UserAbo
{
  public const ABONNEMENT = 5; //surcharge en donnant une nouvelle valeur
  public function __construct($n, $p, $c)
  {
    $this->user_name = strtoupper($n);
    $this->user_pass = $p;
    $this->user_cat = $c;
  }
  public function setPrixAbo()
  {
    if ($this->user_cat === "mineur") {
      return $this->prix_abo = self::ABONNEMENT; //valeur dans AdminAbo
    } else {
      return $this->prix_abo = parent::ABONNEMENT / 2; //valeur dans UserAbo
    }
  }
	...
}
______________________________*/

$marcadminabo = new AdminAbo('Marc', 'loremipsum', 'majeur');
$julieadminabo = new AdminAbo('Julie', 'jujufitcats', 'mineur');
$lucabo = new UserAbo('Luc', 'culcul', 'majeur');

$marcadminabo->setPrixAbo(); //dans AdminAbo pour majeur (7.5)
$julieadminabo->setPrixAbo(); //dans AdminAbo pour mineur (5)
$lucabo->setPrixAbo(); //dans UserAbo pour majeur (15)

echo 'ABONNEMENT dans UserAbo : ' . UserAbo::ABONNEMENT . '<br>';
echo 'ABONNEMENT dans AdminAbo : ' . AdminAbo::ABONNEMENT . '<br>';
echo 'Prix pour ';
$marcadminabo->getNom();
echo ' : ';
$marcadminabo->getPrixAbo();

echo '<br>Prix pour ';
$julieadminabo->getNom();
echo ' : ';
$julieadminabo->getPrixAbo();

echo '<br>Prix pour ';
$lucabo->getNom();
echo ' : ';
$lucabo->getPrixAbo();
echo '<br>';

//
////////// LES PROPRIÉTÉS ET MÉTHODES STATIQUES

// Une propriété statique est une propriété dont la valeur va pouvoir être modifiée et qui va être partagée par tous les objets de la classe.
// On ne peut pas accéder à une propriété statique depuis un objet avec -> mais avec ::

/*__ admin.class.php ___________
class AdminAbo extends UserAbo
{
  protected static $ban; //static pour que la variable soit partagée à tous les objets de la classe AdminAbo
	public function setBan(...$b) //pour accepter un nombre variable d'arguments
  {
    foreach($b as $banned){
			self::$ban[] .= $banned; //$ban appartient maintenant à une classe et plus à un objet en particulier
		}
  }
  public function getBan()
  {
    echo 'Utilisateurs bannis: ';
    foreach (self::$ban as $valeur) { //on utilise ici aussi l'opérateur de résolution de portée ::
      echo $valeur . ', ';
    }
  }
	...
}
______________________________*/

//Marc et Julie sont Admin, Luc est simple utilisateur
$marcadminabo->setBan('Titouan', 'Engène');
$julieadminabo->setBan('Estelle');
$marcadminabo->getBan(); //Utilisateurs bannis: Titouan, Engène, Estelle,
echo '<br>';
$julieadminabo->getBan(); //pareil car $ban est partagé
echo '<br>';

//
////////// LES MÉTHODES ET CLASSES ABSTRAITES

//
//
?>
		<p id="signet">Signet</p>
	</body>
</html>
