<!DOCTYPE html>
<head>
		
	<title>Тестовое задание</title>
	
</head>
<body>
	<form method="POST">
        <input type="text" name="name_folder" maxlength="20" placeholder="Введите название папки" />
        <input type="submit" name="creation_folder" value="Создать папку" />
    </form>

    <?php
        # Если кнопка нажата
        if( isset( $_POST['creation_folder'] ) )
        {
        	if($_POST['name_folder'] == null){
        		echo "Вы не ввели имя папки!!!";
        	}
        	else{
            @mkdir($_POST['name_folder'], 0700);
        
       
	        $a = $_POST['name_folder'];
	        $b = "./". $a. "/";
	    	echo "Your folder is". $b;
	    	$filename = 'dir.txt';
			$text = $b;
			//записываем текст в файл
			file_put_contents($filename, $text);
			}
        }  
    ?>
	<form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="uploadfile">
		<input type="submit" name="upload" value="Загрузить">
	</form>
	<?php
		if( isset( $_POST['upload'] ) )
        { 
	    // Каталог, в который мы будем принимать файл:
		$filename = 'dir.txt';    	
		$uploaddir = file_get_contents($filename);
		$uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);

		// Копируем файл из каталога для временного хранения файлов:
		if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
		{
		echo "<h3>Файл успешно загружен на сервер</h3>";
		}
		else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; exit; }

		$dir    = $uploaddir;
		$files1 = scandir($dir);
		

		print_r($files1);
		
		
		}
	?>
</body>
</html>