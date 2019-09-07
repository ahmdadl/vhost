<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\FileHandler;

$file = new FileHandler;

$file->unCommentVHosts();