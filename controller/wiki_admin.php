<link href="%relbase%lf/apps/wiki/css/wiki_admin.style.css" rel="stylesheet">
<?php

class wiki_admin extends app
{
	public $table = 'wiki_pages';
	
	public function main($args)
	{
		// print heirarchy
		$wikis = wiki_orm::index();
		include 'view/wiki_admin.index.php';
	}
	
	public function edit($args)
	{
		// Get root wiki, link to all [[SubWikis]] linked within.
		$wiki = wiki_orm::getroot();
		
		//$wiki = wiki_orm::getorphaned();
		
		$inc = "new";
		if($wiki != array())
		{
			$inc = "edit";
			$sub_wikis = wiki_orm::parse($wiki['content']);
		}
		
		include "view/wiki_admin.$inc.php";
	}
	
	// Get wiki by name, link to all [[SubWikis]] linked within.
	public function editbyalias($args)
	{
		$wiki = wiki_orm::getbyalias(urldecode($args[1]));
		
		$inc = "new";
		if($wiki != array())
		{
			$inc = "edit";
			$sub_wikis = wiki_orm::parse($wiki['content']);
		}
		
		include "view/wiki_admin.$inc.php";
	}
	
	public function byid($args)
	{
		$this->editbyid($args);
	}
	
	public function editbyid($args)
	{
		if(!isset($args[1])) $args[1] = 0;
		$wiki = wiki_orm::getbyid(intval($args[1]));
		
		$inc = "new";
		if($wiki != array())
		{
			$inc = "edit";
			$sub_wikis = wiki_orm::parse($wiki['content']);
		}
		
		include "view/wiki_admin.$inc.php";
	}
	
	public function update($args)
	{
		$id = intval($args[1]);
		if(count($_POST) > 0)
			wiki_orm::savepage($id, $_POST);
			
		redirect302();
	}
	
	/*public function edit($args)
	{
		$page = wiki_orm::getpage($id);
		
		include 'view/wiki_admin.edit.php';
	}*/
	
	public function rm($args)
	{
		wiki_orm::rmpage(intval($args[1]));
		redirect302($this->lf->appurl.'index');
	}
	
	public function newwiki($args)
	{		
		if(count($_POST) > 0)
		{
			$name = wiki_orm::addpage($_POST);
			redirect302($this->lf->appurl.'editbyid/'.$name);
		}
		
		//include 'view/wiki_admin.newarticle.php';
	}
}