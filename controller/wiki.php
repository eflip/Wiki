<?php

class wiki extends app
{	
	
	public function main()
	{
		// Get root wiki, link to all [[SubWikis]] linked within.
		//$wiki = (new wikiModel)->getroot();
		
		if(isset($this->lf->vars[0]) && $this->lf->vars[0] != 'main')
		{
			$alias = $this->lf->vars[0];
			$wiki = (new wikiModel)->byAlias($alias)->get();
			include 'view/wiki.main.php';
		}
		else 
		{
			echo '<h2>Wiki Index</h2>';
			echo (new wikiModel)->getTree();
		}
		
		
		
		
		
		
				
		//return $this->byid(array('lolz', $this->ini));
		
		
		
		
		/*
		//$wiki = (new wikiModel)->getorphaned();
		
		$inc = "404";
		if($wiki != array())
		{
			$inc = "display";
			$sub_wikis = (new wikiModel)->parse($wiki['content']);
			
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
	
	public function sidebar()
	{
		$wikis = (new wikiModel)->getTree();
		include 'view/wiki.sidebar.php';
	}	
	
	public function wikiLinks($content)
	{
		$sub_wikis = (new wikiModel)->parse($content);
			
		foreach($sub_wikis as $subwiki)
		{
			$content = str_replace(
				'[['.$subwiki.']]', 
				'<a href="%appurl%'.urlencode($subwiki).'">'.$subwiki.'</a>', 
				$content
			);
		}
		
		return $content;
	}
	
	public function byname($args)
	{
		// Get root wiki, link to all [[SubWikis]] linked within.
		$wiki = (new wikiModel)->getbyalias(urldecode($args[1]));
		
		//$wiki = (new wikiModel)->getorphaned();
		
		$inc = "404";
		if($wiki != array())
		{
			$inc = "main";
			$wiki['content'] = $this->wikiLinks($wiki['content']);
		}
		
		include "view/wiki.$inc.php";
	}
	
	public function byid($args)
	{
		// Get root wiki, link to all [[SubWikis]] linked within.
		$wiki = (new wikiModel)->getbyid(intval($args[1]));
		
		//$wiki = (new wikiModel)->getorphaned();
		
		$inc = "404";
		if($wiki != array())
		{
			$inc = "main";
			$wiki['content'] = $this->wikiLinks($wiki['content']);
		}
		
		include "view/wiki.$inc.php";
	}
}