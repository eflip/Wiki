<div class="wiki-wrapper">
	<form class="wiki_edit_article" action="%baseurl%apps/manage/wiki/update/<?=$wiki['id'];?>/" method="post">
		<div class="save-page-button">
			<select name="parent" id="">
				<option value="0">BASE</option>
			</select>
			<input type="submit" class="submit-button" value="Save Page" /> <?=isset($msg)?$msg:'';?>
		</div>
		
		<div class="page_title">
			<input name="title" value="<?=htmlspecialchars($wiki['title'], ENT_QUOTES);?>" />
		</div>
		<div class="save-page-button">
			<h3>Subwikis</h3>
		</div>
		<ol class="wiki-list">
			<?php if($sub_wikis != null)
				foreach($sub_wikis[1] as $subwiki): ?>
			<li>
				<a <?=jsprompt('Are you sure you want to delete this?');?> class="delete_item" href="%appurl%rmbyname/<?=urlencode($subwiki);?>/">x</a> 
				<a href="%appurl%editbyname/<?=urlencode($subwiki);?>/"><?=$subwiki;?></a>
			</li>
			<?php endforeach;
				else
				echo '<li>No articles found. Create one above.</li>'; ?>
		</ol>
		<textarea id="ckeditor" name="content"><?=htmlspecialchars($wiki['content'], ENT_QUOTES);?></textarea>
	</form>
	<?php readfile(ROOT.'system/lib/editor.js'); ?>
</div>