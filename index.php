<?php

declare(strict_types=1);

namespace App;

use App\Exception\AppException;
use App\Exception\ConfigurationException;
use Throwable;

require_once("src/Utils/debug.php");
require_once("src/Controller.php");
require_once("src/Exception/AppException.php");

$configuration = require_once("config/config.php");

$request = [
    'get' => $_GET,
    'post' => $_POST
];

try {

    Controller::initConfiguration($configuration);
    
    $controller = new Controller($request);
    $controller->run();

} catch (ConfigurationException $e) {
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    echo 'Problem z konfiguracją bazy danych. Prosze skontaktować się z administratorem Panem Mateusz Machal i poprosić o audiencję.';
} catch (AppException $e) {
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    echo "<h3>" . $e->getMessage() . "</h3>";
} catch (Throwable $e) {
    echo "<h1>Wystąpił błąd w aplikacji</h1>";
    dump($e);
    echo "dupa";
}
