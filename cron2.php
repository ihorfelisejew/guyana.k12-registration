<?php



include('server/db.php');
error_reporting(0);
//ini_set('display_errors', 1);


$sql = "SELECT * FROM `rounds` WHERE `round` = '2'";
$retval = mysqli_query( $con, $sql );

if(! $retval )
	{
		die('Could not enter data: ' . mysqli_error($con));
	}else {
		
		$row = mysqli_fetch_assoc($retval);
		$challenges =$row['challenges'];
		
		$sql1 = "SELECT * FROM `challenge` WHERE `round` = '2'";
		$retval1 = mysqli_query( $con, $sql1 );
		while($row1 = mysqli_fetch_assoc($retval1))
		{
			$endDate = $row1['endDate'];
			$datetime = explode(" ",$endDate);
			$date = strtotime($datetime[0]);
			
			$current_data =strtotime(date('Y-m-d'));
			
			if($current_data == $date || $date <= $current_data ){
				//echo count($date);
				$currentdatarray[] = $date;	
			}
			
			
		}
		
		$currentdatarray = count($currentdatarray);
		
		if($currentdatarray >= $challenges){
			//echo 'hi';
			
			$sql6 = "SELECT * FROM `county_state`";
				$retval6 = mysqli_query( $con, $sql6 );
				
				while($row6 = mysqli_fetch_assoc($retval6)){
					$state_abv = $row6['state_abv'];
					//$sql8 = "SELECT c.*, l.id as linkid,l.team_id,vr.rating, SUM(vr.rating) as sum, t.coach_id, u.county FROM `challenge` c INNER JOIN `links` l ON c.id = l.challenge_id INNER JOIN `video_rating` vr ON l.id = vr.link_id INNER JOIN `team` t ON t.id = l.team_id INNER JOIN `users` u ON u.id = t.coach_id WHERE c.round = 1 AND u.county = '$county' GROUP BY l.team_id ORDER BY `sum` DESC";
					
					$sql8 ="SELECT c.*, l.id as linkid,l.team_id,vr.rating, SUM(vr.rating) as sum, t.coach_id, u.county,u.state FROM `challenge` c INNER JOIN `links` l ON c.id = l.challenge_id INNER JOIN `video_rating` vr ON l.id = vr.link_id INNER JOIN `team` t ON t.id = l.team_id INNER JOIN `users` u ON u.id = t.coach_id WHERE c.round = '2' AND u.state = '$state_abv' GROUP BY l.team_id ORDER BY `sum` DESC";
					$retval8 = mysqli_query( $con, $sql8 );
					$i = 1;
					while($row8 = mysqli_fetch_assoc($retval8))
					{
						if($i == 1){
							
							$team_id = $row8['team_id'];
							$score = $row8['sum'];
							$county1 = $row8['county'];
							$state = $row8['state'];
							
							$sql9 = "SELECT * FROM `winners2` WHERE `round` LIKE '2' AND `team_id` LIKE '$team_id' AND `score` = '$score' AND `county` LIKE '$county1'" ;
							$retval9 = mysqli_query( $con,$sql9);
							$numResults = mysqli_num_rows($retval9);
							if ($numResults > 0) {
							   // there are some results, retrieve them normally (e.g. with mysqli_fetch_assoc())
							} else {
							   // no data from query, react accordingly
								
								$sql5 = "INSERT INTO `winners2`(`round`, `team_id`, `score`, `county`, `state`) VALUES ('2','$team_id', '$score','$county1', '$state')";
								mysqli_query( $con,$sql5);
								
								$sql10 = "SELECT t.name as teamname, u.name,u.last_name,u.email FROM `team` t INNER JOIN `users` u ON u.id = t.coach_id WHERE t.`id` = '$team_id'";
								$retval10 = mysqli_query( $con,$sql10);
								while($row10 = mysqli_fetch_assoc($retval10)){
									$coachemailad = $row10['email'];
									$teamname = $row10['teamname'];
									$message2 ="Congrats your team $teamname is the winner of round one and will  now move on the STATE championship for round 3";
									//mail($coachemailad,"Congrats your team $teamname is winner",$message);	
								}
								
								$sql11 = "SELECT t.name as teamname,tm.user_id, u.name,u.last_name,u.email FROM `team` t INNER JOIN `team_player` tm ON tm.team_id = t.id INNER JOIN `users` u ON u.id = tm.user_id WHERE t.`id` = '$team_id'";
								$retval11 = mysqli_query( $con,$sql11);
								while($row11 = mysqli_fetch_assoc($retval11)){
									$coachemailad2 = $row11['email'];
									$teamname2 = $row11['teamname'];
									$message2 ="Congrats your team $teamname2 is the winner of round one and will  now move on the STATE championship for round 3";
									//mail($coachemailad2,"Congrats your team $teamname2 is winner",$message2);	
								}
								
								$sql12 = "SELECT 8 FROM `team` WHERE `id` = '$team_id'";
								$retval12= mysqli_query( $con,$sql12);
								while($row12 = mysqli_fetch_assoc($retval12)){
									$coachemailad3 = 'admin@email.com';
									$teamname3 = $row12['teamname'];
									$message3 = "The winners for round 1 has been declared.  It is team name [team name] from org [org name].  This team will now move on to the STATE championship";
									//mail($coachemailad3,"Congrats your team $teamname3 is winner",$message3);	
								}
								
								
							}
						}
						$i++;
					}
					
				}
			
			
			//$sql3 = "SELECT c.*, l.id as linkid,l.team_id,vr.rating, SUM(vr.rating) as sum FROM `challenge` c INNER JOIN `links` l ON c.id = l.challenge_id INNER JOIN `video_rating` vr ON l.id = vr.link_id WHERE c.round = 1 GROUP BY l.team_id ORDER BY `sum` DESC";
			/*$sql3 = "SELECT c.*, l.id as linkid,l.team_id,vr.rating, SUM(vr.rating) as sum, t.coach_id, u.county FROM `challenge` c INNER JOIN `links` l ON c.id = l.challenge_id INNER JOIN `video_rating` vr ON l.id = vr.link_id INNER JOIN `team` t ON t.id = l.team_id INNER JOIN `users` u ON u.id = t.coach_id WHERE c.round = 1 GROUP BY l.team_id";
			$retval3 = mysqli_query( $con, $sql3 );
			$row3d = mysqli_fetch_assoc($retval3);
			$i = 1;
			while($row3 = mysqli_fetch_assoc($retval3))
			{	
			
				
				if($i == 1){
					$team_id = $row3['team_id'];
					$score = $row3['sum'];
					$sql5 = "INSERT INTO `winners`(`round`, `team_id`, `score`) VALUES ('1','$team_id', '$score')";
					//mysqli_query( $con,$sql5);
				}
				$i++;
			}*/
			//print_r($row3d);
		}else{
			echo 'no';
		}
		
	}


?>