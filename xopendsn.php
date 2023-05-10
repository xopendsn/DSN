<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include('dsn.php');

include('config.php');

include('salaire.php');

 
$soft='XOPENDSN';
$version='P23V01';

$numero=$_GET['id']; 

$dudate=strtotime($_GET['date']);

$dsn1 = array(
	/* ## S10 - ENTÊTE ## */
		
	['S10.G00.00.001',$soft],							// Nom du logiciel utilisé		
  	['S10.G00.00.002',$societe->RAISON()],				// Éditeur du logiciel de paie
	['S10.G00.00.005','01'], 							// Version de test '01', version définitive '02'
  	['S10.G00.00.006',$version],						// Version de la norme
  	['S10.G00.00.007','01'],							// Point de dépôt '01' pour net-entreprise
  	['S10.G00.00.008','01'],							// '01' pour un envoi normal. '02' pour une déclaration néant
  	
  	['S10.G00.01.001',$societe->SIREN()],				//
  	['S10.G00.01.002',$societe->NIC()],				//
  	['S10.G00.01.003',$societe->RAISON()],				//
  	['S10.G00.01.004',$societe->ADRESSE()],			//
  	['S10.G00.01.005',$societe->CP()],					//
  	['S10.G00.01.006',$societe->VILLE()],				//
  	
  	['S10.G00.02.001',$contact->CIVILITE()],			//
  	['S10.G00.02.002',$contact->PRENOM(). ' '. $contact->NOM()],//
  	['S10.G00.02.004',$contact->EMAIL()],				//
  	['S10.G00.02.005',$contact->TEL()],					//
  	
  	/* ## S20 - DÉCLARATION ## */
  	
  	['S20.G00.05.001','01'],							// '01' pour un envoi normal. '02' pour une déclaration néant
  	['S20.G00.05.002','01'],							// '01' pour un envoi normal. '02' pour une déclaration néant. '03' pour annule et remplace
  	['S20.G00.05.003','11'],							// Faction de déclaration : en 1 fois 1/1 = 11
  	['S20.G00.05.004',$numero],							// Numéro
  	['S20.G00.05.005',date('dmY', $dudate)],			// Date du mois de déclaration (premier jour)
  	['S20.G00.05.007',date('dmY')],						// Date de construction du fichier
  	['S20.G00.05.008','01'],							// Champ d'application : '01' pour le régime général
  	['S20.G00.05.010','01'],							// Devise : '01' pour euro
  	
  	
  	/* ## S21.G00.06 - ENTREPRISE */
  	
  	['S21.G00.06.001',$societe->SIREN()],				// SIREN de l'entreprise
  	['S21.G00.06.002',$societe->NIC()],				// NIC de l'entreprise
  	['S21.G00.06.003',$societe->APE()],				// APE de l'entreprise
  	['S21.G00.06.004',$societe->ADRESSE()],			// Adresse de l'entreprise
  	['S21.G00.06.005',$societe->CP()],					// CP de l'entreprise
  	['S21.G00.06.006',$societe->VILLE()],				// Ville de l'entreprise
  	  	
);

if(date('m', $dudate)=='12'){
$dsn2 = array(
	['S21.G00.06.009',$societe->EFFECTIF()],			// Effectif moyen de l'entreprise au 31 décembre
);
}else{
$dsn2 = array();										// Empty array

}

