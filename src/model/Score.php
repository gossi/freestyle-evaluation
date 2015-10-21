<?php
namespace gossi\freestyle\model;

abstract class Score {
	
	protected $judge;
	protected $routine;
	
	public function __construct(Routine $routine, Judge $judge) {
		$this->routine = $routine;
		$this->judge = $judge;
	}
	
	public abstract function getTotal();

	/**
	 * @return Judge
	 */
	public function getJudge() {
		return $this->judge;
	}
	
	/**
	 * @return Routine
	 */
	public function getRoutine() {
		return $this->routine;
	}
	
}
