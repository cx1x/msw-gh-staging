<?

date_default_timezone_set("Europe/London");

include_once('_inc/function.php');
include_once('config.php');

$_dog_id = $_GET['doguid'];

if (!empty($_dog_id)) 
{
	$_dog_id = preg_replace("/[^0-9]/", "", $_dog_id);
}


$page = $_GET['page'];
$search = $_GET['search_text'];

$_dateParam = date("Y-m-d");
$_current_time = date("H:i:s");

$_next_race = json_decode(get_next_race($_dateParam, $_current_time));

$data = dog_race_history($_dog_id);


$_track_name_id = array(
				'1'   => 'Cryfd',
				'69'  => 'Harlow',
				'76'  => 'Kinsly',
				'6'   => 'Newc',
				'33'  => 'Notts',
				'62'  => 'PerB',
				'35'  => 'Poole',
				'34'  => 'Sheff',
				'70'  => 'Stgbrn',
				'61'  => 'Sland',
				'98'  => 'Towc',
				'18'  => 'Bvue',
				'17'  => 'HallG',
				'5'   => 'Hove',
				'25'  => 'Pbrgh',
				'11'  => 'Romfd',
				'39'  => 'Swndn',
				'16'  => 'Yrmth',
				'13'  => 'Hnlow',
				'4'   => 'Monmr',
				'9'   => 'Wdom',
				'66'  => 'Donc',
				'63'  => 'Mldhl',
				'86'  => 'Pelaw',
				'38'  => 'Shawf'
			);

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

			<div class="cd-main-content cd-dog-career">

        <div class="desk-logo"></div>
				<header class="container-fluid header-container head-orange">
				
					<div class="row">
					
						<div class="col-xs-4" id="back_div">
						

							<a href="<?php echo $folder ?>/search-result/<?php echo $page; ?>/<?php echo $search; ?>" data-type="page-transition">
							
								<strong class="head-title pull-left fs-14"><i class="fa fa-chevron-left fs-12"></i> BACK </strong>
							
							</a>

						</div>

							<?php
								if (!empty($data['notice'])) echo $data['notice'];
							?>

					</div>
					
				</header>

				<?php
					if (empty($data['notice']))
					{
				?>
				<div class="main-wrapper container-fluid ">
				
					<div class="row">

						<div class="dog-card-4 col-xs-12 no-pad">

							<!-- Tab panes -->
							<div class="dog-info tb-container">

								<div class="link-item race-meeting-2 dog-card col-xs-12">
								
									<div class="pull-left">
									
										<span><i class="dog-icon-28 num-<?php echo $data['dog_info']['trap']; ?>"></i><?php echo $data['dog_info']['dog_name']; ?></span>
										
									</div>
									
								</div>

								<div class="col-xs-12 pad-8 pedigree-info">
								
									<span class="pull-left">
									
										<p>Sire <strong><?php echo $data['dog_info']['detail']->sire_name; ?></strong></p>
										
										<p><strong>
											<?php echo $dog_color_attr[strtoupper($data['dog_info']['detail']->colour)]; ?> 
											<?php echo ($data['dog_info']['detail']->sex == 'd') ? " Dog" : " Bitch"; ?>
											</strong></p>
										
									</span>                  
									
									<span class="pull-right">
									
										<p>Dam <strong><?php echo $data['dog_info']['detail']->dam_name; ?></strong></p>
										
										<p><strong><?php echo $data['dog_info']['detail']->whelp; ?></strong></p>
										
									</span>
									
								</div>

								

								<div class="dog-card-tb">
								
									<div class="tb-row tb-titles bg-444">
									
										<div class="">LIFETIME FORM SINCE GBGB/IGB REGISTERED</div>
										
									</div>
									
									<div class="tb-row tb-titles">
									
										<div class="tb-date">Date</div>
										
										<div class="tb-track">Track</div>
										
										<div class="tb-dis">Dis</div>
										
										<div class="tb-trp">Trp</div>
										
										<div class="tb-split">Split</div>
										
										<div class="tb-fin">Fin</div>
										
										<div class="tb-sp">SP</div>
										
										<div class="tb-grade">Grade</div>
										
										<div class="tb-caltm">CalTm</div>
										
									</div> 

									<?
									
									foreach($data['dog_history'] as $key => $row) {


										$row['race_prop']->distance_meters = (!empty($row['race_prop']->distance_meters)) ? $row['race_prop']->distance_meters : "&nbsp;";
										$row['form_prop']->sectional_time = (!empty($row['form_prop']->sectional_time)) ? $row['form_prop']->sectional_time : "&nbsp;";
										$row['form_prop']->converted_odds = (!empty($row['form_prop']->converted_odds)) ? $row['form_prop']->converted_odds : "&nbsp;";
										$row['race_prop']->grade = (!empty($row['race_prop']->grade)) ? $row['race_prop']->grade : "&nbsp;";
										$row['form_prop']->calc_time = (!empty($row['form_prop']->calc_time)) ? $row['form_prop']->calc_time : "&nbsp;";
										$row['form_prop']->position = (!empty($row['form_prop']->position)) ? $row['form_prop']->position : "&nbsp;";

										echo '
											<div class="tb-row">
											
												<div class="tb-date"> '. date("dMy", strtotime($row['race_date'])) .' </div>
												
												<div class="tb-track">'. $_track_name_id[$row['track_name']] .'</div>
												
												<div class="tb-dis">'. $row['race_prop']->distance_meters .'m</div>

												<div class="tb-trp">['. $row['trap'] .']</div>

												<div class="tb-split">'. $row['form_prop']->sectional_time .'</div>

												<div class="tb-fin">'. $row['form_prop']->position .'</div>

												<div class="tb-sp">'. $row['form_prop']->converted_odds .'</div>

												<div class="tb-grade">'. $row['race_prop']->grade .'</div>

												<div class="tb-caltm">'. $row['form_prop']->calc_time .'</div>';
												
												
											echo '</div>
										';
									
									}
									
									?>
									
								</div>
								
							</div>

						</div>

					</div>

				</div>
				<?php
					}
				?>
				
				<footer class="container-fluid footer-container">

					<div class="row">

						<div class="col-xs-4">

							<a href="<?php echo $folder ?>/" data-type="page-transition"><span class="foot-icon-cards"></span>Cards</a>

						</div>

						<div class="col-xs-4">
						
							<a href="#myModal" data-toggle="modal" data-target="#myModal"><span class="foot-icon-results"></span>Results</a>
							
						</div>

						<div class="col-xs-4">
						
							<a href="<?php echo $folder ?>/card/<?=$_next_race->race_group;?>/<?=$_next_race->race_uid;?>/<?=$_dateParam;?>" data-type="page-transition"><span class="foot-icon-next"></span>Next Race</a>
							
						</div>

					</div>
					
				</footer>
					
				<!-- Modal -->
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
							
								<a class="btn btn-default glyphicon glyphicon-ok" data-dismiss="modal" href="/result/" data-type="page-transition" id="selectDate"></a>
								
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

			$( "#back_div" ).click(function() {
				  //alert( $("#dog-search-text").val() );
				  //alert('dog back');
				  window.location.href = "<?php echo $folder ?>/search-result/<?php echo $page; ?>/<?php echo $search; ?>";
			});
			
		</script>
		
	</body>
	
</html>