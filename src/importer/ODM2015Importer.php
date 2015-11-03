<?php
namespace gossi\freestyle\importer;

use League\Csv\Reader;
use phootwork\collection\Set;
use phootwork\collection\Map;
use gossi\freestyle\model\StartGroup;
use gossi\freestyle\model\Routine;
use gossi\freestyle\model\PerformanceScore;

class ODM2015Importer {
	
	private $filename;
	private $csv;
	
	public function __construct($filename) {
		$this->filename = $filename;
		$this->csv = Reader::createFromPath($filename);
		$this->csv->setDelimiter(';');
		
		$this->parse();
	}
	
	private function parse() {
		// get startgroups at first
		$groups = new Set();
		
		foreach ($this->csv->fetchColumn(0) as $group) {
			if (!empty($group)) {
				$groups->add($this->translate($group));
			}
		}
		
// 		echo '<pre>';
// 		print_r($groups->toArray());

		$this->groups = new Map();
		foreach ($groups as $name) {
			$this->groups->set($name, new StartGroup($name));
		}
		
		$this->routines = new Map();
		foreach ($this->csv as $row) {
			
			if (!isset($row[2])) {
				continue;
			}
			$id = $row[2];
			
			$routine = $this->getRoutine($id);
			$group = $this->getStartGroup($row[0]);
			
			$p1 = new PerformanceScore($routine, $group->getP1());
			$p1->setExecution($row[3]);
			$p1->setChoreography($row[4]);
			$p1->setMusicAndTiming($row[5]);
			$routine->addScore($p1);
			
			$p2 = new PerformanceScore($routine, $group->getP2());
			$p2->setExecution($row[8]);
			$p2->setChoreography($row[9]);
			$p2->setMusicAndTiming($row[10]);
			$routine->addScore($p2);
			
			$p3 = new PerformanceScore($routine, $group->getP3());
			$p3->setExecution($row[13]);
			$p3->setChoreography($row[14]);
			$p3->setMusicAndTiming($row[15]);
			$routine->addScore($p3);
			
			$p4 = new PerformanceScore($routine, $group->getP4());
			$p4->setExecution($row[18]);
			$p4->setChoreography($row[19]);
			$p4->setMusicAndTiming($row[20]);
			$routine->addScore($p4);
			
			$p5 = new PerformanceScore($routine, $group->getP5());
			$p5->setExecution($row[23]);
			$p5->setChoreography($row[24]);
			$p5->setMusicAndTiming($row[25]);
			$routine->addScore($p5);
			
			$group->addRoutine($routine);
		}
	}
	
	private function translate($string) {
		$search = ['weiblich', 'maennlich', 'Einzelkuer', 'Paarkuer', 'Kleingruppen', 'Grossgruppen'];
		$replace = ['female', 'male', 'Individual', 'Pairs', 'Small Group', 'Large Group'];
		
		return str_replace($search, $replace, $string);
	}
	
	/**
	 * @param string $name
	 * @return StartGroup
	 */
	private function getStartGroup($name) {
		return $this->groups->get($this->translate($name));
	}
	
	private function getRoutine($id) {
		if (!$this->routines->has($id)) {
			$this->routines->set($id, new Routine($id, 'Routine #' . $id));
		}

		return $this->routines->get($id);
	}
	
	public function getStartGroups() {
		return $this->groups;
	}
}
