<?php
define('SITE_ROOT', __DIR__);
set_error_handler(function(int $number, string $message){
	echo '{"error":"Ошибка '.$number.': '.$message.'"}';
	exit;
});
if( empty( $_POST['phone'] ) ){
	echo '{"error":"No data"}';
	exit;
}
try{
	require_once("./Phone2Country.php");
	$p2c=new Phone2Country('./phone-codes.json');
	$_return=$p2c->setPhone(trim( $_POST['phone'], '+'))->getValue();
	if( !empty( $_return ) ){
		unset( $_return['pattern'] );
		unset( $_return['weght'] );
		$_return['phone']=$_POST['phone'];
		echo json_encode( $_return, JSON_FORCE_OBJECT );
	}else{
		echo '{"error":"Нет данных о номере."}';
	}
}catch (Exception $e){ // Executed only in PHP 7
	echo '{"error":"Exception: '.$e->getMessage().'"}';
}
?>