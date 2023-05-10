<?php 
include('fonctions.php');
$XOPENDSN='XOPENDSN';

class ENTREPRISE {
	private $RAISON;
	private $SIREN; 
	private $NIC; 
	private $APE; 
	private $ADRESSE;
	private $CP;
	private $VILLE;
	private $BIC; 
	private $IBAN; 
	private $INSEE; 
	private $PAYS; 
	private $EFFECTIF;
	private $IDCC; 
	private $IDCC_LIBELLE; 
	
	public function RAISON(){return $this->RAISON;}
	public function SIREN(){return $this->SIREN;}
	public function NIC(){return $this->NIC;}
	public function APE(){return $this->APE;}
	public function ADRESSE(){return $this->ADRESSE;}
	public function CP(){return $this->CP;}
	public function VILLE(){return $this->VILLE;}
	public function BIC(){return $this->BIC;}
	public function IBAN(){return $this->IBAN;}
	public function INSEE(){return $this->INSEE;}
	public function EFFECTIF(){return $this->EFFECTIF;}
	public function IDCC(){return $this->IDCC;}
	public function IDCC_LIBELLE(){return $this->IDCC_LIBELLE;}
	
	public function PAYS(){
		switch ($this->TYPE){
			case 'FR':
				return '01';
				break;
		}
	}

	public function __construct($array) {
		require(dirname(__FILE__) .'/_construct.php');
	}	
}

class CONTACT extends ENTREPRISE  {
	private $CIVILITE;
	private $PRENOM ; 
	private $NOM; 
	private $TEL; 
	private $EMAIL;
	
	public function CIVILITE(){return $this->CIVILITE;}
	public function PRENOM(){return $this->PRENOM;}
	public function NOM(){return $this->NOM;}
	public function TEL(){return $this->TEL;}
	public function EMAIL(){return $this->EMAIL;}
	
	public function __construct($array) {
		require(dirname(__FILE__) .'/_construct.php');
	}
}

class URSSAF {
	private $SIRET;	
	public function SIRET(){return $this->SIRET;}
	
	public function __construct($array) {
		require(dirname(__FILE__) .'/_construct.php');
	}
}
class RUAA {
	private $SIRET;
	public function SIRET(){return $this->SIRET;}
	
	public function __construct($array) {
		require(dirname(__FILE__) .'/_construct.php');
	}
}
class DGFIP {
	private $SIRET;
	private $ASSUJETTISSEMENT; 
	private $NON_ASSUJETTISSEMENT; 
	public function SIRET(){return $this->SIRET;}
	public function ASSUJETTISSEMENT(){return $this->ASSUJETTISSEMENT;}
	public function NON_ASSUJETTISSEMENT(){return $this->NON_ASSUJETTISSEMENT;}
	
	public function __construct($array) {
		require(dirname(__FILE__) .'/_construct.php');
	}
}

class CONTRAT {
	private $REGIME='200'; // Régime général COR : A utiliser dans la DSN 
	private $ID; 
	private $DATE;  
	private $ATMP; 
	private $TYPE; 
	private $STATUT;
	private $QUOTITE; 
	private $TEMPS; 
	private $UNITE; 
	private $PCS='382C'; 
	private $LIBELLE; 
	
	public function REGIME(){return $this->REGIME;}
	public function ID(){return $this->ID;}
	public function DATE(){return $this->DATE;}
	public function IDCC(){return $this->IDCC;}
	public function ATMP(){return $this->ATMP;}
	public function PCS(){return $this->PCS;}
	public function LIBELLE(){return $this->LIBELLE;}
	
	public function __construct($array) {
		require(dirname(__FILE__) .'/_construct.php');
	}
	
