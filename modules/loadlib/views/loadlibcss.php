<?php
	if (isset($list_lib)){
		if ($list_lib){
			$path = '';
			foreach ($list_lib as $lib){
				$path .= ',css/'.$lib;
			}
			?>
				<link rel="stylesheet" type="text/css" href="<?=url::base()?>compress?css<?=$path?>" media="screen" />
			<?php
		}
	}
?>