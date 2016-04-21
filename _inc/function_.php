<?
include_once('connection.php');


$dog_color_attr = array(
				'BK' => 'Black',
				'BKBE' => 'Black & Blue',
				'BKBD' => 'Black & Brindled',
				'BKW' => 'Black & White',
				'BE' => 'Blue',
				'BEBK' => 'Blue & Black',
				'BEBD' => 'Blue & Brindled',
				'BEF' => 'Blue & Fawn',
				'BEW' => 'Blue & White',
				'BEBDW' => 'Blue Brindled & White',
				'BD' => 'Brindled',
				'BDF' => 'Brindled & Fawn',
				'BDW' => 'Brindled & White',
				'DKBD' => 'Dark Brindled',
				'DKF' => 'Dark Fawn',
				'DN' => 'Dun',
				'F' => 'Fawn',
				'FBD' => 'Fawn & Brindled',
				'FW' => 'Fawn & White',
				'LTBD' => 'Light Brindled',
				'LTF' => 'Light Fawn',
				'RF' => 'Red & Fawn',
				'W' => 'White',
				'WBK' => 'White & Black',
				'WBE' => 'White & Blue',
				'WBD' => 'White & Brindled',
				'WDKBD' => 'White & Dark Brindled',
				'WF' => 'White & Fawn',
				'WBKBE' => 'White Black & Blue',
				'WBEBD' => 'White Blue & Brindled',
				'BKWBE' => 'Black White & Blue',
				'BEFW' => 'Blue & Fawn & White',
				'DKBDW' => 'Dark Brindled & White',
				'DUNW' => 'Dun & White',
				'LTFW' => 'Light Fawn & White',
				'RBD' => 'Red Brindle',
				'WBEF' => 'White & Blue & Fawn',
				'WDUN' => 'White and Dun',
				'WBKBE' => 'White & Black & Blue & Brindle',
				'WDN' => 'white&dun',
				'WLTF' => 'white&light fawn'
				);



function get_next_race($_track_date, $_current_time){

	$connect = mysqli_connector();
	
	$_card_raceTable = 'dog_cards_Race';
	
	$_q = 'SELECT race_uid, race_group, race_time FROM ' . $_card_raceTable . ' WHERE track_date = "'.$_track_date.'" AND race_time >= "'.$_current_time.'" ORDER BY race_time ASC LIMIT 1';
		
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		return json_encode($_row);
		
	}

}

function meeting($_track_date, $_viewby){

	$connect = mysqli_connector();
	
	$_meeting = array();

	$_card_meetingTable = 'dog_cards_Meeting';
	
	$_card_raceTable = 'dog_cards_Race';
	
	if($_viewby == 'list'){

		$_q = 'SELECT a.track_date, b.race_group, a.track, a.track_uid, a.id, b.race_uid, b.race_time, b.race_number, a.number_of_races,

		b.post_pick, b.properties, b.racegroup_type FROM ' . $_card_meetingTable . ' AS a 
		
		JOIN ' . $_card_raceTable . ' as b ON a.track_uid = b.track_uid 
		
		WHERE a.track_date = "' . $_track_date . '" AND b.track_date = "' . $_track_date . '" 
		
		ORDER BY tv DESC, race_group, b.race_time';
		
		$_result = $connect->query($_q);
		
		while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
		
			$_meeting[$_row['track_date']][$_row['race_group']][$_row['track']][] = array('track_uid' => $_row['track_uid'], 
																							
																							'id' => $_row['id'],
																							'track_uid' => $_row['track_uid'],
																							'race_uid' => $_row['race_uid'],
																							'race_time' => $_row['race_time'],
																							'race_number' => $_row['race_number'],
																							'number_of_races' => $_row['number_of_races'],
																							'post_pick' => $_row['post_pick'],
																							'properties' => $_row['properties'],
																							'racegroup_type' => $_row['racegroup_type'],
																							
																							);
		
		}
		
	}
	
	elseif($_viewby == 'time'){

		$_q = 'SELECT a.track_date, b.race_group, a.track, a.track_uid, a.id, b.race_uid, b.race_time, b.race_number, a.number_of_races,

		b.post_pick, b.properties, b.racegroup_type FROM ' . $_card_meetingTable . ' AS a 
		
		JOIN ' . $_card_raceTable . ' as b ON a.track_uid = b.track_uid 
		
		WHERE a.track_date = "' . $_track_date . '" AND b.track_date = "' . $_track_date . '" 
		
		ORDER BY b.race_time';
		
		$_result = $connect->query($_q);
		
		while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
		
			$_meeting[$_row['track_date']][] = array('track_uid' => $_row['track_uid'], 
																							
																							'id' => $_row['id'],
																							'race_group' => $_row['race_group'],
																							'track' => $_row['track'],
																							'track_uid' => $_row['track_uid'],
																							'race_uid' => $_row['race_uid'],
																							'race_time' => $_row['race_time'],
																							'race_number' => $_row['race_number'],
																							'number_of_races' => $_row['number_of_races'],
																							'post_pick' => $_row['post_pick'],
																							'properties' => $_row['properties'],
																							'racegroup_type' => $_row['racegroup_type'],
																							
																							);
		
		}
		
	}
	
	return json_encode($_meeting);
		
}