	public function TYPE(){
		switch ($this->TYPE){
			case 'CDI':
				return '01';
	   		case 'CDD':
	   			return '02'; 
   			case 'MANDAT': 
   				return '80';
		
		}
	}
	public function STATUT(){
		switch ($this->STATUT){
			case 'CADRE':
				return '01'; 
			case 'MANDATAIRE':
				return '03';
		}
	}
	public function RETRAITE(){
		switch ($this->STATUT){
			case 'CADRE':
				return '01';
			case 'MANDATAIRE': 
				return '01';
		}
	}
	public function QUOTITE(){
		switch ($this->STATUT){
			case 'MANDATAIRE':
				return '99';
		}
	}
	public function TEMPS(){
		switch ($this->STATUT){
			case 'CADRE':
				return '18.00';
			case 'MANDATAIRE':
				return '18.00';
		}
	}
	public function UNITE(){
		switch ($this->STATUT){
			case 'CADRE':
				return '20'; // Forfait jour = '20' / Non concerné (mandataire 99))
			case 'MANDATAIRE': 
				return '99'; 
		}
	}
	public function classification(){
		switch ($this->STATUT){
			case 'CADRE':
				return 'CADRE'; // Forfait jour = '20' / Non concerné (mandataire 99))
			case 'MANDATAIRE': 
				return 'CADRE'; 
		} 
	}
	public function getTATMP(){
		global $XOPENDSN;
		$tatmp = BDD_return($XOPENDSN, "SELECT `PP` FROM `URSSAF` WHERE `CI`=45");
		return $tatmp[0]['PP']; 
	}
	
}

class INDIVIDU extends CONTRAT {
	private $PRENOM;
	private $NOM; 
	private $SEX; 
	private $NSS_DATE;
	private $NSS;
	private $NSS_VILLE; 
	private $NSS_DEPARTEMENT;
	private $NSS_PAYS;  
	private $ADRESSE;
	private $CP;
	private $VILLE;
	private $PAS; 
	private $IDPAS; 
	
	public function PRENOM(){return $this->PRENOM;}
	public function NOM(){return $this->NOM;}
	public function SEX(){return $this->SEX;}
	public function NSS_DATE(){return $this->NSS_DATE;}
	public function NSS(){return $this->NSS;}
	public function NSS_VILLE(){return $this->NSS_VILLE;}
	public function NSS_DEPARTEMENT(){return $this->NSS_DEPARTEMENT;}
	public function NSS_PAYS(){return $this->NSS_PAYS;}
	public function ADRESSE(){return $this->ADRESSE;}
	public function CP(){return $this->CP;}
	public function VILLE(){return $this->VILLE;}
	public function PAS(){return $this->PAS;}
	public function IDPAS(){return $this->IDPAS;}
	
	public function __construct($array) {
		require(dirname(__FILE__) .'/_construct.php');
	}
}

class SALAIRE{ // COR à completer des cumuls et des versements organisme (voir feuille de salaire)
	private $ID_SALAIRE;
	private $DATE; 
	private $BRUT; 
	private $NET;
	private $NETNET;  
	private $PMSS;
	private $T1;
	private $T2; 
	private $REGLEMENT; 
	
	public function ID_SALAIRE(){return $this->ID_SALAIRE;}
	public function DATE(){return $this->DATE;}
	public function BRUT(){return $this->BRUT;}
	public function NET(){return $this->NET;}
	public function NETNET(){return $this->NETNET;}
	public function PMSS(){return $this->PMSS;}
	public function T1(){return $this->T1;}
	public function T2(){return $this->T2;}
	public function REGLEMENT(){return $this->REGLEMENT;}
	
	public function setID_SALAIRE($id){$this->ID_SALAIRE=$id;}
	public function setDATE($id){$this->DATE=$id;}
	public function setBRUT($id){$this->BRUT=$id;}
	public function setNET($id){$this->NET=$id;}
	public function setNETNET($id){$this->NETNET=$id;}
	public function setPMSS($id){$this->PMSS=$id;}
	public function setT1($id){$this->T1=$id;}
	public function setT2($id){$this->T2=$id;}
	public function setREGLEMENT($id){$this->REGLEMENT=$id;}

	
	public function hydrate($date){
		global $XOPENDSN;
		$date = date('Y-m-d', strtotime($date)); 
		$donnees=BDD_return($XOPENDSN, "SELECT * FROM `SALAIRE` WHERE `date`='$date' ORDER BY `ID_SALAIRE` DESC;");
		require(dirname(__FILE__) .'/_hydrate.php');
	}
	
	public function add($pas){
		
		$pmss=$this->getPMSS(); 
		if($this->BRUT()<$pmss or $this->BRUT()==$pmss ){
			$this->PMSS=$this->BRUT(); 
			$this->T1=$this->BRUT(); 
			$this->T2=0; 
		}else{
			$this->PMSS=$pmss; 
			$this->T1=$pmss; 
			$this->T2=($this->BRUT()-$pmss); 
		}
		$this->NET=$this->getNET();
		$this->NETNET=$this->getNETNET($pas); 
	}
	
