<div class="wiki-wrapper">
	<form class="wiki_edit_article" action="%baseurl%apps/manage/wiki/update/<?=$wiki['id'];?>/" method="post">
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
				
				echo str_replace('value="'.$wiki['parent'].'"', 'selected="selected" value="'.$wiki['parent'].'"', ob_get_clean());
				
				?>
			</select>
			<input type="submit" class="submit-button" value="Save Page" /> <?=isset($msg)?$msg:'';?>
		</div>
		
		<div class="page_title">
			Alias:
			<input name="alias" value="<?=htmlspecialchars($wiki['alias'], ENT_QUOTES);?>" placeholder="Wiki Alias" />
		</div>
		<div class="page_title">
			Human Friendly Title:
			<input name="title" value="<?=htmlspecialchars($wiki['title'], ENT_QUOTES);?>" />
		</div>
		<div class="save-page-button">
			<h3>Linked Wikis</h3>
		</div>
		<ol class="wiki-list">
			<?php if($sub_wikis != null)
				foreach($sub_wikis as $subwiki): ?>
			<li>
				<a href="%appurl%editbyalias/<?=urlencode($subwiki);?>/from/<?=$wiki['id'];?>"><?=$subwiki;?></a>
			</li>
			<?php endforeach;
				else
				echo '<li>No subwikis found. Add [[this]] or [[that]] to your page.</li>'; ?>
		</ol>
		<textarea id="ckeditor" name="content"><?=htmlspecialchars($wiki['content'], ENT_QUOTES);?></textarea>
		<a <?=jsprompt('Are you sure you want to delete this?');?> class="delete_item" href="%appurl%rm/<?=$wiki['id'];?>/">Delete this wiki</a>
	</form>
	<?php readfile(ROOT.'system/lib/editor.js'); ?>
</div>