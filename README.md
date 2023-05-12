# XOPENDSN : An Open Source 'DSN' compiler

## About / A propos

XOPENDSN is a PHP library to quickly generate a 'DSN' (Declaration Sociale Nominative) and a French PDF payslip. Since the use of the 'DSN' exporting a payslip from Excel or LibreOffice Calc is not anymore possible, in France, for small size compagnies. This PHP library would be an alternative to sahreware Saas plateform.   

XOPENDSN est une bibliothèque PHP pour générer rapidement une 'DSN' (Declaration Sociale Nominative) et une fiche de paie au format PDF. Depuis le déploiement de la 'DSN', en France, exporter une fiche de paie depuis Excel ou LibreOffice Calc n'est plus vraiment possible pour les PME. Cette bibliothèque PHP est une alternative ou outils en ligne payants.

A this date, XOPENDSN is limited to 1 employee for 1 compagny. As an open source project, XOPENDSN can be completed and redeveloped. 

A l'heure actuelle, le projet est limité à 1 salarié pour 1 établissement. En tant que projet open source, XOPENDSN peut être librement complété et redéveloppé. 


## Requirements / Prérequis

XOPENDSN requires : 
- PHP 8.0.0 at least 
- MySQL 8.0 at least
- Apache2 at least

For database administration the use phpMyAdmin is highly recommanded.  PDF payslips export uses the PHP library PhpOdt :

XOPENDSN requière : 
- PHP 8.0.0 ou suéprieur 
- MySQL 8.0 ou supérieur

Pour l'administration de la base de donnée, l'utilisation de phpMyAdmin est fortement recommandé. L'export PDF des fiches de paie utilise la librairie PhpOdt :

## Get start / Débuter

### Install PHP / MySQL / phpMyAdmin 

First, update (or fresh install) your Apach2 / PHP / MySQL configuration. 
En premier lieu, mettez à jour (ou installez) votre configuration Apach2 / PHP / MySQL. 

````powershell
sudo apt-get update
sudo apt install apache2
sudo apt install mysql-server
sudo apt install php libapache2-mod-php php-mysql
````
### Install XOPENDSN.sql database / Installer la base de données XOPENDSN.sql
  
Apache2 / PHP / MySQL have been already configured ? Then, start by updating the XOPENDSN.sql database. 
Apache2 / PHP / MySQL sont configurés ? Alors, commencez par installer la base de données XOPENDSN.sql.

````powershell
mysql -u root -p -e 'CREATE DATABSE XOPENDSN'
mysql -u root -p XOPENDN < XOPENDSN.sql
````

Be carefull of the folders permissions. Attention aux droits des dossiers.   

````powershell
sudo chmod -r 777 PDF
````

### Configure / Configuration

Edit the file config.php and by adding your own personal parameters. Editez le fichier config.php en ajoutant vos propres informations personnelles.  

````powershell
gedit config.php
````

Do not forget to change database password ('password') and login if not root in function.php. Ne pas oublier de changer le mot de passe de la base de données ('password') et le login si different de root.

````php
return $mysqli=new mysqli('localhost', 'root', 'password', $db);// local
````
  
### Hello World / Premier test

Create a first pay example. Edit the file salaire.php. 
Créez une premier salaire. Editez le fichier salaire.php. 

````powershell
gedit config.php
````
Complete it with the following data. Entrez les informations suivantes. 

````php
$salaire->store(
'2023-04-01', // Premier jour du mois : yyyy-mm-dd 
'2500', // Montant du salaire brut : float
'VIR 56789' // Référence du réglement : text
);
````

Open web browser and go to the following location. Ouvrez un navigateur web et entrez l'adresse suivant :

> localhost/xopendsn.php

You will find in your local download folder a .dsn file and in PDF/ the payslip (fichier .odt). Vous trouverez dans le dossier local de téléchargement un .dsn ainsi que dans le dossier PDF/ la fiche de paie (.odt file). You can adapt the odt template (BdP.odt file) as you want (add your logo at top left, for example). vous pouvez adapter le template odt (fichier BdP.odt) comme vous le souhaitez (en ajoutant votre logo en haut à gauche). 