$dsn3=array(

  	/* ## S21.G00.06 - ETABLISSEMENT */
  	
	['S21.G00.11.001',$societe->NIC()],				// NIC de l'établissement
  	['S21.G00.11.002',$societe->APE()],				// APE de l'établissement
  	['S21.G00.11.003',$societe->ADRESSE()],			// Adresse de de l'établissement 
  	['S21.G00.11.004',$societe->CP()],					// CP de l'établissement
  	['S21.G00.11.005',$societe->VILLE()],				// Ville de l'établissement
  	['S21.G00.11.008',$societe->EFFECTIF()],			// Effectif de l'établissement en fin de période 
  	['S21.G00.11.022',$societe->IDCC()],				// IDCC convention collective 

	/* ## S21.G00.06 - VERSEMENT ORGANISME DE PROTECTION SOCIALE */

	// URSSAF
	['S21.G00.20.001',$urssaf->SIRET()],				// SIRET
	['S21.G00.20.002',$societe->SIREN(). $societe->NIC() ],// Entité d'affectation de l'établissement / SIRET
	['S21.G00.20.003',$societe->BIC()],				// BIC
	['S21.G00.20.004',$societe->IBAN()],				// IBAN
	['S21.G00.20.005',number_format($salaire->getURSSAF('S21.G00.20'), 2, '.', '')],// Montant de cotisation/versement organisme
	['S21.G00.20.006',date('dmY', $dudate)],			// Date de début de période
	['S21.G00.20.007',date('tmY', $dudate)],			// Date de fin de période
	['S21.G00.20.010','05'],							// Mode de règlement. Seul le SEPA semble autorisé ('05')
		
	// AGIRC / ARRCO
	['S21.G00.20.001',$ruaa->SIRET()],				// SIRET
	['S21.G00.20.002',$societe->SIREN(). $societe->NIC() ],// Entité d'affectation de l'établissement / SIRET
	['S21.G00.20.003',$societe->BIC()],				// BIC
	['S21.G00.20.004',$societe->IBAN()],				// IBAN
	['S21.G00.20.005',number_format($salaire->getRUAA(), 2, '.', '')],// Montant de cotisation/versement organisme
	['S21.G00.20.006',date('dmY', $dudate)],			// Date de début de période
	['S21.G00.20.007',date('tmY', $dudate)],			// Date de fin de période
	['S21.G00.20.010','05'],
	
	// DGFiP
	['S21.G00.20.001',$dgfip->SIRET()],				// SIRET
	['S21.G00.20.002',$societe->SIREN(). $societe->NIC() ],// Entité d'affectation de l'établissement / SIRET
	['S21.G00.20.003',$societe->BIC()],				// BIC
	['S21.G00.20.004',$societe->IBAN()],				// IBAN
	['S21.G00.20.005',number_format($salaire->getDGFIP($individu->PAS(), 0), 2, '.', '')],	// Montant de cotisation/versement organisme
	['S21.G00.20.006',date('dmY', $dudate)],			// Date de début de période
	['S21.G00.20.007',date('tmY', $dudate)],			// Date de fin de période
	['S21.G00.20.010','05'],
	
	/* ## S21.G00.06 - Bordereau de cotisation due */

	['S21.G00.22.001',$urssaf->SIRET()],				// SIRET
	['S21.G00.22.002',$societe->SIREN(). $societe->NIC() ],// Entité d'affectation de l'établissement / SIRET
	['S21.G00.22.003',date('dmY', $dudate)],				// BIC
	['S21.G00.22.004',date('tmY', $dudate)],				// IBAN
	['S21.G00.22.005',number_format($salaire->getURSSAF('S21.G00.20'), 2, '.', '')],// Montant de cotisation/versement organisme  	

); 

$MyURSSAF=$salaire->getURSSAF('S21.G00.23'); 

foreach($MyURSSAF as $urssaf_i){

	if($urssaf_i['CTP']!='863' || $urssaf_i['BASE']!='920'){
		$dsnURSSAF=array(

	// ## S21.G00.23 - COTISATION AGRÉGÉE <> ATMP (voir régles ACCOS)
	
	['S21.G00.23.001',$urssaf_i['CTP']],				// CTP URSSAF 
	['S21.G00.23.002',$urssaf_i['BASE'] ],				// Assiette '920' autre '921' plafonnée
	['S21.G00.23.004',number_format($urssaf_i['BASE_MONTANT'], 2, '.', '')],			// Monant de la cotisaton agrégée
	['S21.G00.23.006',$societe->INSEE()],				// Code INSEE
			
		);
	}else{
		$dsnURSSAF=array(

	// ## S21.G00.23 - COTISATION AGRÉGÉE == ATMP (voir régles ACCOS)
	
	['S21.G00.23.001',$urssaf_i['CTP']],				// CTP URSSAF 
	['S21.G00.23.002',$urssaf_i['BASE'] ],				// Assiette '920' autre '921' plafonnée
	['S21.G00.23.003',$contrat->getTATMP()],			// Taux ATMP
	['S21.G00.23.004',number_format($urssaf_i['BASE_MONTANT'], 2, '.', '')],// Monant de la cotisaton agrégée
	['S21.G00.23.006',$societe->INSEE()],				// Code INSEE
			
	//['S21.G00.23.001',$urssaf_i['CTP']],				// CTP URSSAF 
	//['S21.G00.23.002',$urssaf_i['BASE'] ],				// Assiette '920' autre '921' plafonnée
	//['S21.G00.23.004',number_format($urssaf_i['BASE_MONTANT'], 2, '.', '')],// Monant de la cotisaton agrégée
	//['S21.G00.23.006',$societe->INSEE()],				// Code INSEE

		);
	
	}
	
	$dsn3=array_merge($dsn3, $dsnURSSAF); 
}

  	/* ## S21.G00.44 - ASSUJETTISSEMENT FISCAL */
  	