	public function store($date, $brut, $reglement, $pas){
		global $XOPENDSN;
		$this->DATE=date('Y-m-d', strtotime($date)); 
		$this->BRUT=$brut; 
		$this->REGLEMENT=$reglement; 
		$this->add($pas);
		require(dirname(__FILE__) .'/_prepare.php');
		if(!empty($this->BRUT())){
			BDD_access($XOPENDSN, "INSERT INTO `SALAIRE` ( `$keys` ) VALUES ( '$data' )", true);
		}
	
	}
	
	public function getPMSS(){
		global $XOPENDSN;
		$year = date('Y', strtotime($this->DATE())); 
		$pmss = BDD_return($XOPENDSN, "SELECT * FROM `PMSS` WHERE `ANNEE`=$year");
		return $pmss[0]['PMSS']; 
	}
	
	public function getCSGCRDS($type){
		global $XOPENDSN;
		$Y=date('Y', strtotime($this->DATE())); 
		$csg = BDD_return($XOPENDSN, "SELECT `$type` FROM `CSGCRDS` WHERE `ANNEE`= '$Y';");
		return $csg[0][$type]; 
	
	}
	
	public function getNET(){
		global $XOPENDSN;
		$urssaf = BDD_return($XOPENDSN, "SELECT ANY_VALUE(`CTP`), ANY_VALUE(SUM(`PS`)), ANY_VALUE(`BASE`) FROM `URSSAF` WHERE `PS` IS NOT NULL GROUP BY `CTP`, `BASE`");
		$MyURSSAF=0; 
		foreach ($urssaf as $data){
			if($data['ANY_VALUE(`BASE`)']=='3' && !($data['ANY_VALUE(`CTP`)']=='995' && strtotime('Y', $this->DATE()=='03')) ){ 		// Assiette brute déplafonnée
				$MyURSSAF=$MyURSSAF+
					round($data['ANY_VALUE(SUM(`PS`))']*$this->BRUT()/100, 2, PHP_ROUND_HALF_UP);
			}elseif($data['ANY_VALUE(`BASE`)']=='2'){	// Assiette brute plafonnée		
				$MyURSSAF=$MyURSSAF+
					round($data['ANY_VALUE(SUM(`PS`))']*$this->PMSS()/100, 2, PHP_ROUND_HALF_UP);
			}elseif($data['ANY_VALUE(`BASE`)']=='4'){	// Assiette de la contribution sociale généralisée		
				$MyURSSAF=$MyURSSAF+
					round($data['ANY_VALUE(SUM(`PS`))']*$this->BRUT()*0.9825/100, 2, PHP_ROUND_HALF_UP);
			}
		}
		$ruaa = BDD_return($XOPENDSN, "SELECT ANY_VALUE(SUM(`PS`)), ANY_VALUE(`BASE`) FROM `RUAA` WHERE `PS` IS NOT NULL GROUP BY `BASE`;");
		$MyRUAA=0; 
		foreach ($ruaa as $data){
			if($data['ANY_VALUE(`BASE`)']=='2'){ 			// Tranche 1 (jusqu’à 1 PMSS)
				$MyRUAA=$MyRUAA+
					round($data['ANY_VALUE(SUM(`PS`))']*$this->T1()/100, 2, PHP_ROUND_HALF_UP);
			}elseif($data['ANY_VALUE(`BASE`)']=='3'){		// Tranche 2 (de 1 PMSS jusqu'à 8 PMSS) 
				$MyRUAA=$MyRUAA+
					round($data['ANY_VALUE(SUM(`PS`))']*$this->T2()/100, 2, PHP_ROUND_HALF_UP);
			}
		}
		$NET=$this->BRUT()-$MyRUAA-$MyURSSAF;
		return $NET; 	
	}
	
	public function getBASE_FISCALE(){
		$csg=$this->getCSGCRDS('CSG'); 
		$crds=$this->getCSGCRDS('CRDS'); 
		return $this->getNET()+$this->BRUT()*0.9825*$csg/100+$this->BRUT()*0.9825*$crds/100;
	}
	