function races($_trackid,$_track_date,$_group){

	$connect = mysqli_connector();
	
	$_races = array();

	$_card_meetingTable = 'dog_cards_Meeting';
	
	$_card_raceTable = 'dog_cards_Race';

	$_q = 'SELECT a.track_date, b.race_group, a.track, a.track_uid, a.id, b.race_uid, b.race_time, b.race_number, a.number_of_races,

		b.post_pick, b.properties FROM ' . $_card_meetingTable . ' AS a 
		
		INNER JOIN ' . $_card_raceTable . ' as b ON a.track_uid = b.track_uid 
		
		WHERE a.track_date = "' . $_track_date . '" AND b.track_date = "' . $_track_date . '" AND b.track_uid = "' . $_trackid . '" AND b.race_group = "' . $_group . '" 
		
		ORDER BY b.race_time';
	
	$_result = $connect->query($_q);

	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
		
		$_races[$_row['track']][$_row['race_group']][$_row['race_number']] = array('track_uid' => $_row['track_uid'], 
																							
																							'id' => $_row['id'],
																							'race_group' => $_row['race_group'],
																							'track' => $_row['track'],
																							'track_uid' => $_row['track_uid'],
																							'race_uid' => $_row['race_uid'],
																							'race_time' => $_row['race_time'],
																							'race_number' => $_row['race_number'],
																							'number_of_races' => $_row['number_of_races'],
																							'post_pick' => $_row['post_pick'],
																							'properties' => $_row['properties'],
																							
																							);
	
	}
	
	return json_encode($_races);

}

function runners($_raceid, $_track_date){

	$connect = mysqli_connector();
	
	$_runners = array();

	$_card_meetingTable = 'dog_cards_Meeting';

	$_card_raceTable = 'dog_cards_Race';

	$_card_runnerTable = 'dog_cards_Runner';

	$_card_formTable = 'dog_cards_Form';

	$_q = 'SELECT c.track_date, c.track_uid, b.race_group, track, post_pick, race_number, a.dog_uid, trap, dog_name, comment, d.form_date, a.race_uid AS race_id, 
	
			b.properties AS race_props, a.properties AS runner_props FROM ' . $_card_runnerTable . ' 
	
			AS a JOIN ' . $_card_formTable . ' as d ON a.dog_uid = d.dog_uid JOIN ' . $_card_raceTable . ' 
			
			as b ON a.race_uid = b.race_uid JOIN ' . $_card_meetingTable . ' as c ON b.track_uid = c.track_uid 
			
			WHERE a.race_uid = "' . $_raceid . '" AND c.track_date = "' . $_track_date . '" AND d.comment != "null" AND d.form_date = "' . $_track_date . '"
			
			ORDER BY a.trap';
	
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		$_runners[$_row['track_date']][$_row['track']]['race_details'] = array('track_uid' => $_row['track_uid'], 'race_group' => $_row['race_group']
																				, 'post_pick' => $_row['post_pick'], 'race_number' => $_row['race_number']
																			, 'race_id' => $_row['race_id'], 'race_props' => $_row['race_props']);
																				
		$_runners[$_row['track_date']][$_row['track']]['runners'][$_row['dog_uid']] = array('trap' => $_row['trap'], 'dog_name' => $_row['dog_name']
																								, 'runner_props' => $_row['runner_props'], 'comment' => $_row['comment']);
	
	}
	
	return json_encode($_runners);

}

