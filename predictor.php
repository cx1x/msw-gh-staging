<?
date_default_timezone_set("Europe/London");

include_once('_inc/function.php');
include_once('config.php');

$_group = $_GET['group'];

$_raceid = $_GET['race'];

$_date = $_GET['date'];

$_datas = json_decode(predict($_raceid,$_date));


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MSW Greyhounds</title>

    <!-- Bootstrap -->

		<!-- Bootstrap -->
		<link href="<?=$folder;?>/css/bootstrap.min.css" rel="stylesheet">

		<link rel="stylesheet" href="<?=$folder;?>/css/reset.css"> <!-- CSS reset -->

		<link rel="stylesheet" href="<?=$folder;?>/css/style-anim.css"> <!-- Resource style -->

		<script src="<?=$folder;?>/js/modernizr.js"></script> <!-- Modernizr -->

		<link href="<?=$folder;?>/css/font-awesome.min.css" rel="stylesheet">

		<link href="<?=$folder;?>/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

		<main>

			<div class="cd-main-content cd-predictor">
      
      <div class="desk-logo"></div>
      <header class="container-fluid header-container">
      <div class="row">
       <?
		foreach($_datas AS $_fdate => $_fArray){
		?>  
      <?
		foreach($_fArray AS $_name => $_gArray){
		foreach($_gArray AS $_raceTime => $_tArray){
	  ?>
        
        <div class="col-xs-4">
          <strong class="head-title pull-left fs-14"></strong>
        </div>
		
        <div class="col-xs-4 text-center">
          <strong class="head-title fs-14"><?= $_name ?> <?=date('H:i', strtotime($_raceTime ));?></strong>
        </div>
       

		<div class="col-xs-4 text-center">
			
			<a href="<?php echo $folder; ?>/card/<?= $_group ?>/<?= $_raceid ?>/<?= $_fdate ?>" data-type="page-transition">


				<strong class="head-title pull-right fs-14">DONE</strong>
				
			</a>

		</div>

      </div>
    </header>
    
    <div class="main-wrapper container-fluid ">
      <div class="row">
                
        <div class="predictor-container col-xs-12 no-pad">
          
          <ul class="list-unstyled">
		  <?
			
				foreach($_tArray AS $_dogs => $_sArray){
		  ?>
	      <li><div class="anim-cont"  style="left:calc(100% - <?= $_sArray->percent_predict?>%);"><div id="predictor-dog-<?= $_sArray->trap ?>"></div></div></li>
			<? } } } }?>
            
          </ul>
          
        </div>
        
      </div>
      
    </div>
    </div>
	</main>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?=$folder;?>/js/bootstrap.min.js"></script>
		
		<script src="<?=$folder;?>/js/main.js"></script> <!-- Resource jQuery -->
    
    <script>
   /*  $('.carousel').carousel({
      interval: false
    });  */
    
    $('#myTabs a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
    })
    
    // Predictor background if portrait or landscape
     $(window).on("resize", function() {  
      
        var screenHeight = $(window).height();
        var screenWidth = $(window).width();
            
          //Portrait
          if($(window).width() <= screenHeight) {
            $('.predictor-container').css('background-image', 'url(https://mswmedia.net/greyhoundbet/img/predictor-bg-port.png)');
          }
          //Landscape
          if($(window).height() <= screenWidth) {
            $('.predictor-container').css('background-image', 'url(https://mswmedia.net/greyhoundbet/img/predictor-bg.png)');
          }
        
      })
      .resize();
    </script>
  </body>
</html>