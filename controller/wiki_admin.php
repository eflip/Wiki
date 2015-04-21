<link href="%relbase%lf/apps/wiki/css/wiki_admin.style.css" rel="stylesheet">
<?php

class wiki_admin extends app
{
	public function main($args)
	{
		if(isset($this->lf->vars[0]) && $this->lf->vars[0] != 'main')
			return $this->editbyalias($this->lf->vars[0]);
		
		$wikis = (new wikiModel)->getTree();
		include 'view/wiki_admin.index.php';
	}
	
	public function edit($args)
	{
		// Get root wiki, link to all [[SubWikis]] linked within.
		$wiki = (new wikiModel)->getroot();
		
		//$wiki = (new wikiModel)->getorphaned();
		
		$inc = "new";
		if($wiki != array())
		{
			$inc = "edit";
			$sub_wikis = (new wikiModel)->parse($wiki['content']);
		}
		
		include "view/wiki_admin.$inc.php";
	}
	
	public function byid($args)
	{
		$this->editbyid($args);
	}
	
	private function editbyalias($alias)
	{
		$wiki = (new wikiModel)->getbyalias($alias);
		
		$inc = "new";
		if($wiki != array())
		{
			$inc = "edit";
			$sub_wikis = (new wikiModel)->parse($wiki['content']);
		}
		
		include "view/wiki_admin.$inc.php";
	}
	
	public function editbyid($args)
	{
		if(!isset($args[1])) $args[1] = 0;
		$wiki = (new wikiModel)->getbyid(intval($args[1]));
		
		$inc = "new";
		if($wiki != array())
		{
			$inc = "edit";
			$sub_wikis = (new wikiModel)->parse($wiki['content']);
		}
		
		include "view/wiki_admin.$inc.php";
	}
	
	public function update($args)
	{
		$id = intval($args[1]);
		if(count($_POST) > 0)
			(new wikiModel)->savepage($id, $_POST);
			
		redirect302();
	}
	
	/*public function edit($args)
	{
		$page = (new wikiModel)->getpage($id);
		
		include 'view/wiki_admin.edit.php';
	}*/
	
	public function rm($args)
	{
		(new wikiModel)->rmpage(intval($args[1]));
		redirect302($this->lf->appurl.'index');
	}
	
	public function newwiki($args)
	{		
		if(count($_POST) > 0)
		{
			$name = (new wikiModel)->addpage($_POST);
			redirect302($this->lf->appurl.'editbyid/'.$name);
		}
		
		//include 'view/wiki_admin.newarticle.php';
	}
}