function race_lists($_raceid, $_track_date){

	$connect = mysqli_connector();
	
	$_race_lists = array();

	$_card_meetingTable = 'dog_cards_Meeting';

	$_card_raceTable = 'dog_cards_Race';

	$_card_runnerTable = 'dog_cards_Runner';

	$_card_formTable = 'dog_cards_Form';

	$_q = 'SELECT c.track_date, c.track_uid, b.race_group, c.track_uid, track, post_pick, race_number, a.dog_uid, trap, dog_name, form_date, form_properties, 
	
			b.properties AS race_props, a.properties AS runner_props FROM ' . $_card_runnerTable . ' 
	
			AS a JOIN ' . $_card_formTable . ' as d ON a.dog_uid = d.dog_uid JOIN ' . $_card_raceTable . ' 
			
			as b ON a.race_uid = b.race_uid JOIN ' . $_card_meetingTable . ' as c ON b.track_uid = c.track_uid 
			
			WHERE a.race_uid = "' . $_raceid . '" AND c.track_date = "' . $_track_date . '" AND d.form_properties != "null" 
			
			ORDER BY a.trap, d.form_date DESC';
	
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		$_race_lists[$_row['track_date']][$_row['track']]['race_details'] = array('track_uid' => $_row['track_uid'], 'race_group' => $_row['race_group']
																				,'post_pick' => $_row['post_pick'], 'race_number' => $_row['race_number']
																				,'race_number' => $_row['race_number'], 'race_props' => $_row['race_props']);
																				
		$_race_lists[$_row['track_date']][$_row['track']]['runners'][$_row['dog_uid']]['details'] = array('trap' => $_row['trap'], 'dog_name' => $_row['dog_name']
																								, 'runner_props' => $_row['runner_props']);
																				
		$_race_lists[$_row['track_date']][$_row['track']]['runners'][$_row['dog_uid']]['recent_race'][$_row['form_date']] = array('form_properties' => $_row['form_properties']);
	
	}
	
	return json_encode($_race_lists);

}

function race_time($_track_uid, $_track_date, $_group){

	$connect = mysqli_connector();
	
	$_race_time = array();

	$_card_raceTable = 'dog_cards_Race';
	
	$_q = 'SELECT race_uid, track_date, race_time FROM ' . $_card_raceTable . ' WHERE track_uid="' . $_track_uid . '" AND track_date="' . $_track_date . '" AND race_group="' . $_group . '"';
	
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		$_race_time[] = array('race_uid' => $_row['race_uid'], 'track_date' => $_row['track_date'], 'race_time' => $_row['race_time']);
	
	}

	return json_encode($_race_time);
}

function get_next_raceid($_track_uid, $_racetime, $_track_date, $_except, $_group){

	$connect = mysqli_connector();
	
	$_race_time = array();

	$_card_raceTable = 'dog_cards_Race';
	
	if($_except == 'less')
		$_q = 'SELECT race_uid FROM ' . $_card_raceTable . ' WHERE track_uid="' . $_track_uid . '" AND track_date="' . $_track_date . '" AND race_time < "'.$_racetime.'" AND race_group="' . $_group . '" ORDER BY race_number DESC LIMIT 1';
	
	elseif($_except == 'greater')
		$_q = 'SELECT race_uid FROM ' . $_card_raceTable . ' WHERE track_uid="' . $_track_uid . '" AND track_date="' . $_track_date . '" AND race_time > "'.$_racetime.'" AND race_group="' . $_group . '" LIMIT 1';
		
	$_result = $connect->query($_q);
	
	if($_result->num_rows==0){
	
		return '#';
	
	}
	
	else{
		
		while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
			return $_row['race_uid'];
		
		}
	
	}

}

