<!DOCTYPE html>
<head>
		
	<title>Тестовое задание</title>
	
</head>
<body>
	<?php
		function listing($filename) {
			$uploaddir = file_get_contents($filename);
			$hdl = opendir($uploaddir);
			while ($file = readdir($hdl)) {
				if (($file!="..")&&($file!=".")) { 
					$c[]=$file;
				} 
			}
			closedir($hdl);
			echo ("<form method=post>");
			if (sizeof($c)>0) {
				asort($c);
				foreach ($c as $k) {
					$full=$uploaddir. "/". $k;
					echo ("<a href=$full>$k</a>");
					echo " розмір: ".filesize($full). " bytes"; 
					echo ("<br>");					
				}
			}
			else {
				echo "Ваша папка порожня, додайте файли";
				echo ("<br>");
			}
		}

       	$filename = 'dir.txt';

       	if(isset($_POST['creation_folder'])) {
        	if($_POST['name_folder'] == null){
        		echo "Ви не ввели ім'я' папки!!!";
        	}
        	else {
            	@mkdir($_POST['name_folder'], 0700);
        
       	        $a = $_POST['name_folder'];
	        	$b = "./". $a. "/";
	    		echo "Ваша робоча папка - ". $b;
	    		echo ("<br>");
	    		
				$text = $b;
			
				file_put_contents($filename, $text);

				listing($filename);

				
			}
        }  

		if(isset($_POST['upload'])){ 
	    
				
			$uploaddir = file_get_contents($filename);
			$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);

		
			if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)){
				echo "<h3>Файл успішно завантажен на сервер</h3>";
			}
			else { 
				echo "<h3>Помилка! Не вдалося завантажити файл на сервер!</h3>"; exit; 
			}

			listing($filename);
		}

		if(isset($_POST['del'])){

			$dir = file_get_contents($filename);
			$files1 = array_diff(scandir($dir), array('..', '.'));
			//print_r($files1);
			
			echo '<form name="fom" action="delete.php?filename=$filename">';
			foreach($files1 as $k){
			    echo '<input type="radio" name="'.$k.'" value="'.$k.'">'.'<label for="'.$k.'">'.$k.'</label>'.'<br>';
			    }
			    echo 'Позначьте файли для видалення:';
			echo '<input type="submit" value="Видалити вибрані файли" >';
			echo '</form>';
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

	<form method="POST">
        <input type="submit" name="del" value="Видалити файли" />
    </form>
	
	
</body>
</html>