foreach($dgfip->ASSUJETTISSEMENT() as $dgfip_i){
  	
  	$dsn_dgfip=array(
  	
  	['S21.G00.44.001',$dgfip_i],// Assujettissement 
  	['S21.G00.44.002',number_format($salaire->BRUT(), 2, '.', '')],// Montant de l'assiette
  	['S21.G00.44.003',date('Y', $dudate)],				// Année
  	
  	); 
  	$dsn3=array_merge($dsn3, $dsn_dgfip);

}
foreach($dgfip->NON_ASSUJETTISSEMENT() as $dgfip_i){
  	
  	$dsn_dgfip=array(
  	
  	['S21.G00.44.001',$dgfip_i],// Non sssujettissement 
  	['S21.G00.44.003',date('Y', $dudate)],// Année
  	
  	); 
  	$dsn3=array_merge($dsn3, $dsn_dgfip);

}
  	
$dsn4=array(
  	/* ## S21.G00.30 - INDIVIDU */
  	
	['S21.G00.30.001',$individu->NSS()],				// N° SS sans clé du bénéficiaire
  	['S21.G00.30.002',$individu->NOM()],				// Nom du bénéficiaire
  	['S21.G00.30.003',$individu->NOM()],				// Nom d'usage du bénéficiaire
  	['S21.G00.30.004',$individu->PRENOM()],				// Prénom du bénéficiaire
  	['S21.G00.30.005',$individu->SEX()],				// Sexe du bénéficiaire
  	['S21.G00.30.006',date('dmY', strtotime($individu->NSS_DATE()))],// Date de naissance du bénéficiaire
  	['S21.G00.30.007',$individu->NSS_VILLE()],			// Ville de naissance du bénéficiaire
  	['S21.G00.30.008',$individu->ADRESSE()],			// Adresse du bénéficiaire
  	['S21.G00.30.009',$individu->CP()],					// CP du bénéficiaire
  	['S21.G00.30.010',$individu->VILLE()],				// Ville du bénéficiaire
  	['S21.G00.30.013','01'],							// Codification UE
  	['S21.G00.30.014',$individu->NSS_DEPARTEMENT()],	// Département de naissance du bénéficiaire
  	['S21.G00.30.015',$individu->NSS_PAYS()],			// Pays de naissance du bénéficiaire
  	
  	/* ## S21.G00.40 - CONTRAT */
  	
	['S21.G00.40.001',date('dmY', strtotime($contrat->DATE()))],//Date de début du contrat 	
	['S21.G00.40.002',$contrat->STATUT()],					// Statut conventionnel
	['S21.G00.40.003',$contrat->RETRAITE()],			// Code retraite
	['S21.G00.40.004',$contrat->PCS()],					// Code profession PCS-ESE
	['S21.G00.40.006',$contrat->LIBELLE()],				// Titre de l'emploi
	['S21.G00.40.007',$contrat->TYPE()],				// Type de contrat	
	['S21.G00.40.008','99'],							// Dispositif public : '99' sans 
	['S21.G00.40.009',$contrat->ID()],					// Matricule du salarié
	['S21.G00.40.011',$contrat->UNITE()],				// Unité de mesure du travail (Forfait jour = '20')
	['S21.G00.40.012',$contrat->TEMPS()],				// Quotité de travail
	['S21.G00.40.013',$contrat->TEMPS()],				// Quotité contractuelle
	['S21.G00.40.014',$contrat->QUOTITE()],				// Modalité d'exercice du temps de travail
	['S21.G00.40.016','99'],							// Alsace-Moselle ?
	['S21.G00.40.017',$societe->IDCC()],				// Code IDCC
	['S21.G00.40.018','200'],							// Régime général = '200'
	['S21.G00.40.019',$societe->SIREN(). $societe->NIC()],// SIRET lieu de travail
	['S21.G00.40.020','200'],							// Régime général = '200'
	['S21.G00.40.024','99'],							// Expatrié ? non = '99'
	['S21.G00.40.026','99'],							// Statut public : '99' = non concrené
	['S21.G00.40.036','03'],							// Précise si le salarié a plusieurs emplois chez un même employeur
	['S21.G00.40.037','03'],							// idem
	['S21.G00.40.039','200'],							// Rattachement CNAM = 200
	['S21.G00.40.040',$contrat->ATMP()],				// Code ATMP risque du travail
	['S21.G00.40.043',$contrat->getTATMP()],			//  Taux AT/MP de l'année

	/* ## S21.G00.71 - RETRAITE COMPLÉMENTAIRE */

	['S21.G00.71.002','RUAA'],							//  Code régime retraite simple régime général	
	
	/* ## S21.G00.50 - VERSEMENT INDIVIDU (DGFiP) */

	['S21.G00.50.001',date('tmY', $dudate)],			// Date de versement salaire 
	['S21.G00.50.002',number_format($salaire->getBASE_FISCALE(), 2, '.', '')],// Montant du net fiscal ou base fiscale imposable
	['S21.G00.50.003',$salaire->REGLEMENT()],			// Numéro de versement, traçabilité relevé comptes
	['S21.G00.50.004',number_format($salaire->getNETNET($individu->PAS()), 2, '.', '')],// Montant net versé
	['S21.G00.50.006',number_format($individu->PAS(), 2, '.', '')],// Taux PAS
	['S21.G00.50.007','01'],								// PAS by/from DGFiP
	['S21.G00.50.008',$individu->IDPAS()],				// Identifiant TOPAZE du PAS
	['S21.G00.50.009',number_format($salaire->getDGFIP($individu->PAS(), 2), 2, '.', '')],//PAS total
	['S21.G00.50.013',number_format($salaire->getBASE_FISCALE(), 2, '.', '')],// Montant brut fiscal soumis au PAS
		
	/* ## S21.G00.51 - RÉMUNÉRATION */	
	
	['S21.G00.51.001',date('dmY', $dudate)],			// Date début de période
	['S21.G00.51.002',date('tmY', $dudate)],			// Date fin de période
	['S21.G00.51.010',$contrat->ID()],					// Numéro du contrat
	['S21.G00.51.011','001'],							// Type de rémunération
	['S21.G00.51.013',number_format($salaire->BRUT(), 2, '.', '')],// Montant associé	
		
); 

