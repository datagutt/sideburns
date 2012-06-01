<?php
class Index extends Page{
	protected $prefix = "Index";
	
	public function get(){
		parent::render("index");
	}
}