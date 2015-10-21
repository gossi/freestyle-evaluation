<?php
namespace gossi\freestyle\model;

use phootwork\collection\ArrayList;

class StartGroup {
	
	private $title;
	
	private $routines;
	
	private $performanceJudges;
	
	public function __construct($title, $judges = 5) {
		$this->title = $title;
		$this->routines = new ArrayList();
		$this->performanceJudges = new ArrayList();
		
		for ($i = 1; $i <= $judges; $i++) {
			$this->performanceJudges->add(new Judge('P' . $i));
		}
	}
	
	public function getTitle() {
		return $this->title;
	}

	public function getP1() {
		return $this->getPerformanceJudge(1);
	}

	public function getP2() {
		return $this->getPerformanceJudge(2);
	}

	public function getP3() {
		return $this->getPerformanceJudge(3);
	}

	public function getP4() {
		return $this->getPerformanceJudge(4);
	}

	public function getP5() {
		return $this->getPerformanceJudge(5);
	}

	/**
	 * 
	 * @return Judge
	 */
	public function getPerformanceJudge($position) {
		return $this->performanceJudges->get($position - 1);
	}
	
	/**
	 * @return ArrayList<Judge>
	 */
	public function getPerformanceJudges() {
		return $this->performanceJudges;
	}
	
	public function addRoutine(Routine $routine) {
		if (!$this->routines->contains($routine)) {
			$this->routines->add($routine);
			$routine->setStartGroup($this);
		}
	}
	
	/**
	 * @return ArrayList<Routine>
	 */
	public function getRoutines() {
		return $this->routines;
	}
}