if($contrat->TYPE()=='80'){
	$S21G00510112=0; 									// Pas de chomge
}else{
 	$S21G00510112=$salaire->BRUT();
 	$dsn4bis=array(
 	/*
 	% ATTENTION C'EST FAUX
    	DATA{end+1}={'S21.G00.53.001','01'};        % Type d'activité
	DATA{end+1}={'S21.G00.53.002','18.00'};    	% Quotité
	DATA{end+1}={'S21.G00.53.003','12'};        % Unité de mesure du travail (Forfait jour = '20'). Pas clair...
 	*/
 ); 
}
	
$dsn5=array(

	['S21.G00.51.001',date('dmY', $dudate)],			// Date début de période
	['S21.G00.51.002',date('tmY', $dudate)],			// Date fin de période
	['S21.G00.51.010',$contrat->ID()],					// Numéro du contrat
	['S21.G00.51.011','002'],							// Type de rémunération
	['S21.G00.51.013',number_format($S21G00510112, 2, '.', '')],// Montant associé
	
	['S21.G00.51.001',date('dmY', $dudate)],			// Date début de période
	['S21.G00.51.002',date('tmY', $dudate)],			// Date fin de période
	['S21.G00.51.010',$contrat->ID()],					// Numéro du contrat
	['S21.G00.51.011','003'],							// Type de rémunération
	['S21.G00.51.013',number_format($salaire->BRUT(), 2, '.', '')],// Montant associé	
	
	['S21.G00.51.001',date('dmY', $dudate)],			// Date début de période
	['S21.G00.51.002',date('tmY', $dudate)],			// Date fin de période
	['S21.G00.51.010',$contrat->ID()],					// Numéro du contrat
	['S21.G00.51.011','010'],							// Type de rémunération
	['S21.G00.51.013',number_format($salaire->BRUT(), 2, '.', '')],// Montant associé
	
	['S21.G00.79.001','07'],// Montant associé
	['S21.G00.79.004',number_format($salaire->getPMSS(), 2, '.', '')],// Montant associé	
		 		

); 





	/* ## S21.G00.78 - BASE ASSUJETTIE */
	$S21G0078=[2, 3, 4]; 
	
	$MyURSSAF=$salaire->getURSSAF('S21.G00.81'); 
