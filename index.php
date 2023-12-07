<?php
// подготовка к выполнению, уточнения по ТЗ - 2 часа
// задание 1) - затраченное время 1.5 часа
// задание 2) - затраченное время 1 час
// задание 3) - затраченное время 5 часов

define('SITE_ROOT', __DIR__);
set_error_handler(function(int $number, string $message){
	echo "Ошибка $number: '$message'".PHP_EOL;
});

try{
	require_once("./Phone2Country.php");
	$p2c=new Phone2Country('./phone-codes.json');

?><!doctype html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Viachaslau Slepau">
    <title>Тестовое задание</title>
    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<style type="text/css">
@import url("https://fonts.googleapis.com/css?family=Nunito:400,700");
* {
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}
html, body{
	padding: 20px 0px;
	height: 100%;
}

block-task{
	position: relative;
	width:100%;
}

.block-task{
	min-height: 530px;
}

.block-task .content{
	margin-top: 218px;
	margin-left: 165px;
}

.block-task .h2{
	letter-spacing: 0;
	color: #ffffff;
	font-family: "Nunito", Helvetica;
	font-size: 40px;
	font-style: normal;
	font-weight: 700;
	line-height: 150%;
}

.block-task .btn{
	margin-top: 37px;
	width: 260px;
	height: 48px;
	flex-shrink: 0;
	border-radius: 4px;
	background: #78599C;
	font-family: "Nunito", Helvetica;
	color: #ffffff;
	font-size: 16px;
	font-style: normal;
	font-weight: 400;
	line-height: 150%;
}

.block-task .container{
	max-width: 1920px;
}

.block-task .container, .block-task .col{
	padding:0;
	position: relative;
}

.block-task .bg-row{
	position: relative;
	width:100%;
	height:100%;
	margin:0;
}

.block-task .row{
	position: absolute;
	width:100%;
	height:100%;
}

.block-task .background{
	position: relative;
	background: url(./img/background.png);
	background-size: contain;
	background-position: right 0px top 0px;
	background-repeat: no-repeat;
	min-height: 530px;
	width:100%;
}

@media (max-width: 1919px) {
	.block-task .content{
		margin-top: 20%;
		margin-left: 15%;
	}
}
@media (max-width: 1279px) {
	.block-task .content{
		margin-top: 10%;
		margin-left: 15%;
	}
}
@media (max-width: 991px) {

	.block-task .background{
		position: relative;
		background: url(./img/background-m.png);
		background-size: cover;
		background-position: right 0px top 0px;
		background-repeat: no-repeat;
		min-height:1062px;
		min-width:991px;
	}

	.block-task .h2{
		font-size: 40px;
		max-width:100%;
	}
	
	.block-task .btn{
		margin-top: 16px;
		max-width: 100%;
		height: 40px;
	}
	
	.block-task .content{
		margin-top: 650px;
		margin-left: 10%;
	}
	
	.block-task .row {
		position: absolute;
		width: 80%;
		height: 100%;
	}
}
</style>

<style type="text/css">
.modal-dialog {
	position:fixed;
	top:auto;
	right:auto;
	left:auto;
	bottom:0;
}
@media (max-width: 991px) {
	.modal-dialog {
		right:0;
	}
}
</style>

</head>

<body class="bg-light">

<section class="phone-task">
	<div class="container">
		<div class="row justify-content-md-center gy-5">
			<div class="col col-md-auto">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
					<span class="text-primary">Определение номера</span>
				</h4>
				<ul class="list-group mb-3" id="addAjaxPhone">
					<li class="list-group-item d-flex justify-content-between lh-sm">
						<div>
							<h6 class="my-0">+375(29)123-45-67</h6>
						</div>
						<span class="text-muted"><?php echo( $p2c->setPhone(trim( "+375(29)123-45-67", '+'))->getValue('name_ru') ); ?></span>
					</li>
					<li class="list-group-item d-flex justify-content-between lh-sm">
						<div>
							<h6 class="my-0">+7 (495) 123 45 67</h6>
						</div>
						<span class="text-muted"><?php echo( $p2c->setPhone(trim( "+7 (495) 123 45 67", '+'))->getValue('name_ru') ); ?></span>
					</li>
					<li class="list-group-item d-flex justify-content-between lh-sm">
						<div>
							<h6 class="my-0">7 777 123-45-67</h6>
						</div>
						<span class="text-muted"><?php echo( $p2c->setPhone(trim( "7 777 123-45-67", '+'))->getValue('name_ru') ); ?></span>
					</li>
				</ul>
				<form class="card p-2" id="getPhone2Country">
					<div class="input-group">
						<input type="text" class="form-control" id="phoneNumber" name="phone" placeholder="Номер телефона">
						<button type="submit" class="btn btn-secondary">Получить страну</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<section class="block-task">
	<div class="container">
		<div class="row bg-row">
			<div class="col col-lg-1"></div>
			<div class="col col-lg-11 col-md-12 col-sm-12 col-12">
				<div class="background"></div>
			</div>
		</div>
		<div class="row row-content">
			<div class="col col-lg-1 d-none d-lg-block d-md-none"></div>
			<div class="col col-lg-5 col-sm-12 col-12 ">
				<div class="content container">
					<div class="row">
						<div class="col col-12">
							<h2 class="h2">Wysyłamy paczki pod klucz już od 4,5 zł.</h2>
							<button class="btn">Uzyskaj konsultację teraz</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col col-lg-6"></div>
		</div>
	</div>
</section>

<div class="modal fade bs-example-modal-lg" role="dialog" id="cookieModal">
	<div class="modal-dialog">  
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<p>На сайте используются файлы cookie</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="OK" id="buttonModal">Хорошо</button>
			</div>
		</div>
	</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script type="text/javascript">// блок ajax для задания 1
$(document).ready(function() {
	$('#getPhone2Country').submit(function(e) {
		e.preventDefault();
		$.ajax({
			type: "POST",
			url: 'ajax.php',
			data: $(this).serialize(),
			success: function(response){
				var jsonData=JSON.parse(response);
				if(typeof jsonData.error !== 'undefined'){
					alert( 'Этот номер нельзя использовать!' );
					console.log( jsonData.error );
				}else{
					$('#addAjaxPhone').append('<li class="list-group-item d-flex justify-content-between lh-sm"><div><h6 class="my-0">'+jsonData.phone+'</h6></div><span class="text-muted">'+jsonData.name_ru+'</span></li>');
				}
			}
		});
	});
});
</script>

<script type="text/javascript">// блок для задания 2
function getCookie(name){
	var matches=document.cookie.match(new RegExp("(?:^|; )"+name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g,"\\$1")+"=([^;]*)"));
	return matches?decodeURIComponent(matches[1]):undefined;
}
var popupShow=getCookie("popupShow");
if( popupShow==null && popupShow!='yes' ){
	var modal = new bootstrap.Modal('#cookieModal');
	modal.show();
	var myModalElement = document.getElementById('cookieModal');
	var myModalButton = document.getElementById('buttonModal');
	var date=new Date();
	myModalElement.addEventListener('hide.bs.modal', function (event) {
		date.setMilliseconds(24*60*60*1000); // 24 часа до следующего показа попапа
		document.cookie="popupShow=yes;path=/;expires="+date.toUTCString();
	});
	myModalButton.addEventListener('click', function (event) {
		modal.hide();
		date.setMilliseconds(400*24*60*60*1000); // максимальное значение для текущих браузеров
		document.cookie="popupShow=no;path=/;expires="+date.toUTCString();
	});
}
</script>
</body>
</html>
<?php
}catch (Exception $e){ // Executed only in PHP 7
	echo "Exception: ".$e->getMessage().PHP_EOL;
}
?>