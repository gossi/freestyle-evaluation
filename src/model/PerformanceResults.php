<?php
namespace gossi\freestyle\model;

use gossi\freestyle\analytics\PerformanceResult;
use phootwork\collection\Map;

class PerformanceResults {

	private $total;
	private $execution;
	private $choreography;
	private $music;
	
	private $averageTotal;
	private $averageExecution;
	private $averageChoreography;
	private $averageMusic;
	
	public function __construct() {
		$this->total = new Map();
		$this->execution = new Map();
		$this->choreography = new Map();
		$this->music = new Map();
	}
	
	/**
	 * @param Routine $routine
	 * @param PerformanceResult $result
	 */
	public function addTotal(Routine $routine, PerformanceResult $result) {
		$this->total->set($routine->getId(), $result);
	}
	
	/**
	 * @param Routine $routine
	 * @return PerformanceResult
	 */
	public function getTotal(Routine $routine) {
		return $this->total->get($routine->getId());
	}
	
	/**
	 * @param Routine $routine
	 * @param PerformanceResult $result
	 */
	public function addExecution(Routine $routine, PerformanceResult $result) {
		$this->execution->set($routine->getId(), $result);
	}
	
	/**
	 * @param Routine $routine
	 * @return PerformanceResult
	 */
	public function getExecution(Routine $routine) {
		return $this->execution->get($routine->getId());
	}
	
	/**
	 * @param Routine $routine
	 * @return PerformanceResult
	 */
	public function getChoreography(Routine $routine) {
		return $this->choreography->get($routine->getId());
	}
	
	/**
	 * @param Routine $routine
	 * @param PerformanceResult $result
	 */
	public function addChoreography(Routine $routine, PerformanceResult $result) {
		$this->choreography->set($routine->getId(), $result);
	}
	
	/**
	 * @param Routine $routine
	 * @param PerformanceResult $result
	 */
	public function addMusicAndTiming(Routine $routine, PerformanceResult $result) {
		$this->music->set($routine->getId(), $result);
	}
	
	/**
	 * @param Routine $routine
	 * @return PerformanceResult
	 */
	public function getMusicAndTiming(Routine $routine) {
		return $this->music->get($routine->getId());
	}
	
	private function calculateAverage(Map $list) {
		$range = 0;
		$min = 0;
		$max = 0;
		$sd = 0;
		$v = 0;
		
		foreach ($list as $score) {
			$range += $score->getRange();
			$min += $score->getMin();
			$max += $score->getMax();
			$sd += $score->getSd();
			$v += $score->getVariance();
		}
		
		$result = new PerformanceResult();
		$result->setMin($min / $this->total->size());
		$result->setMax($max / $this->total->size());
		$result->setRange($range / $this->total->size());
		$result->setSd($sd / $this->total->size());
		$result->setVariance($v / $this->total->size());
		
		return $result;
	}
	
	/**
	 * @return PerformanceResult
	 */
	public function getAverageTotal() {
		if ($this->averageTotal === null) {
			$this->averageTotal = $this->calculateAverage($this->total);
		}
		return $this->averageTotal;
	}
	
	/**
	 * @return PerformanceResult
	 */
	public function getAverageExecution() {
		if ($this->averageExecution === null) {
			$this->averageExecution = $this->calculateAverage($this->execution);
		}
		return $this->averageExecution;
	}
	
	/**
	 * @return PerformanceResult
	 */
	public function getAverageChoreography() {
		if ($this->averageChoreography === null) {
			$this->averageChoreography = $this->calculateAverage($this->choreography);
		}
		return $this->averageChoreography;
	}
	
	/**
	 * @return PerformanceResult
	 */
	public function getAverageMusicAndTiming() {
		if ($this->averageMusic === null) {
			$this->averageMusic = $this->calculateAverage($this->music);
		}
		return $this->averageMusic;
	}

}