	public function getNETNET($pas){
		$NET_AVANTIRPP=$this->getNET(); // mOCHE; 
		$NET_VERSE=$NET_AVANTIRPP-$this->getBASE_FISCALE()*$pas/100; // COR PAS DE PARAMETTRE csg crds EN DURE
		return round($NET_VERSE, 2, PHP_ROUND_HALF_UP); 	
	}
		
	public function getRUAA(){
			global $XOPENDSN;
			$ruaa = BDD_return($XOPENDSN, "SELECT ANY_VALUE(SUM(`PS`))+ANY_VALUE(SUM(`PP`)), ANY_VALUE(`BASE`) FROM `RUAA` WHERE 1 GROUP BY `BASE`;");
			$MyRUAA=0; 
			foreach ($ruaa as $data){
				if($data['ANY_VALUE(`BASE`)']=='2'){ 			// Tranche 1 (jusqu’à 1 PMSS)
					$MyRUAA=$MyRUAA+
						round($data['ANY_VALUE(SUM(`PS`))+ANY_VALUE(SUM(`PP`))']*$this->T1()/100, 2, PHP_ROUND_HALF_UP);
				}elseif($data['ANY_VALUE(`BASE`)']=='3'){		// Tranche 2 (de 1 PMSS jusqu'à 8 PMSS) 
					$MyRUAA=$MyRUAA+
						round($data['ANY_VALUE(SUM(`PS`))+ANY_VALUE(SUM(`PP`))']*$this->T2()/100, 2, PHP_ROUND_HALF_UP);
				}
			}
			return $MyRUAA;	
	}
	public function getSUM($type){
		global $XOPENDSN;	
		$Y=date('Y', strtotime($this->DATE())); 
		$sum = BDD_return($XOPENDSN, "SELECT SUM(`$type`) FROM `SALAIRE` WHERE YEAR(`DATE`)= '$Y';");
		return $sum[0]['SUM(`'. $type. '`)'];
	}
	
	public function getDGFIP($pas, $round){
		return round($this->getBASE_FISCALE()*$pas/100, $round); 	
	}
	
	public function getAssiette($id){ // COR sns doute à linéraiser mais c'est le tableau en dure plus bas. 
		global $XOPENDSN;
		$data = BDD_return($XOPENDSN, "SELECT `ASSIETTE` FROM `URSSAF_BASE` WHERE `ID_URSSAF_BASE`=$id;");
		return $data[0]['ASSIETTE']; 
	}
	
