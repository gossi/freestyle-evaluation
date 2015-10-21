<?php
namespace gossi\freestyle\analytics;

use gossi\freestyle\model\Routine;

class PerformanceResult {
	
	private $routine;
	private $min;
	private $max;
	private $range;
	private $avg;
	private $sd;
	private $variance;
	
	public function __construct(Routine $routine) {
		$this->routine = $routine;
	}
	
	/**
	 *
	 * @return Routine
	 */
	public function getRoutine() {
		return $this->routine;
	}
	
	/**
	 *
	 * @return float
	 */
	public function getMin() {
		return $this->min;
	}
	
	/**
	 *
	 * @param float $min        	
	 */
	public function setMin($min) {
		$this->min = $min;
		return $this;
	}
	
	/**
	 *
	 * @return float
	 */
	public function getMax() {
		return $this->max;
	}
	
	/**
	 *
	 * @param float $max        	
	 */
	public function setMax($max) {
		$this->max = $max;
		return $this;
	}
	
	/**
	 *
	 * @return float
	 */
	public function getAvg() {
		return $this->avg;
	}
	
	/**
	 *
	 * @param float $avg        	
	 */
	public function setAvg($avg) {
		$this->avg = $avg;
		return $this;
	}
	
	/**
	 *
	 * @return float
	 */
	public function getSd() {
		return $this->sd;
	}
	
	/**
	 *
	 * @param float $sd        	
	 */
	public function setSd($sd) {
		$this->sd = $sd;
		return $this;
	}
	
	/**
	 *
	 * @return float
	 */
	public function getVariance() {
		return $this->variance;
	}
	
	/**
	 *
	 * @param float $variance        	
	 */
	public function setVariance($variance) {
		$this->variance = $variance;
		return $this;
	}	
	
	public function setRange($range) {
		$this->range = $range;
		return $this;
	}
	
	public function getRange() {
		return $this->range;
	}
}
