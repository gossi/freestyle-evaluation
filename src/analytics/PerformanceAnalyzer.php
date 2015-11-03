<?php
namespace gossi\freestyle\analytics;

use gossi\freestyle\model\Routine;

class PerformanceAnalyzer {
	
	/**
	 * @param Routine $routine
	 * @param string $target
	 * @return PerformanceResult
	 */
	public function analyze(Routine $routine, $target = 'total') {
		$methods = [
			'total' => 'getTotal',
			'execution' => 'getExecution',
			'choreography' => 'getChoreography',
			'music' => 'getMusicAndTiming'
		];
		
		$method = $methods[$target];
		$result = new PerformanceResult($routine);
		
		$sum = 0;
		$min = 30;
		$max = 0;
		
		foreach ($routine->getPerformanceScores() as $score) {
			$val = $score->$method();
			$min = min($min, $val);
			$max = max($max, $val);
			$sum += $val;
		}
		
		$avg = $sum / $routine->getPerformanceScores()->size();
		
		$result->setMin($min);
		$result->setMax($max);
		$result->setAvg($avg);
		$result->setRange(abs($max - $min));
		
		// sd + v
		$sum = 0;
		foreach ($routine->getPerformanceScores() as $score) {
			$val = $score->$method();
			$sum += pow(($val - $avg), 2);
		}
		
		$sd = 1 / ($routine->getPerformanceScores()->size() - 1) * $sum;
		$v = sqrt($sd);
		
		$result->setSd($sd);
		$result->setVariance($v);
		
		return $result;
	}

}