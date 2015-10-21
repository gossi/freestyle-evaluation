<?php
namespace gossi\freestyle\model;

class PerformanceScore extends Score {
	
	private $execution;
	private $choreography;
	private $music;
	
	/**
	 *
	 * @return float
	 */
	public function getExecution() {
		return $this->execution;
	}
	
	/**
	 *
	 * @param float $execution
	 */
	public function setExecution($execution) {
		$this->execution = $execution;
		return $this;
	}
	
	/**
	 *
	 * @return float
	 */
	public function getChoreography() {
		return $this->choreography;
	}
	
	/**
	 *
	 * @param float $choreography
	 */
	public function setChoreography($choreography) {
		$this->choreography = $choreography;
		return $this;
	}
	
	/**
	 *
	 * @return float
	 */
	public function getMusicAndTiming() {
		return $this->music;
	}
	
	/**
	 *
	 * @param float $music
	 */
	public function setMusicAndTiming($music) {
		$this->music = $music;
		return $this;
	}
	
	public function getTotal() {
		return $this->execution + $this->choreography + $this->music;
	}
}