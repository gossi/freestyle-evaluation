<?php 
require_once __DIR__ . '/vendor/autoload.php';

use gossi\freestyle\importer\ODM2015Importer;
use gossi\freestyle\analytics\PerformanceAnalyzer;
use gossi\freestyle\model\PerformanceResults;

$importer = new ODM2015Importer(__DIR__ . '/data/odm-2015.csv');

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, []);

// run analytics
$analyzer = new PerformanceAnalyzer();
$results = new PerformanceResults();

foreach ($importer->getStartGroups() as $group) {
	foreach ($group->getRoutines() as $routine) {
		$results->addTotal($routine, $analyzer->analyze($routine));
		$results->addExecution($routine, $analyzer->analyze($routine, 'execution'));
		$results->addChoreography($routine, $analyzer->analyze($routine, 'choreography'));
		$results->addMusicAndTiming($routine, $analyzer->analyze($routine, 'music'));
	}
}

echo $twig->render('index.twig', [
	'groups' => $importer->getStartGroups(),
	'results' => $results
]);