$loop=0; 
foreach($S21G0078 as $ba){
if($loop==0){

$dsn_ba=array(
	['S21.G00.78.001',str_pad($ba, 3, '0', STR_PAD_LEFT)],// Code de base assujettie
	['S21.G00.78.002',date('dmY', $dudate)],			// Date début de période
	['S21.G00.78.003',date('tmY', $dudate)],			// Date fin de période
	['S21.G00.78.004',number_format($salaire->BRUT(), 2, '.', '')],// Montant associé	

);
}else{
$dsn_ba=array_merge($dsn_ba, array(
	['S21.G00.78.001',str_pad($ba, 3, '0', STR_PAD_LEFT)],// Code de base assujettie
	['S21.G00.78.002',date('dmY', $dudate)],			// Date début de période
	['S21.G00.78.003',date('tmY', $dudate)],			// Date fin de période
	['S21.G00.78.004',number_format($salaire->BRUT(), 2, '.', '')],// Montant associé	

)); 
}

	foreach($MyURSSAF as $myurssaf){

		if($myurssaf['BASE']==$ba){
			$dsn_ba_i=array(
				/* ## S21.G00.81 - COTISATION INDIVIDUELLE */     
				['S21.G00.81.001',str_pad($myurssaf['CI'], 3, '0', STR_PAD_LEFT)],
				['S21.G00.81.002',$urssaf->SIRET()],
				['S21.G00.81.003',number_format($myurssaf['BASE_MONTANT'], 2, '.', '')],
				['S21.G00.81.004',number_format($myurssaf['TOTAL'], 2, '.', '')],
				['S21.G00.81.005',$societe->INSEE()],//
				['S21.G00.81.007',number_format($myurssaf['TAUX'], 2, '.', '')],
			);
			$dsn_ba=array_merge($dsn_ba, $dsn_ba_i);
		}


	}
	$loop=1; 
}

$dsn7=array(
	/* ## S21.G00.78 - BASE ASSUJETTIE */
	['S21.G00.78.001','07'],					// Chomage...
	['S21.G00.78.002',date('dmY', $dudate)],			// Date début de période
	['S21.G00.78.003',date('tmY', $dudate)],			// Date fin de période
	['S21.G00.78.004',number_format($S21G00510112, 2, '.', '')],// Montant associé	
	
	['S21.G00.78.001','10'],							// DGFiP
	['S21.G00.78.002',date('dmY', $dudate)],			// Date début de période
	['S21.G00.78.003',date('tmY', $dudate)],			// Date fin de période
	['S21.G00.78.004',number_format($salaire->BRUT(), 2, '.', '')],// Montant associé
	
	/* ## S21.G00.81 - COTISATION INDIVIDUELLE */
	['S21.G00.81.001','105'],							// RUAA
	['S21.G00.81.004',number_format($salaire->getRUAA(), 2, '.', '')],// Montant associé		
	
);

$data = array_merge($dsn1, $dsn2, $dsn3, $dsn4, $dsn5, $dsn_ba, $dsn7); 

$filename =$societe->SIREN(). $societe->NIC(). '_'. date('Y-m-d'). '_'. $numero;  

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='. $filename. '.dsn');

$output = fopen('php://output', 'w');

$ligne=0;
foreach( $data as $data_item ){
	fprintf( $output, $data_item[0]. ",". "'".  $data_item[1]. "'". PHP_EOL);
	$ligne++;
}
	/* ## S90.G00.90 - TOTAL DE L'ENVOI */

	fprintf( $output, "90.G00.90.001,'".  ($ligne+2). "'". PHP_EOL);
	fprintf( $output, "90.G00.90.002,'01'". PHP_EOL);
fclose( $output );
$salaire->odt_BdP($filename, $societe, $individu, $contact, $contrat, $urssaf); 
//print_r($salaire->BdP());
?>


