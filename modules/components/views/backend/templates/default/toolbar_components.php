<div id="toolbar">	<div id="menu_component">		<div id="name_component">			<?php if (isset($name_component)){echo $name_component;};?>		</div>		<div id="section_component">			<ul>				<?php				if (isset($actions_component)){					foreach ($actions_component as $action_component){						if (isset($action_component['active'])){								if ($action_component['active']){								?>									<li class="active"><?=$action_component['text']?></li>								<?php							}							else{								?>									<li><a href="<?=$action_component['link']?>"><?=$action_component['text']?></a></li>								<?php							}						}						}				}				?>			</ul>		</div>	</div>	<div id="buttons">		<ul>		<?php			if (isset($buttons_component)){				foreach ($buttons_component as $button_component){				?>					<li>						<a href="<?=$button_component['link']?>">							<table>								<tr>									<td><img src="<?=url::base()?>images/buttons/<?=$button_component['img']?>" alt="" alt="" /></td>								</tr>								<tr>									<td><?=$button_component['text']?></td>								</tr>							</table>						</a>					</li>				<?php			}		}		?>		</ul>	</div></div>