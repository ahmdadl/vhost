<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Cmd\AddVH;
use App\Cmd\Interactive;

use Symfony\Component\Console\Application;

$app = new Application('xamp-vh', '1.0.0');

$app->add(new Interactive('i'));
$app->add(new AddVH('add'));

$app->run();