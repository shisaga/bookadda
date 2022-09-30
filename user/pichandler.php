<?php

	
	if (isset($_FILES['pic']['name'])) {
		
			$name = $_FILES['pic']['name'];
			
			$tmp_name = $_FILES['pic']['tmp_name'];

			$target = "images/";
			$ext = pathinfo($name,PATHINFO_EXTENSION);

			$newname = rand().'.'.$ext;

			move_uploaded_file($tmp_name, $target.$newname);

			echo "<img src=".$target.$newname." height='200' width='200' style='border-radius:50%;'>";

			

    }


?>

