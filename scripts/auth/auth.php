<?php

require './vendor/autoload.php';

 //Выход из авторизации
 if(isset($_GET['exit']) == true){
 	//Уничтожаем сессию
 	session_destroy();
 	//Делаем редирект
 	header('Location:'. HOST );
 	exit;
 }

 //Если нажата кнопка то обрабатываем данные
 if(isset($_POST['submit']))
 {
	//Проверяем на пустоту
	if(empty($_POST['login']))
		$err[] = 'Не введен Логин';
	
	if(empty($_POST['pass']))
		$err[] = 'Не введен Пароль';
	


	//Проверяем наличие ошибок и выводим пользователю
	if(count($err) > 0)
		echo showErrorMessage($err);
	else
	{
		$sql = 'SELECT login, pass 
				FROM `'. DBPREFIX .'reg`
				WHERE `login` = :login';

		//Подготавливаем PDO выражение для SQL запроса
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
		$stmt->execute();

		//Получаем данные SQL запроса
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		dump($rows);
		
		//Если логин совпадает, проверяем пароль
		if(count($rows) > 0)
		{
		    dump($_POST['pass']);

			if($_POST['pass'] == $rows[0]['pass'])//сделал без md5 для простоты тестирования
			{	
				$_SESSION['user'] = true;
				
				//Сбрасываем параметры
				header('Location:'. HOST );
				exit;
			}
			else
				echo showErrorMessage('Неверный пароль!');
		}else{
			echo showErrorMessage('Логин <b>'. $_POST['login'] .'</b> не найден!');
		}
	}
 }
 
?>