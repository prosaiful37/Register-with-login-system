<?php 

	/**
	 * data recover form submission 
	 */
	function old($name){
		if (isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}
	
	/**
	 * file upload system
	 */
	function fileUpload($file, $location, $format = ['jpg','png', 'gif','jpeg']){
		//file info
		$file_name = $file['name'];
		$file_tmp_name = $file['tmp_name'];

		//get file extension
		$file_array = explode('.', $file_name);
		$ext = strtolower(end($file_array));
		
		//file unique name 
		$unique_name = md5(time().rand()) . '.'. $ext;

		$status = '';
		if(in_array($ext, $format)){
			//file upload
			move_uploaded_file($file_tmp_name, $location . $unique_name);
			$status = 'yes';
		}else{
			$status = 'no';
		}

		return[
			'file_name'	=> $unique_name,
			'status'	=> $status
		];
		

	}

	/**
	 * value check
	 */
	function unique($conn, $table, $col, $data){
		$sql = "SELECT $col FROM $table WHERE $col='$data'";
		$data = $conn -> query($sql);
		$row = $data -> num_rows;


		if ($row > 0) {
			return false;	
		}else{
			return true;
		}
	}

/**
 * set massege
 */

function setMsg($msg){

	setcookie('smsgs', $msg, time()+10);
}

function getMsg(){

	if (isset($_COOKIE['smsgs'])) {

		echo "<p class=\" alert alert-success \">" . $_COOKIE['smsgs'] . " <button class='close' data-dismiss='alert'></p>";
	}
}







