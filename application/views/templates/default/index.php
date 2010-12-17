<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset=utf-8>
<title><?php if (isset($title)){echo $title;} ?></title>

<?php if (isset($meta_keywords)){echo $meta_keywords;} ?>
<?php if (isset($meta_description)){echo $meta_description;} ?>

<?=Loadlib::view_css($css)?>
<?=Loadlib::view_js($js)?>

</head>
<body>
<?php if(isset($main_content)){echo $main_content;} ?>
<div id="kohana-profiler">
	<?php //echo View::factory('profiler/stats') ?>
</div>
</body>
</html>

