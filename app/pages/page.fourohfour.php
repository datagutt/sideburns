<?php
class FourOhFour extends Page{
	protected $prefix = "Page not found";
	
	public function get(){
		parent::render("404");
	}
}