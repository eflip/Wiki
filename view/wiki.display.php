<div class="row">
	<div class="col-9">
		<?php


	//	echo '<h3 style="margin-top:0">';
		if($wiki['parent'] != 0)
			echo 'Back to <a href="%appurl%byid/'.$wiki['parent'].'">'.wiki_orm::idToTitle($wiki['parent']).'</a>';
		else
			echo 'Back to <a href="%appurl%index">Index</a>';


		echo '<h2><a href="?">'.$wiki['title'].'</a></h2>';


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
		
		include 'lib/Parsedown/Parsedown.php';
		$Parsedown = new Parsedown();

		echo $Parsedown->text($wiki['content']); 
		//echo $wiki['content'];

		?>
	</div>
	<div class="col-3">
		<?=$this->sidebar();?>
	</div>
</div>