function get_race_tips($_track_id, $_track_date, $_race_id, $_group){

	$connect = mysqli_connector();
	
	$_races_pick = array();
	
	$_card_raceTable = 'dog_cards_Race';
	
	$_card_runnerTable = 'dog_cards_Runner';

	$_q = 'SELECT a.race_uid, a.race_time, a.post_pick, b.dog_name, b.trap
	
		FROM ' . $_card_raceTable . ' AS a JOIN ' . $_card_runnerTable . ' AS b ON a.race_uid = b.race_uid
		
		WHERE a.track_date = "' . $_track_date . '" AND a.track_uid = "' . $_track_id . '" AND a.race_group = "' . $_group . '" 
		
		ORDER BY a.race_time';
		
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		if(substr($_row['post_pick'], 0, 1) == $_row['trap']){
		
			if($_race_id == $_row['race_uid']){
	
			$_races_pick[$_row['race_uid']][$_row['race_time']]['current_race'] = array('dog_name' => $_row['dog_name'], 'post_pick' => explode("-",substr($_row['post_pick'], 0, 5)),
			
																		'selection' => substr($_row['post_pick'], 0, 1));
			}
			else{

			$_races_pick[$_row['race_uid']][$_row['race_time']]['other_race'] = array('dog_name' => $_row['dog_name'], 'post_pick' => explode("-",substr($_row['post_pick'], 0, 5)),
			
																		'selection' => substr($_row['post_pick'], 0, 1));
			
			}			
		
		}
	
	}
	
	return json_encode($_races_pick);

}

function get_stats($_race_id, $_track_date, $_track){

	$connect = mysqli_connector();
	
	$_stats = array();
	
	$_performance_runnerTable = 'dog_performance_Runner';
	
	$_trapStatsTable = 'trap_stats_Table';
	
	$_q = "SELECT race_uid, dog_uid, trap, wins, runs, trap_wins,
			
			trap_runs, grade_wins, grade_runs, 
			
			(SELECT MAX(runs) FROM ". $_performance_runnerTable ." WHERE race_uid = '" . $_race_id . "') AS high_runs, 		
			
			(SELECT MAX(trap_runs) FROM ". $_performance_runnerTable ." WHERE race_uid = '" . $_race_id . "') AS high_trap_runs, 	
			
			(SELECT MAX(grade_runs) FROM ". $_performance_runnerTable ." WHERE race_uid = '" . $_race_id . "') AS high_grade_runs
			
			FROM ". $_performance_runnerTable ." WHERE race_uid = '" . $_race_id . "' ORDER BY trap ASC";
	
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		$_stats['perf'][$_row['race_uid']][$_row['trap']] = array('dog_uid' => $_row['dog_uid'], 'wins' => $_row['wins'],
		
																	'runs' => $_row['runs'], 'trap_wins' => $_row['trap_wins'],
																	
																	'trap_runs' => $_row['trap_runs'], 'grade_wins' => $_row['grade_wins'],
																	
																	'grade_runs' => $_row['grade_runs'], 'high_runs' => $_row['high_runs'], 
																	
																	'high_trap_runs' => $_row['high_trap_runs'], 'high_grade_runs' => $_row['high_grade_runs'] 		
		
																	);
	
	}
	
	$_q = "SELECT TrapStats_Recently, TrapStats_Recently_total_races FROM ". $_trapStatsTable ." WHERE track_date = '" . $_track_date . "' AND track = '" . $_track . "'";
	
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		$_stats['stats'] = array('trap_stats' => $_row['TrapStats_Recently'], 'TrapStats_Recently_total_races' => $_row['TrapStats_Recently_total_races']);
	
	}
	
	return json_encode($_stats);

}

