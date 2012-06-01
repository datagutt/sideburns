<?php
class Page{
	
	private $m;
	
	protected $title = "";
	
	protected $prefix = "";
	
	public function __construct($m){
		$this->m = $m;
	}
	
	public function _pageStart(){
		$this->render("header", array(
			"THEME_DIR" => "/themes/default",
			"SITE_TITLE" => $this->title,
			"SITE_TITLE_PREFIX" => $this->prefix
		));
	}
	
	public function _pageEnd(){
		$this->render("footer");
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function setTitle($title){
		$this->title = $title;
	}
	
	public function getPrefix(){
		return $this->prefix;
	}
	
	public function setPrefix($prefix){
		$this->prefix = $prefix;
	}
	
	public function render($file, $options = array()){
		$filename = TEMPLATE_DIR . $file . ".html";
		if(!file_exists($filename)){
			throw new Exception("Cant find the template for $file");
		}
		ob_start();
		require($filename);
		$content = ob_get_contents();
		ob_end_clean();
		echo $this->m->render($content, $options);
	}
	
	public function get(){
		
	}
	public function post(){
		
	}
}