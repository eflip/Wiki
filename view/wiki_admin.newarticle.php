<div class="wiki-wrapper">
	<form class="wiki_edit_article" action="%baseurl%apps/manage/wiki/newarticle/" method="post">
		<div class="save-page-button">
			<input type="submit" class="submit-button" value="Save Page" /> <?=isset($msg)?$msg:'';?>
		</div>
		<div class="page_title">
			Parent: <select name="parent" id="">
				<option value="0">BASE</option>
			</select>
			<input name="title" placeholder="Page Title" />
		</div>
		<textarea id="ckeditor" name="content"></textarea>
	</form>
	<?php readfile(ROOT.'system/lib/editor.js'); /* ckeditor */ ?>
</div>