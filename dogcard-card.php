<?

date_default_timezone_set("Europe/London");

include_once('_inc/function.php');
include_once('config.php');

$_raceid = $_GET['race'];

$_date = $_GET['date'];

$_group = $_GET['group'];

$_dateParam = date("Y-m-d");

$_current_time = date("H:i:s");

$_next_race = json_decode(get_next_race($_dateParam, $_current_time));

$_datas = json_decode(runners($_raceid,$_date,$_group));

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

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>
	
	<body>

		<main>

			<div class="cd-main-content cd-card">
			
				<?
				
				foreach($_datas AS $_date => $_fArray){
				
					foreach($_fArray AS $_track => $_sArray){
					
						// print_r($_sArray->race_details);

						echo '<div class="desk-logo"></div>
            
            <header class="container-fluid header-container">

							<div class="row">
								
									<div class="col-xs-4">
							
										<a href="'. $folder .'/dogperf-track/' . $_sArray->race_details->track_uid . '/' . $_date . '/' . $_sArray->race_details->race_group  . '" data-type="page-transition">

											<strong class="head-title pull-left fs-14"><i class="fa fa-chevron-left fs-12"></i> ' . date('M j', strtotime($_date)) . '</strong>
								
										</a>

									</div>

								<div class="col-xs-4 text-center">

									<strong class="head-title fs-14">' . ucwords (strtolower ($_track)) . '</strong>

								</div>

								<div class="col-xs-4 text-center">
									
									<a href="'. $folder .'/predictor/' .$_sArray->race_details->race_group. '/' . $_sArray->race_details->race_id . '/' . $_date . '" data-type="page-transition">


										<strong class="head-title pull-right fs-14">Predictor</strong>
										
									</a>

								</div>

							</div>

						</header>';

					
					}
				
				}				
				
				?>
				
				<div class="main-wrapper container-fluid ">

					<div class="row">

						<div class="head-clock-wrapper">

							<div id="time-carousel" class="carousel slide" data-ride="carousel">
			
								<?
								
								foreach($_datas AS $_date => $_fArray){
								
									foreach($_fArray AS $_track => $_sArray){
								
										$_race_time = json_decode(race_time($_sArray->race_details->track_uid,$_date,$_group));
									
										echo '<ol class="carousel-indicators">';
								
											foreach($_race_time AS $_k => $_v){
											
												echo ($_v->race_uid == $_raceid) ? '<li data-target="'. $folder .'/card/'.$_group.'/'.$_v->race_uid.'/'.$_v->track_date.'" data-slide-to="0" class="active"></li>' : '<a href="'. $folder .'/card/'.$_group.'/'.$_v->race_uid.'/'.$_v->track_date.'" data-type="page-transition"><li data-target="'. $folder .'/card/'.$_group.'/'.$_v->race_uid.'/'.$_v->track_date.'" data-slide-to="0"></li></a>';
												
												// echo ($_v->race_uid == $_raceID) ? '<li data-target="/greyhoundbet/form/'.$_v->race_uid.'/'.$_v->track_date.'" data-slide-to="0" class="active"></li>' : '<a href="/result-card/'.$_trackID.'/'.$_v->race_uid.'/'.$_v->track_date.'" data-type="page-transition"><li data-target="/result-card/'.$_trackID.'/'.$_v->race_uid.'/'.$_v->track_date.'" data-slide-to="0"></li></a>';
												
											}
											
										echo '</ol>';
											
										echo '<div class="row">
											
												<div class="col-xs-offset-3 col-xs-6">
												
													<div class="carousel-inner">';
													
									
													foreach($_race_time AS $_k => $_v){
													
														echo ($_v->race_uid == $_raceid) ? '<div class="item active">' : '<div class="item">';
														
															echo '
																
																<div class="carousel-content">
															
																	<span>' . date('H:i', strtotime($_v->race_time)) . '</span>
																
																</div>
															
														</div>';
											
													}

													echo '
													
													</div>
													
												</div>
												
											</div>';
											
											foreach($_race_time AS $_k => $_v){
											
												if($_v->race_uid == $_raceid){
												
													if(get_next_raceid($_sArray->race_details->track_uid, $_v->race_time, $_v->track_date, 'less', $_group) == '#'){
													
														echo ' ';
														
													}
													else{
													
														echo '
														
														<a class="left carousel-control" href="'. $folder .'/card/' . $_group . '/'.get_next_raceid($_sArray->race_details->track_uid, $_v->race_time, $_v->track_date, 'less', $_group).'/'.$_v->track_date.'" data-slide="prev" data-type="page-transition">
														
															<span class="fa fa-chevron-left"></span>
															
														</a>';
													
													}
												
													if(get_next_raceid($_sArray->race_details->track_uid, $_v->race_time, $_v->track_date, 'greater', $_group) == '#'){
													
														echo '';
														
													}
													else{
													
														echo '
														
														<a class="right carousel-control" href="'. $folder .'/card/' . $_group . '/'.get_next_raceid($_sArray->race_details->track_uid, $_v->race_time, $_v->track_date, 'greater', $_group).'/'.$_v->track_date.'" data-slide="next" data-type="page-transition">
														
															<span class="fa fa-chevron-right"></span>
															
														</a>
														
														';
													
													}
												
												}
											
											}
									
									}
								
								}
								
								?>

							</div>
							
						</div>

						<div class="meeting-group dog-cards col-xs-12 no-pad">

							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
							
								<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Card</a></li>
								
								<li role="presentation"><a href="<?php echo $folder; ?>/form/<?=$_group;?>/<?=$_raceid;?>/<?=$_date;?>" data-type="page-transition">Form</a></li>
								
								<li role="presentation"><a href="<?php echo $folder; ?>/stats/<?=$_group;?>/<?=$_raceid;?>/<?=$_date;?>" data-type="page-transition">Stats</a></li>
								
								<li role="presentation"><a href="<?php echo $folder; ?>/tips/<?=$_group;?>/<?=$_raceid;?>/<?=$_date;?>" data-type="page-transition" style="margin-right: 0px;">TIPS</a></li>
								
							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
							
								<div role="tabpanel" class="tab-pane fade in active" id="home">

								<?
								
								foreach($_datas AS $_date => $_fArray){
								
									foreach($_fArray AS $_track => $_sArray){
									
										foreach($_sArray->runners AS $_runnerId=> $_tArray){
										
											$_props = json_decode($_tArray->runner_props);
										
											// print_r($_tArray);
											
											echo '
												<a href="'. $folder .'/dogs/' . preg_replace('/\s+/', '', $_track) . '/' . $_raceid . '/' . $_date . '/' . $_runnerId . '" data-type="page-transition">
												
													<div class="link-item race-meeting-2 dog-card col-xs-12">
													
														<div class="pull-left">
														
															<span><i class="dog-icon-28 num-' . $_tArray->trap . '"></i>' . $_tArray->dog_name . '</span>
															
														</div>
														
														<div class="pull-right">
														
															
															
														</div>
														
													</div>

													<div class="dog-card-expand col-xs-12">
													
														<i>' . $_tArray->comment . '</i>
														
														<div class="pull-left">
														
															<span><b>Form: </b>' . $_props->last5runs . '</span>
															
															<span><b>SP Forecast: </b>' . $_props->converted_odds . '</span>
															
														</div>
														
														<div class="pull-right">
														
															<span><b>Tnr: </b>' . $_props->trainer_name . '</span>
															
															<span><b>Topspeed: </b>' . $_props->rating . '</span>
															
														</div>
														
													</div>
													
												</a>
												
											';
										
										}
									
									}
									
								}
								
								?>

								</div>

								<div role="tabpanel" class="tab-pane fade" id="profile">..22222.</div>
								
								<div role="tabpanel" class="tab-pane fade" id="messages">.333333..</div>
								
								<div role="tabpanel" class="tab-pane fade" id="settings">.44444..</div>
								
							</div>

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

		<script>
		
			$('.carousel').carousel({
			
				interval: false
				
			}); 

			$('#myTabs a').click(function (e) {
			
				e.preventDefault()
				
				$(this).tab('show')
				
			})  
			
		</script>
		
	</body>
	
</html>