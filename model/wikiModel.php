<?php

class wikiModel extends orm
{
	protected $table = 'wiki_pages';
	
	public function getTree()
	{
		$tree = array();
		
		$result = $this->getAll();
		foreach($result as $row)
			$tree[$row['parent']][$row['id']] = $row;
		
		return $this->treeToUL($tree);
	}
	
	public function treeToUL($tree, $parent = 0)
	{
		ob_start();
		echo '<ul class="efvlist" id="wiki_tree">';
		foreach($tree[$parent] as $id => $row)
		{
			echo '<li><a href="%appurl%'.$row['alias'].'">'.$row['alias'].'</a>';
			if(isset($tree[$id]))
				echo $this->treeToUL($tree, $id);
			echo '</li>';
		}
		echo '</ul>';
		return ob_get_clean();
	}
	
	public function getroot()
	{
		return $this->filterByparent(0)->first();
	}
	
	public function getbyalias($name)
	{
		return $this->filterByalias($name)->first();
	}
	
	public function getbyid($id)
	{
		return $this->filterByid($id)->first();
	}
	
	public function parse($content)
	{
		preg_match_all('/\[\[([^\]]+)\]\]/', $content, $ret);
		
		return $ret[1];
	}
	
	public function idToAlias($id)
	{
		$id = intval($id);
		$result = $this->cols('alias')->filterByid($id)->first();
		return $result['alias'];
	}
	public function idToTitle($id)
	{
		$id = intval($id);
		$result = $this->cols('title')->filterByid($id)->first();
		return $result['title'];
	}
	
	public function selectparent()
	{
		$tree = array();
		
		foreach($this->getAll() as $row)
			$tree[$row['parent']][$row['id']] = $row;
		
		return $this->treeToOptions($tree);
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
				echo $this->treeToOptions($tree, $id, $level + 1);
			
		}
		//echo '</optgroup>
		//';
		return ob_get_clean();
	}
	
	public function all()
	{
		return $this->cols('id, title')->order()->get();
	}
	
	public function getpage($id)
	{
		return $this->filterByid($id)->first();
	}
	
	public function rmpage($id)
	{
		//return orm::q('wiki_pages')->filterByid($id)->delete();
		$this->filterByparent($id)->setparent(0)->save(); // reset orphaned wikis to index
		$this->filterByid($id)->delete(); // drop given wiki
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