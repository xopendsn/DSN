<?php
$salaire=new SALAIRE(); 
$salaire->store(
/****************************************************************/
// DONNÉE DE PAIE
/****************************************************************/
	'2023-04-01', // Premier jour du mois de la paie 
	2000, // Salaire brut forfaitaiire
	'C123567',// Reference du réglement
/****************************************************************/ 
// mysql -u root -p -e 'CREATE DATABASE XOPENDSN' ; 
// mysql -u root -p XOPENDSN < XOPENDSN.sql 
// chmod 777 PDF/
// localhost/dsn/xopendsn.php?date='2023-04-01&id=1' 
	$individu->PAS()
);
$salaire->hydrate($salaire->DATE());
?>
