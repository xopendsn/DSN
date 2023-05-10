<?php
		
$societe = new ENTREPRISE(
	array(
		'RAISON'=>'societe',
		'SIREN'=>'123912483',
		'NIC'=>'00011',
		'APE'=>'7112B',
		'ADRESSE'=>"2 AVENUE DE PARIS",
		'CP'=>"6200",
		'VILLE'=>'SENLIS',
		'BIC'=>'CRLYFRPP',
		'IBAN'=>'FR3630002084330000123456796', 
		'INSEE'=>'60159',
		'PAYS'=>'FRANCE',
		'EFFECTIF'=>1, 
		'IDCC'=>'0650',
		'IDCC_LIBELLE'=>'CCN des ingénieurs et cadres de la métallurgie',
	)
); 

$contact = new CONTACT (
	array(
		'CIVILITE'=>'01',
		'PRENOM'=>'PIERRE',
		'NOM'=>'DUPONT',
		'TEL'=>'0768575677',
		'EMAIL'=>'contact@societe.fr'
	)
);
$individu=new INDIVIDU(
	array(
		'PRENOM'=>'PIERRE',
		'NOM' =>'DUPONT',
		'SEX'=>'01',
		'NSS_DATE'=>'1988-12-30',
		'NSS'=>'1881275678949',
		'NSS_VILLE'=>'PARIS',
		'NSS_DEPARTEMENT'=>'89',
		'NSS_PAYS'=>'FR',  
		'ADRESSE'=>'2 AVENUE DE PARIS',
		'CP'=>'60300',
		'VILLE'=>'SENLIS',
		'PAS'=>10,
		'IDPAS'=>'116662',
	)
);

$contrat=new CONTRAT(
	array(
		'ID'=>'G17001',
		'DATE'=>'2017-09-06', 
		'ATMP'=>'742CB',
		'TYPE'=>'MANDAT',
		'STATUT'=>'MANDATAIRE',
		'LIBELLE'=>'Mandataire social/Président',
	)
);

$urssaf=new URSSAF(
	array(
		'SIRET'=>'75366327700014', 
	)
);

$ruaa=new RUAA(
	array(
		'SIRET'=>'30558637200321', 
	)
);

$dgfip=new DGFIP(
	array(
		'SIRET'=>'DIFIP', 
		'ASSUJETTISSEMENT'=>['001', '007'], //Assujettissement à la taxe sur l'apprentissage Assujettissement à la participation à la formation professionnelle continue (FPC) 
		'NON_ASSUJETTISSEMENT'=>['004', '006', '010'],//Non assujettissement à à la contribution supplémentaire à l’apprentissage Non assujettissement à la participation des employeurs à l'effort de construction (PEEC) Non assujettissement à la taxe sur les salaires
	)
);
?>
