
<!DOCTYPE html>
<html>
<body>
<h3>
<?php
	//---------------A USER_RISK_SCORE CLASS---------------//

	class user_risk_score {

	  public float $factor_phishing;
	  public float $factor_sercurity;
	  public float $factor_breach;
	  public float $factor_job;
	  public float $factor_report;

	  public function __construct($phishing, $sercurity,$breach,$job,$report) {
	    $this->factor_phishing = $phishing;
	    $this->factor_sercurity = $sercurity;
		$this->factor_breach = $breach;
		$this->factor_job = $job;
		$this->factor_report = $report;
	  }

	  public function get_factor_phishing() {

	    return $this->factor_phishing;
	  }

	  public function get_factor_sercurity() {
	    return $this->factor_sercurity;
	  }

	  public function get_factor_breach() {
	    return $this->factor_breach;
	  }

	  public function get_factor_job() {
	    return $this->factor_job;
	  }

	  public function get_factor_report($val) {
	    return $this->factor_report;
	  }



	  public function set_factor_phishing($val) {

		$temp = $val * 0.4; //----------phishing weitght = 40%--------//
	    $this->factor_phishing = $temp;
	  
	}

	  public function set_factor_sercurity($val) {

		$temp = $val * 0.2; //----------sercurity weigth = 20%--------//
	    $this->factor_sercurity = $temp;
	  }

	  public function set_factor_breach($val) {

		$temp = $val * 0.15; 
	    $this->factor_breach = $temp;
	  }

	  public function set_factor_job($val) {

		$temp = $val * 0.1; 
	    $this->factor_job = $temp;

	  }

	  public function set_factor_report($val) {

		$temp = $val * 0.15; 
	    $this->factor_report = $temp;
	  }

	  public function get_final_user_score(){

		// $this->set_factor_breach(100);
		// $this->set_factor_job(100);
		// $this->set_factor_report(100);
		// $this->set_factor_phishing(100);
		// $this->set_factor_sercurity(100);

		return $this->factor_breach + $this->factor_job + $this->factor_phishing + $this->factor_report + $this->factor_sercurity;
	  }
	}
	
	//----------------GROUP_RISK_SCORE--------------------//

	class group_risk_score{

		public array $user_score;
		public array $class_group;
		public function __construct($score){
			$this->user_score = $score;
			$this->class_group =array (0,0,0,0,0,0,0,0,0,0);
		}

		public function MSE(){
			$lengh = count($this->user_score);
			$sum = 0;
			for ($i = 0; $i < $lengh; $i++ ){
				$reg_val = $this->user_score[$i];

			//---------- we should use predict value using machine learning(tensorflow ,numpy,keras in python) instead of rand(-5,5)----------//				
			//-----------but to show algoridthm I use rand (-5 ,5) ---------------------------------------// 	

				$predit_val = $reg_val + rand(-5,5); 
				$sum += pow( ($reg_val-$predit_val) , 2);
			} 
			return $sum / $lengh;
			
		}

		public function average(){

			$lengh = count($this->user_score);
			$sum = 0;
			$max = 0;
			$final_score = 0;
			for ($i = 0; $i < $lengh; $i++ ){
				$reg_val = $this->user_score[$i];
				if($reg_val<10){
					$this->class_group[0]++;
				}if($reg_val<20 && $reg_val>=10){
					$this->class_group[1]++;
				}
				if($reg_val<30 && $reg_val>=20){
					$this->class_group[2]++;
				}
				if($reg_val<40 && $reg_val>=30){
					$this->class_group[3]++;
				}
				if($reg_val<50 && $reg_val>=40){
					$this->class_group[4]++;
				}
				if($reg_val<60 && $reg_val>=50){
					$this->class_group[5]++;
				}
				if($reg_val<70 && $reg_val>=60){
					$this->class_group[6]++;
				}
				if($reg_val<80 && $reg_val>=70){
					$this->class_group[7]++;
				}
				if($reg_val<90 && $reg_val>=80){
					$this->class_group[8]++;
				}
				if($reg_val<100 && $reg_val>=90){
					$this->class_group[9]++;
				}
			} 
			for ($i = 0; $i < 10; $i++ ){
				if ($max <= $this->class_group[$i])
					$max = $this->class_group[$i];
			}

			$scale = $max / $lengh;

			if($scale >= 0.7){
				for ($i = 0; $i < $lengh; $i++ ){
					$reg_val = $this->user_score[$i];
					if($reg_val<10){
						$sum +=$reg_val * pow( $this->class_group[0] / $max,2) ;
					}
					if($reg_val<20 && $reg_val>=10){
						$sum +=$reg_val * pow( $this->class_group[1] / $max,2 );
					}
					if($reg_val<30 && $reg_val>=20){
						$sum +=$reg_val * pow( $this->class_group[2] / $max,2 );
					}
					if($reg_val<40 && $reg_val>=30){
						$sum +=$reg_val * pow( $this->class_group[3] / $max,2) ;
					}
					if($reg_val<50 && $reg_val>=40){
						$sum +=$reg_val * pow( $this->class_group[4] / $max,2);
					}
					if($reg_val<60 && $reg_val>=50){
						$sum +=$reg_val * pow( $this->class_group[5] / $max,2);
					}
					if($reg_val<70 && $reg_val>=60){
						$sum +=$reg_val * pow( $this->class_group[6] / $max,2);
					}
					if($reg_val<80 && $reg_val>=70){
						$sum +=$reg_val * pow( $this->class_group[7] / $max,2) ;
					}
					if($reg_val<90 && $reg_val>=80){
						$sum +=$reg_val * pow( $this->class_group[8] / $max,2) ;
					}
					if($reg_val<100 && $reg_val>=90){
						$sum +=$reg_val * pow( $this->class_group[9] / $max,2) ;
					}
				}
				$final_score = $sum / $max;
				
			}
			if($scale >= 0.4 && $scale < 0.7){
				for ($i = 0; $i < $lengh; $i++ ){
					$reg_val = $this->user_score[$i];
					if($reg_val<10){
						$sum +=$reg_val * pow( $this->class_group[0] / $max,1) ;
					}
					if($reg_val<20 && $reg_val>=10){
						$sum +=$reg_val * pow( $this->class_group[1] / $max,1 );
					}
					if($reg_val<30 && $reg_val>=20){
						$sum +=$reg_val * pow( $this->class_group[2] / $max,1 );
					}
					if($reg_val<40 && $reg_val>=30){
						$sum +=$reg_val * pow( $this->class_group[3] / $max,1) ;
					}
					if($reg_val<50 && $reg_val>=40){
						$sum +=$reg_val * pow( $this->class_group[4] / $max,1);
					}
					if($reg_val<60 && $reg_val>=50){
						$sum +=$reg_val * pow( $this->class_group[5] / $max,1);
					}
					if($reg_val<70 && $reg_val>=60){
						$sum +=$reg_val * pow( $this->class_group[6] / $max,1);
					}
					if($reg_val<80 && $reg_val>=70){
						$sum +=$reg_val * pow( $this->class_group[7] / $max,1) ;
					}
					if($reg_val<90 && $reg_val>=80){
						$sum +=$reg_val * pow( $this->class_group[8] / $max,1) ;
					}
					if($reg_val<100 && $reg_val>=90){
						$sum +=$reg_val * pow( $this->class_group[9] / $max,1) ;
					}
				}
				$final_score = ($sum * 1.2) / $lengh;
			}
			if($scale >= 0.25 && $scale <0.4){
				for ($i = 0; $i < $lengh; $i++ ){
					$reg_val = $this->user_score[$i];
					if($reg_val<10){
						$sum +=$reg_val * pow( $this->class_group[0] / $max,1) ;
					}
					if($reg_val<20 && $reg_val>=10){
						$sum +=$reg_val * pow( $this->class_group[1] / $max,1 );
					}
					if($reg_val<30 && $reg_val>=20){
						$sum +=$reg_val * pow( $this->class_group[2] / $max,1 );
					}
					if($reg_val<40 && $reg_val>=30){
						$sum +=$reg_val * pow( $this->class_group[3] / $max,1) ;
					}
					if($reg_val<50 && $reg_val>=40){
						$sum +=$reg_val * pow( $this->class_group[4] / $max,1);
					}
					if($reg_val<60 && $reg_val>=50){
						$sum +=$reg_val * pow( $this->class_group[5] / $max,1);
					}
					if($reg_val<70 && $reg_val>=60){
						$sum +=$reg_val * pow( $this->class_group[6] / $max,1);
					}
					if($reg_val<80 && $reg_val>=70){
						$sum +=$reg_val * pow( $this->class_group[7] / $max,1) ;
					}
					if($reg_val<90 && $reg_val>=80){
						$sum +=$reg_val * pow( $this->class_group[8] / $max,1) ;
					}
					if($reg_val<100 && $reg_val>=90){
						$sum +=$reg_val * pow( $this->class_group[9] / $max,1) ;
					}
				}
				$final_score = $sum * 1.7 / $lengh;
			}
			if ($scale < 0.25){
				for ($i = 0; $i < $lengh; $i++ ){
					$sum +=  $this->user_score[$i];
				}
				$final_score = $sum / $lengh;
			}
			//echo $final_score;
			return $final_score;
		}

		public function get_final_group_score(){		
			return $this->MSE();
		}
	}

	

	//---------------test group_risk_srore-------------//
	$u = new user_risk_score(0,0,13,4.33,0);
	echo $u->get_final_user_score();
	echo "<br>";

	//--------------test group_risk_srore------------//
	$g = new group_risk_score(array(10,10,10,10,10,90));
	echo 'scale:';
	echo $g->average();
	// echo '<br>';
	// echo 'score:';
	// echo $g->average()[1];

	//echo $g->get_final_group_score();

?>
</h3>

</body>
</html>