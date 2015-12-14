<?php if($wiki['parent'] != 0): ?>
Back to <a href="%appurl%byid/<?=$wiki['parent'];?>">Parent</a>

<br />
<br />
<?php endif; ?>

<form class="wiki_edit_article" action="%baseurl%apps/wiki/newwiki/" method="post">		
	
	
	<div class="row no_martop">
		<div class="col-9">
			Title <input style="font-size: 24px; width: 100%; padding: 5px; margin-bottom: 5px;" class="dark_b"  placeholder="Wiki page title" name="title" value="<?=ucfirst($alias);?>" />
			
			<div class="row">
				<div class="col-6">
					Parent
					<select name="parent" id="">
						<?php ob_start(); ?>
						
						 <option value="0">-- Index --</option>
						
						<?php
						
						echo (new wikiModel)->selectparent();
						
						if(isset($_GET['from']))
						{
							echo str_replace('value="'.$_GET['from'].'"', 'selected="selected" value="'.$_GET['from'].'"', ob_get_clean());
						}
						
						
						?>
					</select>
				</div>
				<div class="col-6">
					Alias:
					<input name="alias" value="<?=$alias;?>" placeholder="Wiki Alias" />
				</div>
			</div>
			
			<textarea placeholder="Wiki page contents go here" style="width:100%; height: 400px" id="ckeditor" name="content"></textarea>
			
			<input type="submit" class="martop green" value="Save Page" /> <?=isset($msg)?$msg:'';?>
			
			<a <?=jsprompt('Are you sure you want to delete this?');?> class="x martop" href="%appurl%rm/<?=$wiki['id'];?>/">Delete this wiki</a>
		</div>
		<div class="col-3">
			<h4>Linked</h4>
				
			<ol class="fvlist">
				<li>No subwikis found. Add [[this]] or [[that]] to your page.</li>
			</ol>
		</div>
	</div>
</form>
<?php /*readfile(ROOT.'system/lib/editor.js');*/ ?>
