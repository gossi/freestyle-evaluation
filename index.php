<?php 
require_once __DIR__ . '/vendor/autoload.php';

use gossi\freestyle\importer\ODM2015Importer;
use gossi\freestyle\analytics\PerformanceAnalyzer;

$importer = new ODM2015Importer(__DIR__ . '/data/odm-2015.csv');

$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, []);

echo $twig->render('index.twig', [
	'groups' => $importer->getStartGroups(),
	'analyzer' => new PerformanceAnalyzer()
]);
?>