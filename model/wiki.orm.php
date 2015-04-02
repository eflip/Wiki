<?php

class wiki_orm extends orm
{
		
	public function getroot()
	{			
		return wiki_orm::q()->filterByparent(0)->first();
	}
	
	public function getbyalias($name)
	{
		return wiki_orm::q()->filterByalias($name)->first();
	}
	
	public function getbyid($id)
	{
		return wiki_orm::q()->filterByid($id)->first();
	}
	
	public function parse($content)
	{
		preg_match_all('/\[\[([^\]]+)\]\]/', $content, $ret);
		
		return $ret[1];
	}
	
	public function idToAlias($id)
	{
		$id = intval($id);
		$result = wiki_orm::q()->cols('alias')->filterByid($id)->first();
		return $result['alias'];
	}
	public function idToTitle($id)
	{
		$id = intval($id);
		$result = wiki_orm::q()->cols('title')->filterByid($id)->first();
		return $result['title'];
	}
	
	
	public function index($parent = 0)
	{
		$tree = array();
		
		$result = wiki_orm::q()->get();
		foreach($result as $row)
			$tree[$row['parent']][$row['id']] = $row;
		
		return wiki_orm::treeToUL($tree);
	}
	
	public function treeToUL($tree, $parent = 0)
	{
		ob_start();
		echo '<ul class="efvlist" id="wiki_tree">';
		foreach($tree[$parent] as $id => $row)
		{
			echo '<li><a href="%appurl%byid/'.$id.'">'.$row['alias'].'</a>';
			if(isset($tree[$id]))
				echo wiki_orm::treeToUL($tree, $id);
			echo '</li>';
		}
		echo '</ul>';
		return ob_get_clean();
	}
	
	public function selectparent()
	{
		$tree = array();
		
		$result = wiki_orm::q()->get();
		foreach($result as $row)
			$tree[$row['parent']][$row['id']] = $row;
		
		return wiki_orm::treeToOptions($tree);
	}
	
	public function treeToOptions($tree, $parent = 0, $level = 0)
	{
		ob_start();
		//echo '<optgroup label="Parent: '.$parent.'">
		//';
		foreach($tree[$parent] as $id => $row)
		{
			echo '<option style="margin-left: '.($level*10).'px" value="'.$id.'">'.$row['alias'].'</option>
			';
			if(isset($tree[$id]))
				echo wiki_orm::treeToOptions($tree, $id, $level + 1);
			
		}
		//echo '</optgroup>
		//';
		return ob_get_clean();
	}
	
	public function all()
	{
		return orm::q()->cols('id, title')->order()->get();
	}
	
	public function getpage($id)
	{
		return orm::q()->filterByid($id)->first();
	}
	
	public function rmpage($id)
	{
		//return orm::q('wiki_pages')->filterByid($id)->delete();
		orm::q()->filterByparent($id)->setparent(0)->save(); // reset orphaned wikis to index
		orm::q()->filterByid($id)->delete(); // drop given wiki
	}
	
	public function savepage($id, $data)
	{
		$page = orm::q('wiki_pages')->filterByid($id);
		foreach($data as $col => $val)
		{
			$setcol = "set$col";
			$page->$setcol($val);
		}
		$page->save();
	}
	
	public function addpage($data)
	{
		$insert = orm::q('wiki_pages')->add();
		foreach($data as $col => $val)
		{
			$setcol = "set$col";
			$insert->$setcol($val);
		}
		return $insert->save();
	}
}