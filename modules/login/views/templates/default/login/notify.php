<?php
	if ($errors){
		?>
		<div class="name_notify">
			Ошибка
		</div>
		<ul>
		<?php
		foreach ($errors as $error){
		?>	
			<li><?=$error?></li>
		<?php
		}
		?>
		</ul>
		<center>Для продолжения нажмите ESC.</center>
		<?php
	}
?>