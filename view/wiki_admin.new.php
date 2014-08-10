<div class="wiki-wrapper">
	<form class="wiki_edit_article" action="%baseurl%apps/manage/wiki/newwiki/" method="post">
		<div class="save-page-button">
			Parent: <select name="parent" id="">
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
			<input type="submit" class="submit-button" value="Save Page" /> <?=isset($msg)?$msg:'';?>
		</div>
		
		<div class="page_title">
			Alias:
			<input name="alias" placeholder="Wiki Alias" value="<?=urldecode($args[1]);?>" />
		</div>
		<div class="page_title">
			Human Friendly Title:
			<input name="title" placeholder="New Wiki Title" value="<?=urldecode($args[1]);?>" />
		</div>
		<textarea id="ckeditor" name="content"></textarea>
	</form>
	<?php readfile(ROOT.'system/lib/editor.js'); ?>
</div>