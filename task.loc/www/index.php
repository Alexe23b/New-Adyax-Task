<!DOCTYPE html>
<head>
		
	<title>Тестовое задание</title>
	
</head>
<body>
	 <?php
       
        if( isset( $_POST['creation_folder'] ) ) {
        	if($_POST['name_folder'] == null){
        		echo "Вы не ввели имя папки!!!";
        	}
        	else {
            	@mkdir($_POST['name_folder'], 0700);
        
       	        $a = $_POST['name_folder'];
	        	$b = "./". $a. "/";
	    		echo "Ваша папка - ". $b;
	    		$filename = 'dir.txt';
				$text = $b;
			
				file_put_contents($filename, $text);
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

			$dir = $uploaddir;

			$hdl = opendir($dir);
			while ($file = readdir($hdl)) {
				if (($file!="..")&&($file!=".")) { 
					$a[]=$file;
				} 
			}
			closedir($hdl);

			if (sizeof($a)>0) {
				asort($a);
			}


			foreach ($a as $k) {
				$full=$dir. "/". $k;
				echo ("<input name=fl[] value=$k type=checkbox>");
				echo ("<a href=$full>$k</a>");
				
				echo " размер: ".filesize($full). " bytes"; 
				echo ("<br>");
			}
		}
	?>
	<form method="POST">
        <input type="text" name="name_folder" maxlength="20" placeholder="Введите имя рабочей папки" />
        <input type="submit" name="creation_folder" value="Создать папку" />
    </form>

   
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="uploadfile">
		<input type="submit" name="upload" value="Загрузить">
	</form>
	
</body>
</html>