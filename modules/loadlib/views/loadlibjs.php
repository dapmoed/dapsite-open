<?php
	if (isset($list_lib)){
		if ($list_lib){
			$path = '';
			foreach ($list_lib as $lib){
				$path .= ',js/'.$lib;
			}
			?>
				<script src="<?=url::base()?>compress?js<?=$path?>"></script>
			<?php
		}
	}
?>