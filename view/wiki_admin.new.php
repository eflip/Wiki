<?php if($wiki['parent'] != 0): ?>
Back to <a href="%appurl%byid/<?=$wiki['parent'];?>">Parent</a>

<br />
<br />
<?php endif; ?>

<form class="wiki_edit_article" action="%appurl%newwiki" method="post">		
	
	
	<div class="row no_martop">
		<div class="col-9">
			Title <input style="font-size: 24px; width: 100%; padding: 5px; margin-bottom: 5px;" class="dark_b" name="title" value="<?=urldecode($args[1]);?>" />
			
			
			
			
			<div class="row">
				<div class="col-6">
					Parent
					<select name="parent" id="">
						<?php ob_start(); ?>
				
						 <option value="0">-- Index --</option>
						
						<?php
						
						echo wiki_orm::selectparent();
						
						/*if(wiki_orm::idToAlias($wiki['parent']))
							echo '<option value="'.$wiki['parent'].'">'
								.wiki_orm::idToAlias($wiki['parent']).'</option>';
						*/
						
						?>
					</select>
				</div>
				<div class="col-6">
					Alias:
			<input name="alias" placeholder="New Wiki Title" value="<?=urldecode($args[1]);?>" />
				</div>
			</div>
			
			<textarea placeholder="Wiki text" style="width:100%; height: 400px" id="ckeditor" name="content"><?=htmlspecialchars($wiki['content'], ENT_QUOTES);?></textarea>
			
			<input type="submit" class="martop green" value="Save Page" /> <?=isset($msg)?$msg:'';?>
			
			<a <?=jsprompt('Are you sure you want to delete this?');?> class="x martop" href="%appurl%rm/<?=$wiki['id'];?>/">Delete this wiki</a>
		</div>
		<div class="col-3">
			<h4>Linked</h4>
				
			<ol class="fvlist">
				<?php if($sub_wikis != null)
					foreach($sub_wikis as $subwiki): ?>
				<li>
					<a href="%appurl%editbyalias/<?=urlencode($subwiki);?>/from/<?=$wiki['id'];?>"><?=$subwiki;?></a>
				</li>
				<?php endforeach;
					else
					echo '<li>No subwikis found. Add [[this]] or [[that]] to your page.</li>'; ?>
			</ol>
		</div>
	</div>
</form>
<?php /*readfile(ROOT.'system/lib/editor.js');*/ ?>