function dog_details($_race_id, $_track_date, $_dog_id){

	$connect = mysqli_connector();
	
	$_dogs = array();
	
	$_performance_runnerTable = 'dog_performance_Runner';
	
	$_card_runnerTable = 'dog_cards_Runner';

	$_card_formTable = 'dog_cards_Form';
	
	$_card_raceTable = 'dog_cards_Race';
	
	$_q = "SELECT c.dog_name, c.trap, c.properties, c.dog_uid, b.wins, b.runs, b.trap_wins, b.trap_runs,
	
			b.grade_wins, b.grade_runs, a.form_date, a.form_properties, d.race_time, d.race_group, d.properties AS race_props, d.track_uid
			
			FROM " . $_card_formTable . " AS a LEFT JOIN " . $_performance_runnerTable . " AS b ON a.dog_uid = b.dog_uid LEFT JOIN " . $_card_runnerTable . " AS c ON b.dog_uid = c.dog_uid LEFT JOIN " . $_card_raceTable . " AS d ON c.race_uid = d.race_uid
			
			WHERE c.race_uid = '".$_race_id."' AND c.dog_uid = '".$_dog_id."' AND a.form_properties != 'null' AND a.dog_uid ='".$_dog_id."' AND b.dog_uid ='".$_dog_id."'  AND b.race_uid ='".$_race_id."' 
			
			ORDER BY a.form_date DESC";
			
	// echo ($_q);
	
	// exit;
			
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		$_dogs['dog_details'] = array('dog_name' => $_row['dog_name'], 'trap' => $_row['trap'],
										'dog_uid' => $_row['dog_uid'], 'wins' => $_row['wins'],
										'runs' => $_row['runs'], 'trap_wins' => $_row['trap_wins'],
										'trap_runs' => $_row['trap_runs'], 'grade_wins' => $_row['grade_wins'],
										'grade_runs' => $_row['grade_runs'], 'properties' => $_row['properties']
										, 'race_time' => $_row['race_time'], 'race_group' => $_row['race_group'], 'race_props' => $_row['race_props'], 'track_uid' => $_row['track_uid']
								     );
										
		$_dogs['race_history'][$_row['form_date']] = array('properties' => $_row['form_properties']);
	
	}
	
	return json_encode($_dogs);

}



function result_meeting($_track_date){

	$connect = mysqli_connector();
	
	$_meeting = array();

	$_card_meetingTable = 'dog_cards_Meeting';
	
	$_result_raceTable = 'dog_results_Race';
	
	$_card_raceTable = 'dog_cards_Race';

	$_q = 'SELECT a.track_date, a.track, a.track_uid, a.id, b.race_time, c.race_group
	
	FROM ' . $_card_meetingTable . ' AS a 
	
	JOIN ' . $_result_raceTable . ' as b ON a.track_uid = b.track_uid 
	
	JOIN ' . $_card_raceTable . ' as c ON a.track_uid = c.track_uid 
	
	WHERE a.track_date = "' . $_track_date . '" AND b.track_date = "' . $_track_date . '" AND c.track_date = "' . $_track_date . '"
	
	ORDER BY tv DESC, b.race_time';
	
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		$_meeting[$_row['track_date']][$_row['race_group']][$_row['track']][] = array('track_uid' => $_row['track_uid'], 
		
																	'id' => $_row['id'],
																	
																	'race_time' => $_row['race_time'],
																						
																);
	
	}
	
	return json_encode($_meeting);
		
}

function result_races($_trackid,$_track_date){

	$connect = mysqli_connector();
	
	$_races = array();
	
	$_result_raceTable = 'dog_results_Race';
	
	$_result_meetingTable = 'dog_results_Meeting';

	$_q = 'SELECT a.race_uid, a.race_time, a.race_number, a.properties, a.nonrunner, a.reserves, a.vacant_trap, a.forecast_properties, a.tricast_properties,

		a.top3, b.track FROM ' . $_result_raceTable . ' AS a JOIN ' . $_result_meetingTable . ' AS b ON a.track_uid=b.track_uid
		
		WHERE a.track_date = "' . $_track_date . '" AND a.track_uid = "' . $_trackid . '"
		
		ORDER BY a.race_number';
	
	$_result = $connect->query($_q);

	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
		
		$_races[$_row['track']][$_row['race_uid']][$_row['race_number']] = array('race_time' => $_row['race_time'], 
																							
																	'properties' => $_row['properties'],
																	'nonrunner' => $_row['nonrunner'],
																	'reserves' => $_row['reserves'],
																	'vacant_trap' => $_row['vacant_trap'],
																	'forecast_properties' => $_row['forecast_properties'],
																	// 'forecast_properties' => json_decode('[{"trap1":"1","trap2":"5","value":"20.73"}]'),
																	'tricast_properties' => $_row['tricast_properties'],
																	'top3' => $_row['top3'],
																
																);
	
	}
	
	return json_encode($_races);

}