	public function getURSSAF($type){
		global $XOPENDSN;
		$MyURSSAF=array(); 
		switch($type){
			case 'S21.G00.23':
				$urssaf = BDD_return($XOPENDSN, "SELECT ANY_VALUE(`CTP`), ANY_VALUE(SUM(`PS`)), ANY_VALUE(SUM(`PP`)), ANY_VALUE(`BASE`) FROM `URSSAF` WHERE 1 GROUP BY `CTP`, `BASE`");
				foreach ($urssaf as $data){

					if($data['ANY_VALUE(`BASE`)']=='3' && !($data['ANY_VALUE(`CTP`)']=='995' && strtotime('Y', $this->DATE()=='03')) ){ 		// Assiette brute déplafonnée
						$MyURSSAF[]=array(
							'BASE'=>$this->getAssiette($data['ANY_VALUE(`BASE`)']),
							'BASE_MONTANT'=>$this->BRUT(), 
							'CTP'=>$data['ANY_VALUE(`CTP`)'], 
							'TOTAL'=>round($data['ANY_VALUE(SUM(`PS`))']*$this->BRUT()/100, 2, PHP_ROUND_HALF_UP)+round($data['ANY_VALUE(SUM(`PP`))']*$this->BRUT()/100, 2, PHP_ROUND_HALF_UP),
						);
					}elseif($data['ANY_VALUE(`BASE`)']=='2'){	// Assiette brute plafonnée		
						$MyURSSAF[]=array(
							'BASE'=>$this->getAssiette($data['ANY_VALUE(`BASE`)']),
							'BASE_MONTANT'=>$this->PMSS(), 
							'CTP'=>$data['ANY_VALUE(`CTP`)'], 
							'TOTAL'=>round($data['ANY_VALUE(SUM(`PS`))']*$this->PMSS()/100, 2, PHP_ROUND_HALF_UP)+round($data['ANY_VALUE(SUM(`PP`))']*$this->PMSS()/100, 2, PHP_ROUND_HALF_UP),
						);
					}elseif($data['ANY_VALUE(`BASE`)']=='4'){	// Assiette de la contribution sociale généralisée		
						$MyURSSAF[]=array(
							'BASE'=>$this->getAssiette($data['ANY_VALUE(`BASE`)']),
							'BASE_MONTANT'=>$this->BRUT()*0.9825, 
							'CTP'=>$data['ANY_VALUE(`CTP`)'], 
							'TOTAL'=>round($data['ANY_VALUE(SUM(`PS`))']*$this->BRUT()*0.9825/100, 2, PHP_ROUND_HALF_UP)+ round($data['ANY_VALUE(SUM(`PP`))']*$this->BRUT()*0.9825/100, 2, PHP_ROUND_HALF_UP),
						);
					}
				}

				return $MyURSSAF;
				break;
			case 'S21.G00.20':
				$MyURSSAF[0]=0;
				$urssaf = BDD_return($XOPENDSN, "SELECT ANY_VALUE(`CTP`), ANY_VALUE(SUM(`PS`)), ANY_VALUE(SUM(`PP`)), ANY_VALUE(`BASE`) FROM `URSSAF` WHERE 1 GROUP BY `CTP`, `BASE`");
				foreach ($urssaf as $data){

					if($data['ANY_VALUE(`BASE`)']=='3' && !($data['ANY_VALUE(`CTP`)']=='995' && strtotime('Y', $this->DATE()=='03'))){ 		// Assiette brute déplafonnée
						$MyURSSAF[0]=$MyURSSAF[0]+ 
							(round($data['ANY_VALUE(SUM(`PS`))']*$this->BRUT()/100, 2, PHP_ROUND_HALF_UP)+round($data['ANY_VALUE(SUM(`PP`))']*$this->BRUT()/100, 2, PHP_ROUND_HALF_UP)
						);
					}elseif($data['ANY_VALUE(`BASE`)']=='2'){	// Assiette brute plafonnée		
						$MyURSSAF[0]=$MyURSSAF[0]+
							(round($data['ANY_VALUE(SUM(`PS`))']*$this->PMSS()/100, 2, PHP_ROUND_HALF_UP)+round($data['ANY_VALUE(SUM(`PP`))']*$this->PMSS()/100, 2, PHP_ROUND_HALF_UP)
						);
					}elseif($data['ANY_VALUE(`BASE`)']=='4'){	// Assiette de la contribution sociale généralisée		
						$MyURSSAF[0]=$MyURSSAF[0]+
							(round($data['ANY_VALUE(SUM(`PS`))']*$this->BRUT()*0.9825/100, 2, PHP_ROUND_HALF_UP)+ round($data['ANY_VALUE(SUM(`PP`))']*$this->BRUT()*0.9825/100, 2, PHP_ROUND_HALF_UP)
						);
					}
				}
				$MyURSSAF=round($MyURSSAF[0], 0);

				return $MyURSSAF;
				break; 
			case 'S21.G00.81':
				$urssaf = BDD_return($XOPENDSN, "SELECT ANY_VALUE(`CI`), ANY_VALUE(SUM(`PS`)), ANY_VALUE(SUM(`PP`)), ANY_VALUE(`BASE`) FROM `URSSAF` WHERE `CTP`<>'995' GROUP BY `CI`, `BASE`");// faux
				foreach ($urssaf as $data){

					if($data['ANY_VALUE(`BASE`)']=='3'){ 		// Assiette brute déplafonnée
						$MyURSSAF[]=array(
							'BASE'=>$data['ANY_VALUE(`BASE`)'],
							'BASE_MONTANT'=>$this->BRUT(), 
							'TAUX'=>round($data['ANY_VALUE(SUM(`PS`))'], 2, PHP_ROUND_HALF_UP)+round($data['ANY_VALUE(SUM(`PP`))'], 2, PHP_ROUND_HALF_UP), 
							'CI'=>$data['ANY_VALUE(`CI`)'], 
							'TOTAL'=>round($data['ANY_VALUE(SUM(`PS`))']*$this->BRUT()/100, 2, PHP_ROUND_HALF_UP)+round($data['ANY_VALUE(SUM(`PP`))']*$this->BRUT()/100, 2, PHP_ROUND_HALF_UP),
						);
					}elseif($data['ANY_VALUE(`BASE`)']=='2'){	// Assiette brute plafonnée		
						$MyURSSAF[]=array(
							'BASE'=>$data['ANY_VALUE(`BASE`)'],
							'BASE_MONTANT'=>$this->PMSS(), 
							'TAUX'=>round($data['ANY_VALUE(SUM(`PS`))'], 2, PHP_ROUND_HALF_UP)+round($data['ANY_VALUE(SUM(`PP`))'], 2, PHP_ROUND_HALF_UP),
							'CI'=>$data['ANY_VALUE(`CI`)'], 
							'TOTAL'=>round($data['ANY_VALUE(SUM(`PS`))']*$this->PMSS()/100, 2, PHP_ROUND_HALF_UP)+round($data['ANY_VALUE(SUM(`PP`))']*$this->PMSS()/100, 2, PHP_ROUND_HALF_UP),
						);
					}elseif($data['ANY_VALUE(`BASE`)']=='4'){	// Assiette de la contribution sociale généralisée		
						$MyURSSAF[]=array(
							'BASE'=>$data['ANY_VALUE(`BASE`)'],
							'BASE_MONTANT'=>$this->BRUT()*0.9825, 
							'TAUX'=>round($data['ANY_VALUE(SUM(`PS`))'], 2, PHP_ROUND_HALF_UP)+round($data['ANY_VALUE(SUM(`PP`))'], 2, PHP_ROUND_HALF_UP),
							'CI'=>$data['ANY_VALUE(`CI`)'], 
							'TOTAL'=>round($data['ANY_VALUE(SUM(`PS`))']*$this->BRUT()*0.9825/100, 2, PHP_ROUND_HALF_UP)+ round($data['ANY_VALUE(SUM(`PP`))']*$this->BRUT()*0.9825/100, 2, PHP_ROUND_HALF_UP),
						);
					}
				}
				return $MyURSSAF; 
				break;
			
			
			
			}
		}
		
