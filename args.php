<?php

	$sql = 'SELECT id, title FROM wiki_pages';
	$this->db->query($sql);
	$wiki = $this->db->fetchall();
	
	if(count($wiki))
	{
		$args = 'Default to <select name="ini" id="">
			<option value="0">-- Show Index --</option>';
		foreach($wiki as $page)
			$args .= '<option value="'.$page['id'].'">'.$page['id'].' - '.$page['title'].'</option>';
		$args .= '</select> or ';
		
		$args = str_replace('value="'.$save['ini'].'"', 'value="'.$save['ini'].'" selected="selected"', $args);
	}
	
	$args .= '<a href="%baseurl%apps/manage/wiki/editbyalias/new/">Create New Wiki</a>';
?>