<div class="row">
	<div class="col-9">
		<?php

		if($wiki['parent'] != 0)
			echo 'Back to <a href="%appurl%byid/'.$wiki['parent'].'">'.(new wikiModel)->idToTitle($wiki['parent']).'</a>';
		else
			echo 'Back to <a href="%appurl%">Index</a>';


		echo '<h2><a href="?">'.$wiki['title'].'</a></h2>';
		
		include LF.'system/lib/3rdparty/parsedown/Parsedown.php';
		$Parsedown = new Parsedown();
		echo $Parsedown->text( $this->wikiLinks($wiki['content']) ); 

		?>
	</div>
	<div class="col-3">
		<?=$this->sidebar();?>
	</div>
</div>