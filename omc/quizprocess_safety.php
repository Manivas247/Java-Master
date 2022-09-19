<?php include 'mysqli_connect.php'; ?>
<?php session_start(); ?>
<?php 
include 'photofunction.php';
	//For first question, score will not be there.
	if(!isset($_SESSION['score1'])){
		$_SESSION['score1'] = 0;
	}
 if($_POST){
	//We need total question in process file too
 	$query = "SELECT * FROM safety_questions";
	$total_questions = mysqli_num_rows(mysqli_query($con,$query));
	
	//We need to capture the question number from where form was submitted
 	$number = $_POST['number'];
	
	//Here we are storing the selected option by user
 	$selected_choice = $_POST['choice'];
	
	//What will be the next question number
 	$next = $number+1;
	
	//Determine the correct choice for current question
 	$query = "SELECT * FROM safety_options WHERE question_number = $number AND is_correct = 1";
 	 $result = mysqli_query($con,$query);
 	 $row = mysqli_fetch_assoc($result);

 	 $correct_choice = $row['id'];
	
	
	//Increase the score if selected cohice is correct
 	 if($selected_choice == $correct_choice){
 	 	$_SESSION['score1']++;
 	 }
	 




		//Redirect to next question or final score page. 
 	 if($number == $total_questions){
		$pdo = pdo_connect_mysql();	  
		if(isset($_SESSION['email'])){
			$email = $_SESSION['email'];
			$stmt = $pdo->prepare('SELECT * FROM user WHERE email = ?');
			$stmt->execute([ $_SESSION['email'] ]);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		$name=$result['name'];
		$email=$result['email'];
		$designation=$result['designation'];
		$score =$_SESSION['score1'];
		$date = date("Y-m-d");
		$stmt = $pdo->prepare('INSERT INTO safety_result (name, email, designation, score1, attend_date) VALUES (?, ?,?, ?, ?)');
		$stmt->execute([ $name,$email, $designation, $score,$date ]);
 	 	header("LOCATION: quizfinal_safety.php");
 	 }else{
 	 	header("LOCATION: quiz_safety.php?n=". $next);
 	 }


 }



?>