	public function BdP(){
	
		global $XOPENDSN;
		$urssaf = BDD_return($XOPENDSN, "SELECT * FROM `URSSAF` JOIN `RUBRIQUE` ON `URSSAF`.`RUBRIQUE`=`RUBRIQUE`.`ID_RUBRIQUE` ORDER BY ID_RUBRIQUE ASC;");
		$MyURSSAF=array(); 
		foreach ($urssaf as $data){
			if($data['BASE']=='3' && !($data['CTP']=='995' && strtotime('Y', $this->DATE()=='03')) ){ 		// Assiette brute déplafonnée
				$MyURSSAF[]=array(
					'LIBELLE'=>$data['LIBELLE'], 
					'BASE'=>$this->BRUT(), 
					'PS'=>$data['PS'], 
					'PSM'=>round($data['PS']*$this->BRUT()/100, 2, PHP_ROUND_HALF_UP), 
					'PP'=>$data['PP'], 
					'PPM'=>round($data['PP']*$this->BRUT()/100, 2, PHP_ROUND_HALF_UP), 
					'RUBRIQUE'=>$data['RUBRIQUE'], 
					'ID'=>$data['ID_RUBRIQUE']);

			}elseif($data['BASE']=='2' & $this->PMSS()!=0){	// Assiette brute plafonnée
				$MyURSSAF[]=array(	
					'LIBELLE'=>$data['LIBELLE'], 
					'BASE'=>$this->PMSS(), 
					'PS'=>$data['PS'], 
					'PSM'=>round($data['PS']*$this->PMSS()/100, 2, PHP_ROUND_HALF_UP), 
					'PP'=>$data['PP'], 
					'PPM'=>round($data['PP']*$this->PMSS()/100, 2, PHP_ROUND_HALF_UP),
					'RUBRIQUE'=>$data['RUBRIQUE'], 
					'ID'=>$data['ID_RUBRIQUE']);	
			}elseif($data['BASE']=='4' & $this->BRUT()!=0){	// Assiette de la contribution sociale généralisée
				$MyURSSAF[]=array(
					'LIBELLE'=>$data['LIBELLE'], 
					'BASE'=>$this->BRUT()*0.9825, 
					'PS'=>$data['PS'], 
					'PSM'=>round($data['PS']*$this->BRUT()*0.9825/100, 2, PHP_ROUND_HALF_UP), 
					'PP'=>$data['PP'], 
					'PPM'=>round($data['PP']*$this->BRUT()/100, 2, PHP_ROUND_HALF_UP),
					'RUBRIQUE'=>$data['RUBRIQUE'], 
					'ID'=>$data['ID_RUBRIQUE']);
			}
		}
		$ruaa = BDD_return($XOPENDSN, "SELECT * FROM `RUAA` JOIN `RUBRIQUE` ON `RUAA`.`RUBRIQUE`=`RUBRIQUE`.`ID_RUBRIQUE` ORDER BY ID_RUBRIQUE ASC;");
		$MyRUAA=array(); 
		foreach ($ruaa as $data){
			if($data['BASE']=='2' && $this->T1()!=0){ 			// Tranche 1 (jusqu’à 1 PMSS)
				$MyRUAA[]=array(
					'LIBELLE'=>$data['LIBELLE'], 
					'BASE'=>$this->T1(), 
					'PS'=>$data['PS'], 
					'PSM'=>round($data['PS']*$this->T1()/100, 2, PHP_ROUND_HALF_UP), 
					'PP'=>$data['PP'], 
					'PPM'=>round($data['PP']*$this->T1()/100, 2, PHP_ROUND_HALF_UP),
					'RUBRIQUE'=>$data['RUBRIQUE'], 
					'ID'=>$data['ID_RUBRIQUE']);
			}elseif($data['BASE']=='3' && $this->T2()!=0){		// Tranche 2 (de 1 PMSS jusqu'à 8 PMSS) 
				$MyRUAA[]=array(
					'LIBELLE'=>$data['LIBELLE'], 
					'BASE'=>$this->T2(), 
					'PS'=>$data['PS'], 
					'PSM'=>round($data['PS']*$this->T2()/100, 2, PHP_ROUND_HALF_UP), 
					'PP'=>$data['PP'], 
					'PPM'=>round($data['PP']*$this->T2()/100, 2, PHP_ROUND_HALF_UP),
					'RUBRIQUE'=>$data['RUBRIQUE'], 
					'ID'=>$data['ID_RUBRIQUE']);
			}
		}
		$BdP = array_merge($MyURSSAF, $MyRUAA); 
		
		$ID  = array_column($BdP, 'ID');
		array_multisort($ID, SORT_ASC, $BdP);
		return $BdP;  
	
	} 		

