<div id="menu">
		<div class="bg_texture">
			<div class="left_div">
				<ul class="main_menu">
					<?php
						if (isset($list_menu)){
							if ($list_menu){
								foreach ($list_menu as $menu){
									if ($menu->com!=''){
										?>
											<a href="<?=url::base()?>backend/index/<?=$menu->com?>">
											<li id_menu="<?=$menu->id?>"><div class="radius_block"><div class="shadow">
												<div class="menu_icon" src="<?=url::base()?>images/<?=$menu->img?>">
													<div class="name_menu_element">
														<?=$menu->title?>
													</div>
													<div class="description_name_element">
														<?=$menu->description?>
													</div>
												</div>
											</div></div></li>
											</a>
										<?php
									}
									else{
										?>
											<li id_menu="<?=$menu->id?>"><div class="radius_block"><div class="shadow">
												<div class="menu_icon" src="<?=url::base()?>images/<?=$menu->img?>">
													<div class="name_menu_element">
														<?=$menu->title?>
													</div>
													<div class="description_name_element">
														<?=$menu->description?>
													</div>
												</div>
											</div></div></li>
										<?php
									}
								}
							}
						}
					?>
				</ul>
			</div>
			<div class="right_div">
				<div class="inner_shadow">
					<a href="<?=url::base()?>" target="blank"><img src="<?=url::base()?>images/btn_on_site.png" hover="<?=url::base()?>images/btn_on_site_h.png" no_hover="<?=url::base()?>images/btn_on_site.png" id="btn_on_site" alt="" title="" /></a>
					<img src="<?=url::base()?>images/separator.png" alt="" title="" />
					<a href="<?=url::base()?>logout/now?act=1">
					<img src="<?=url::base()?>images/btn_logout.png" hover="<?=url::base()?>images/btn_logout_h.png" no_hover="<?=url::base()?>images/btn_logout.png"  id="btn_logout" alt="" title=""/></a>
				</div>
			</div>
		</div>
	</div>
	<div id="pointer_line">
	</div>
	<div id="sub_menu">
		<div class="bg_texture">
			<div id="submenu_container">
			</div>
		</div>
	</div>
	<div id="header">
		<div id="logo">
			Sloin<span class="admin_text_logo">Admin</span>
		</div>
		<div id='user'>
			привет, <span class="user_text_logo"><?=Login::get_user()->username?></span>
		</div>
	</div>