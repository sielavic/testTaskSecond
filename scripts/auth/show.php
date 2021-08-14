<?php

 //Проверяем зашел ли пользователь
 if($user === false){
     $filename = './catalog.json';
     $somecontent = ' {
     "status": "error"
      ';
     // Пишем файл
     $f = fopen("./catalog.json", "r+");
     fwrite($f, $somecontent, 60);
     fclose($f);
     include "./catalog.json";
 	echo '<h3>Доступ закрыт, Вы не вошли в систему!</h3>'."\n";
 }
 if($user === true) {
     $filename = './catalog.json';
     $somecontent = ' {
     "status": "success"
      }';
     // Пишем файл
     $f = fopen("./catalog.json", "r+");
     fwrite($f, $somecontent, 60);
     fclose($f);
     include "./catalog.json";
	echo '<h3>Поздравляю, Вы вошли в систему!</h3>'."\n";
	echo '<a href="'.HOST.'?mode=auth&exit=true">ВЫЙТИ</a>';
 }
 ?>
	