	public function odt_BdP($filename, $acoucibe, $individu, $contact, $contrat, $urssaf){
		
		// Utilise la librairie Odf-PHP version 1.7 
		include('odt/library/Odf.php');
		$odf = new Odf("../odt/BdP.odt", array('ZIP_PROXY' => 'PhpZipProxy'));
		$BdP=$this->BdP();
		$i=0; $rub=0;
		$psmt=0; $ppmt=0; 
		$standard = $odf->setSegment('standard');
		while(!empty($BdP[$i])){
			if($i==0 || $BdP[$i]['ID']!=$rub){
				$standard->LigneLIBELLE('*.* '. $BdP[$i]['RUBRIQUE']. ' *.*', true, 'UTF8'); 
				$standard->LigneBASE('');
				$standard->LignePS('');
				$standard->LignePSM('');
				$standard->LignePP('');
				$standard->LignePPM('');
				$standard->merge();
				
			}
			
			
		
			$standard->LigneLIBELLE($BdP[$i]['LIBELLE'], true, 'UTF8'); 
			$standard->LigneBASE(number_format($BdP[$i]['BASE'], 2, '.', ''));
			if($BdP[$i]['PS']!=0){$standard->LignePS(number_format($BdP[$i]['PS'], 3, '.', ','). ' %');}else{$standard->LignePS('');}
			if($BdP[$i]['PSM']!=0){$standard->LignePSM('-'. number_format($BdP[$i]['PSM'], 2, '.', ''));}else{$standard->LignePSM('');}
			if($BdP[$i]['PP']!=0){$standard->LignePP(number_format($BdP[$i]['PP'], 3, '.', ','). ' %');}else{$standard->LignePP('');}
			if($BdP[$i]['PPM']!=0){$standard->LignePPM(number_format($BdP[$i]['PPM'], 2, '.', ''));}else{$standard->LignePPM('');}
			$standard->merge();

			$rub=$BdP[$i]['ID']; 
			$psmt=$psmt+$BdP[$i]['PSM'];
			$ppmt=$ppmt+$BdP[$i]['PPM']; 
			$i++;
			
		}
		$odf->mergeSegment($standard, true, 'UTF8');
		
		$odf->setVars('BRUT', number_format($this->BRUT(), 2, '.', ''). ' EUR', true, 'UTF8');
		$odf->setVars('NETVERSE', number_format($this->getNETNET(10), 2, '.', ''). ' EUR', true, 'UTF8');
		$odf->setVars('REGLEMENT', $this->REGLEMENT(), true, 'UTF8');
		$odf->setVars('DUDATE', date('d/m/Y', strtotime($this->DATE())), true, 'UTF8');
		$odf->setVars('AUDATE', date('t/m/Y', strtotime($this->DATE())), true, 'UTF8');
		$odf->setVars('AUDATE', date('t/m/Y', strtotime($this->DATE())), true, 'UTF8');
		$odf->setVars('NET_AVANTIRPP',number_format($this->getNET(), 2, '.', ''). ' EUR', true, 'UTF8');
		$odf->setVars('BASEFISCALE',number_format($this->getBASE_FISCALE(), 2, '.', ''). ' EUR', true, 'UTF8');
		$odf->setVars('PSMT',number_format($psmt, 2, '.', ''), true, 'UTF8');
		$odf->setVars('PPMT',number_format($ppmt, 2, '.', ''), true, 'UTF8');
		$odf->setVars('PASM',number_format($this->getDGFIP($individu->PAS(), 2), 2, '.', ''). ' EUR', true, 'UTF8');
		$odf->setVars('PBRUT',number_format($this->BRUT(), 2, '.', ''). ' EUR', true, 'UTF8');
		$odf->setVars('PNET',number_format($this->getBASE_FISCALE(), 2, '.', ''). ' EUR', true, 'UTF8');
		$odf->setVars('PAS',number_format($individu->PAS(), 2, '.', ''). ' %', true, 'UTF8');
		
		$odf->setVars('NSS',$individu->NSS(), true, 'UTF8');
		$odf->setVars('DATE',date('d/m/Y', strtotime($contrat->DATE())), true, 'UTF8');
		$odf->setVars('LIBELLE',$contrat->LIBELLE(), true, 'UTF8');
		$odf->setVars('STATUT',$contrat->classification(), true, 'UTF8');
		$odf->setVars('PCS',$contrat->PCS(), true, 'UTF8');
		$odf->setVars('IDCC',$acoucibe->IDCC(), true, 'UTF8');
		$odf->setVars('SIRETURSSAF',$urssaf->SIRET(), true, 'UTF8');
		$odf->setVars('SIRET',$acoucibe->SIREN(). $acoucibe->NIC(), true, 'UTF8');
		$odf->setVars('APE',$acoucibe->APE(), true, 'UTF8');
		
		$odf->setVars('PRENOM',$individu->PRENOM(), true, 'UTF8');
		$odf->setVars('NOM',$individu->NOM(), true, 'UTF8');
		$odf->setVars('ADRESSE',$individu->ADRESSE(), true, 'UTF8');
		$odf->setVars('CP',$individu->CP(), true, 'UTF8');
		$odf->setVars('VILLE',$individu->VILLE(), true, 'UTF8');
		$odf->setVars('ID',$contrat->ID(), true, 'UTF8');
		$odf->setVars('IDCC_LIBELLE',$acoucibe->IDCC_LIBELLE(), true, 'UTF8');
		$odf->setVars('CBRUT',number_format($this->getSUM('BRUT'), 2, '.', ''). ' EUR', true, 'UTF8');
		$odf->setVars('CNET',number_format($this->getSUM('NET'), 2, '.', ''). ' EUR', true, 'UTF8');
		
		// We export the file
		$odf->saveToDisk("PDF/$filename". ".odt");
	}
		
		
		
		
		
		
		
		
	

}

?>
