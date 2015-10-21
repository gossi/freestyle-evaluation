<?php
namespace gossi\freestyle\model;

class Judge {
	
	private $name;
	
	public function __construct($name) {
		$this->name = $name;
	}
	
	public function getName() {
		return $this->name;
	}
}