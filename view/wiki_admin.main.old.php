<div class="wiki-wrapper">
	<div class="new-page-button">
		<a href="%baseurl%apps/manage/wiki/newarticle/">Create New Wiki Page</a>
	</div>
	<ol class="wiki-list">
		<?php if($root_wiki != null)
			foreach($wiki as $page): ?>
		<li><a <?=jsprompt('Are you sure you want to delete this?');?> class="delete_item" href="%baseurl%apps/manage/wiki/rm/<?=$page['id'];?>/">x</a> <a href="%baseurl%apps/manage/wiki/edit/<?=$page['id'];?>/"><?=$page['title'];?></a></li>
		<?php endforeach;
			else
			echo '<li>No articles found. Create one above.</li>'; ?>
	</ol>
</div>