function result_runners($_raceid, $_track_date){

	$connect = mysqli_connector();
	
	$_runners = array();

	$_result_meetingTable = 'dog_results_Meeting';

	$_result_raceTable = 'dog_results_Race';

	$_result_runnerTable = 'dog_results_Runner';

	$_q = 'SELECT a.race_uid, a.race_time, a.race_number, a.properties AS race_props, a.forecast_properties, a.tricast_properties, b.comment AS dog_comment,
	
			b.dog_uid, b.final_position, b.trap, b.dog_name, b.properties AS dog_props, c.track FROM ' . $_result_raceTable . ' 
	
			AS a JOIN ' . $_result_runnerTable . ' as b ON a.race_uid = b.race_uid  JOIN ' . $_result_meetingTable . ' as c ON c.track_uid = a.track_uid 
			
			WHERE a.race_uid = "' . $_raceid . '" AND a.track_date = "' . $_track_date . '"
			
			ORDER BY b.final_position';
	
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		$_runners[$_row['track']][$_row['race_uid']]['race_details'] = array('race_time' => $_row['race_time'], 'race_number' => $_row['race_number']
																, 'race_props' => $_row['race_props'], 'forecast_properties' => $_row['forecast_properties']
																, 'tricast_properties' => $_row['tricast_properties']);
																				
		$_runners[$_row['track']][$_row['race_uid']]['dog_details'][$_row['dog_uid']] = array('final_position' => $_row['final_position'], 'trap' => $_row['trap']
																							, 'dog_name' => $_row['dog_name'], 'dog_props' => $_row['dog_props']
																							, 'comment' => $_row['dog_comment']);
	
	}
	
	// echo '<pre>';
	// print_r($_runners);
	// echo '</pre>';
	return json_encode($_runners);

}

function result_race_time($_track_uid, $_track_date){

	$connect = mysqli_connector();
	
	$_race_time = array();

	$_result_raceTable = 'dog_results_Race';
	
	$_q = 'SELECT race_uid, track_date, race_time FROM ' . $_result_raceTable . ' WHERE track_uid="' . $_track_uid . '" AND track_date="' . $_track_date . '"';
	
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		$_race_time[] = array('race_uid' => $_row['race_uid'], 'track_date' => $_row['track_date'], 'race_time' => $_row['race_time']);
	
	}
	
	// echo '<pre>';
	// print_r($_race_time);
	// echo '</pre>';

	return json_encode($_race_time);
}

function get_next_result_raceid($_track_uid, $_racetime, $_track_date, $_except){

	$connect = mysqli_connector();
	
	$_race_time = array();

	$_result_raceTable = 'dog_results_Race';
	
	if($_except == 'less')
		$_q = 'SELECT race_uid FROM ' . $_result_raceTable . ' WHERE track_uid="' . $_track_uid . '" AND track_date="' . $_track_date . '" AND race_time < "'.$_racetime.'" ORDER BY race_number DESC LIMIT 1';
	
	elseif($_except == 'greater')
		$_q = 'SELECT race_uid FROM ' . $_result_raceTable . ' WHERE track_uid="' . $_track_uid . '" AND track_date="' . $_track_date . '" AND race_time > "'.$_racetime.'" LIMIT 1';
		
	$_result = $connect->query($_q);
	
	if($_result->num_rows==0){
	
		return '#';
	
	}
	
	else{
		
		while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
			return $_row['race_uid'];
		
		}
	
	}

}

function predict($_raceid, $_track_date){

	$connect = mysqli_connector();
	
	$_runners = array();

	$_dog_Runner = 'predictor_dog_Runner';

	$_dog_Race = 'predictor_dog_Race';

	$_q = 'SELECT b.track, a.trap, a.percent_predict, a.race_uid AS race_id, b.track_date, b.race_time FROM ' . $_dog_Runner . ' 
	
			AS a JOIN ' . $_dog_Race . ' as b ON a.race_uid = b.race_uid
			
			WHERE a.race_uid = "' . $_raceid . '" AND b.track_date = "' . $_track_date . '"
			
			ORDER BY a.trap';
			
	$_result = $connect->query($_q);
	
	while ($_row = mysqli_fetch_array($_result, MYSQL_ASSOC)) {
	
		$_runners[$_row['track_date']][$_row['track']][$_row['race_time']][] = array( 
																				'trap' => $_row['trap'], 'percent_predict' => $_row['percent_predict']);																		
	}
	
	return json_encode($_runners);

}