<?php
function BDD($db){
$list=array(
	'127.0.0.1',
	'::1', 
	'192.168.1.23',
	'192.168.43.172'
);

	if(in_array($_SERVER['REMOTE_ADDR'], $list)){
	    return $mysqli=new mysqli('localhost', 'root', 'password', $db);
	}else{
	    return $mysqli=new mysqli('localhost', 'root', '', $db);
	}
}
function BDD_return($BDD, $SQL, $COLONNE="*")
{
	$index=0;
	$TABLEAU = array();
	$mysqli=BDD($BDD);
	$mysqli->set_charset("utf8");
	$RESULT = mysqli_query($mysqli, $SQL) or die(mysqli_error($mysqli));
	
	if($COLONNE !='*'){
		while ($CODE = mysqli_fetch_array($RESULT) )
			{
			$TABLEAU[$index]=$CODE["$COLONNE"];
			$index = $index + 1;
			} 
		return $TABLEAU;
	}else{
		while ($CODE = mysqli_fetch_assoc($RESULT) )
			{
			$TABLEAU[$index]=$CODE;
			$index = $index + 1;
			} 
		return $TABLEAU;
	}
		mysqli_close();
} 

function BDD_access($BDD, $SQL, $END=true) {
	$conn=BDD($BDD);
	$conn->set_charset("utf8");
	if ($END==true){
		mysqli_query($conn, "SET SESSION sql_mode='';") or die(mysqli_error($conn));
		mysqli_query($conn, $SQL) or die(mysqli_error($conn));
		mysqli_close($conn);
		return 1; 
	}else{
		return $conn;
	}
}
function BDD_send ($BDD, $TABLE,$TABLEAU, $END=true)
{
	$i=1; 
	$SQL="INSERT INTO `" .$BDD['base_de_donnees']. "`.`". $TABLE. "`";
	
	$INDEX=" (`". $TABLEAU[0][0] . "`";
	$VALUES= " VALUES ('". $TABLEAU[1][0] . "'";
	while(!empty($TABLEAU[0][$i])){
		$INDEX=$INDEX. ", `". $TABLEAU[0][$i] . "`";
		$VALUES=$VALUES. ", '". $TABLEAU[1][$i] . "'";
	$i++;
	}
	$SQL=$SQL. $INDEX. ")". $VALUES. ");";

	$dbc = mysql_connect($BDD['serveur'], $BDD['login'], $BDD['password']) or die(mysql_error());
	mysql_select_db($BDD['base_de_donnees']) or die(mysql_error());

	mysql_query($SQL) or die(mysql_error());	
	if ($END==true){
		mysql_close();
	}
} 
?>
