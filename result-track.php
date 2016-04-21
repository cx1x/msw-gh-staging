<?

date_default_timezone_set("Europe/London");

include_once('_inc/function.php');
include_once('config.php');

$_date = $_GET['date'];

$_trackID= $_GET['track'];

$_dateLabel = date("M j", strtotime($_date));

$_dateParam = date("Y-m-d");

$_current_time = date("H:i:s");

$_next_race = json_decode(get_next_race($_dateParam, $_current_time));

$_datas = json_decode(result_races($_trackID, $_date));

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
		<link href="<?=$folder;?>/css/bootstrap.min.css" rel="stylesheet">

		<link rel="stylesheet" href="<?=$folder;?>/css/reset.css"> <!-- CSS reset -->

		<link rel="stylesheet" href="<?=$folder;?>/css/style-anim.css"> <!-- Resource style -->

		<script src="<?=$folder;?>/js/modernizr.js"></script> <!-- Modernizr -->

		<link href="<?=$folder;?>/css/font-awesome.min.css" rel="stylesheet">

		<link href="<?=$folder;?>/css/style.css" rel="stylesheet">

		<link href="<?=$folder;?>/css/bootstrap-datetimepicker.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>

	<body>

		<main>

			<div class="cd-main-content cd-result-track">
				<?
				foreach($_datas AS $_track => $_fArray){
				
				
				?>
        
        <div class="desk-logo"></div>
				<header class="container-fluid header-container head-orange">
				
					<div class="row">

						<div class="col-xs-4">
						
							<a href="<?php echo $folder; ?>/result/<?=$_date;?>" data-type="page-transition" style="color: #fff;">
						
								<strong class="head-title pull-left fs-14"><i class="fa fa-chevron-left fs-12"></i> <?=$_dateLabel;?></strong>
							
							</a>
							
						</div>

						<div class="col-xs-4 text-center">
						
							<strong class="head-title fs-14"><?=ucwords (strtolower ($_track));?></strong>
						
						</div>

					</div>
					
				</header>

				<div class="main-wrapper container-fluid ">
				
					<div class="row">

						<div class="meeting-group col-xs-12 no-pad">
						
							<?
							
							foreach($_fArray AS $_raceID => $_tArray){
							
								foreach($_tArray AS $_raceNum => $_sArray){
							
									$_raceProps = json_decode($_sArray->properties);
									$_forecastProps = json_decode($_sArray->forecast_properties);
									$_tricastProps = json_decode($_sArray->tricast_properties);
									$_top3 = json_decode($_sArray->top3);
										
									echo '<a href="'. $folder .'/result-card/' . $_trackID . '/' . $_raceID . '/' . $_date . '" data-type="page-transition" style="margin-top: 0.5%;">
									
										<div class="race-time-4 col-xs-2"><strong> ' . str_replace(".",":",$_sArray->race_time) . ' </strong></div>
										
										<div class="link-item race-meeting-4 col-xs-10">
										
											<span class="race-count-4">
											
												<div class="pull-left">';
												
										$_dist = '';
										
										foreach($_top3->$_raceID AS $_k => $_v){
											
											if(isset($_v->properties->distance)){
												$_dist .= $_v->properties->distance .', ';
											}
												
											switch($_v->final_position){
												case '1':
													$_position = '1st';
													break;
												case '2':
													$_position = '2nd';
													break;
												case '3':
													$_position = '3rd';
													break;
											
											}
											
											echo '
											
											<span>
											 
												<b>'. $_position . '</b>
												
												<div class="tx-4"><i class="dog-icon-16 num-' . $_v->trap . '"></i></div>
												
												<p class="tx-race-1st">' . $_v->dog_name . ' ' . $_v->properties->odds .'</p>
												
											</span>
											
											';
										
										}
										
											
										echo '		</div>
										
											</span>
											
											<span class="win-4">
											
												<font style="color:#FFF">
												
													<div class="tb-row">
													
														<span>
														
															<p> Win Time: </p> <b>' . $_raceProps->winnerstime_secs . '</b>
															
														</span>
														
														<span style="width:133px;">
														
															<p> Distance: </p> '.$_dist.'
															
														</span>
														
														
													</div>
													
												</font>
												
											</span>
											
											<i class="fa fa-chevron-right pull-right fs-14"></i>
											
										</div>
										
									</a>
									<div class ="race-fc">
							
										<div class="race-forecast-4 col-xs-2">
										
											<p> Forecast: </p> <b>(' . $_forecastProps[0]->trap1 . 'x' . $_forecastProps[0]->trap2 . ') £' . $_forecastProps[0]->value . '</b>
										
										</div>';
										
										if(isset($_tricastProps[0])){
										
											echo '  <div class="race-forecast-4 col-xs-2">
											
															<p> Tricast: </p> <b>(' . $_tricastProps[0]->trap1 . 'x' . $_tricastProps[0]->trap2 . ') £' . $_tricastProps[0]->value . '</b>
															
														</div>
														
													';
									
										}
										
										echo '</div>';
								
								}
							
							}
							
							?>

						</div>

					</div>
			
				</div>
        
				<footer class="container-fluid footer-container">

					<div class="row">

						<div class="col-xs-4">

							<a href="<?php echo $folder; ?>/" data-type="page-transition"><span class="foot-icon-cards"></span>Cards</a>

						</div>

						<div class="col-xs-4">
						
							<a href="#myModal" data-toggle="modal" data-target="#myModal"><span class="foot-icon-results"></span>Results</a>
							
						</div>

						<div class="col-xs-4">
						
							<a href="<?php echo $folder; ?>/card/<?=$_next_race->race_group;?>/<?=$_next_race->race_uid;?>/<?=$_dateParam;?>" data-type="page-transition"><span class="foot-icon-next"></span>Next Race</a>
							
						</div>

					</div>
					
				</footer>
				
				<?}?>
								
				<div id="myModal" class="modal fade" role="dialog">
							
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
						
							<div class="modal-header">
							
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							
							<h4 class="modal-title"></h4>
							
							</div>
							
							<div class="modal-body">
							
								<div id="datetimepicker12">
								
									<input type="text" style="display:none;" id="selectedDate"></input>
									
								</div>
								
							</div>
							
							<div class="modal-footer">
							
								<a class="btn btn-default glyphicon glyphicon-ok" data-dismiss="modal" href="<?php echo $folder; ?>/result/" data-type="page-transition" id="selectDate"></a>
								
							</div>
							
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

</body>
	
</html>