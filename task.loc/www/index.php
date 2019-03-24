<!DOCTYPE html>
<head>
		
	<title>Тестовое задание</title>
	
</head>
<body>
	<?php
		function listing($filename){
			$uploaddir = file_get_contents($filename);
			$hdl = opendir($uploaddir);
			while ($file = readdir($hdl)) {
				if (($file!="..")&&($file!=".")) { 
					$c[]=$file;
				} 
			}
			closedir($hdl);

			if (sizeof($c)>0) {
				asort($c);
				foreach ($c as $k) {
					$full=$uploaddir. "/". $k;
					echo ("<input name=fl[] value=$k type=checkbox>");
					echo ("<a href=$full>$k</a>");
				
					echo " размер: ".filesize($full). " bytes"; 
					echo ("<br>");
				}
			}
			else {
				echo "Ваша папка порожня, додайте файли";
			}

		}

       
        if( isset( $_POST['creation_folder'] ) ) {
        	if($_POST['name_folder'] == null){
        		echo "Ви не ввели ім'я' папки!!!";
        	}
        	else {
            	@mkdir($_POST['name_folder'], 0700);
        
       	        $a = $_POST['name_folder'];
	        	$b = "./". $a. "/";
	    		echo "Ваша робоча папка - ". $b;
	    		echo ("<br>");
	    		$filename = 'dir.txt';
				$text = $b;
			
				file_put_contents($filename, $text);

				listing($filename);

				
			}
        }  

		if( isset( $_POST['upload'] ) ) { 
	    
			$filename = 'dir.txt';    	
			$uploaddir = file_get_contents($filename);
			$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);

		
			if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
				echo "<h3>Файл успешно загружен на сервер</h3>";
			}
			else { 
				echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; exit; 
			}

			listing($filename);

			
		}
	?>
	<form method="POST">
        <input type="text" name="name_folder" maxlength="20" placeholder="Введіть імя робочої папки" />
        <input type="submit" name="creation_folder" value="Відправити" />
    </form>

   
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="uploadfile">
		<input type="submit" name="upload" value="Завантажити">
	</form>
	
</body>
</html>