<?php

class wiki extends app
{
	public $table = 'wiki_pages';
	
	public function init($args)
	{
		//$customSidebar = orm::qWiki('wiki');
		
		
	}
	
	public function sidebar()
	{
		
		
		$wikis = wiki_orm::index();
		include 'view/wiki.sidebar.php';
	}	
	
	public function main($args)
	{
		// Get root wiki, link to all [[SubWikis]] linked within.
		//$wiki = wiki_orm::getroot();
		
		
				
		return $this->byid(array('lolz', $this->ini));
		/*
		//$wiki = wiki_orm::getorphaned();
		
		$inc = "404";
		if($wiki != array())
		{
			$inc = "display";
			$sub_wikis = wiki_orm::parse($wiki['content']);
			
			foreach($sub_wikis as $subwiki)
			{
				$wiki['content']= str_replace(
					'[['.$subwiki.']]', 
					'<a href="%appurl%byname/'.urlencode($subwiki).'">'.$subwiki.'</a>', 
					$wiki['content']);
			}
			
		}
		
		include "view/wiki.$inc.php";*/
	}
	
	public function byname($args)
	{
		// Get root wiki, link to all [[SubWikis]] linked within.
		$wiki = wiki_orm::getbyalias(urldecode($args[1]));
		
		//$wiki = wiki_orm::getorphaned();
		
		$inc = "404";
		if($wiki != array())
		{
			$inc = "display";
			$sub_wikis = wiki_orm::parse($wiki['content']);
			
			foreach($sub_wikis as $subwiki)
			{
				$wiki['content']= str_replace(
					'[['.$subwiki.']]', 
					'<a href="%appurl%byname/'.urlencode($subwiki).'">'.$subwiki.'</a>', 
					$wiki['content']);
			}
		}
		
		include "view/wiki.$inc.php";
	}
	
	public function byid($args)
	{
		// Get root wiki, link to all [[SubWikis]] linked within.
		$wiki = wiki_orm::getbyid(intval($args[1]));
		
		//$wiki = wiki_orm::getorphaned();
		
		$inc = "404";
		if($wiki != array())
		{
			$inc = "display";
			$sub_wikis = wiki_orm::parse($wiki['content']);
			
			foreach($sub_wikis as $subwiki)
			{
				$wiki['content']= str_replace(
					'[['.$subwiki.']]', 
					'<a href="%appurl%byname/'.urlencode($subwiki).'">'.$subwiki.'</a>', 
					$wiki['content']);
			}
		}
		
		include "view/wiki.$inc.php";
	}
}