<?php
namespace gossi\freestyle\model;

use phootwork\collection\ArrayList;

class Routine {
	
	private $id;
	private $name;
	
	private $group;
	
	private $performaceScores;
	
	public function __construct($id, $name) {
		$this->id = $id;
		$this->name = $name;
		$this->performaceScores = new ArrayList();
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function setStartGroup(StartGroup $group) {
		$this->group = $group;
		$this->group->addRoutine($this);
	}
	
	/**
	 * @return StartGroup
	 */
	public function getStartGroup() {
		return $this->group;
	}
	
	public function addScore(Score $score) {
		if ($score instanceof PerformanceScore) {
			$this->performaceScores->add($score);
		}
	}
	
	public function getPerformanceTotal() {
		$sum = 0;
		foreach ($this->performaceScores as $score) {
			$sum += $score->getTotal();
		}
		
		return round($sum / $this->performaceScores->size(), 3);
	}
	
	public function getPerformanceScores() {
		return $this->performaceScores;
	}

	/**
	 * 
	 * @param int $i
	 * @return PerformanceScore
	 */
	public function getPerformanceScore($i) {
		return $this->performaceScores->get($i - 1);
	}
}
