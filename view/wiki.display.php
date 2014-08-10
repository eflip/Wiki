<div style="margin-right: 300px;">
	<?php

	echo '<h3 style="margin-top:0">';
	if($wiki['parent'] != 0)
		echo '<a href="%appurl%byid/'.$wiki['parent'].'">'.wiki_orm::idToTitle($wiki['parent']).'</a> > ';
	else
		echo '<a href="%appurl%index">Index</a> > ';


	echo '<a href="?">'.$wiki['title'].'</a></h3>';


	/*
	if($sub_wikis != null)
	{
		echo '<div style="border: blue; background: lightblue;">
			<h4>SubWikis</h4>';
		foreach($sub_wikis as $subwiki): ?>

					<a href="%appurl%byname/<?=urlencode($subwiki);?>/"><?=$subwiki;?></a>
	<?php 

			echo '	</div>';

		endforeach;

	}*/

	echo $wiki['content'];

	?>
</div>