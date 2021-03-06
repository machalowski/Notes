<?php

declare(strict_types=1);

namespace App;

use App\Exception\ConfigurationException;

require_once("src/Exception/ConfigurationException.php");
require_once("src/Database.php");
require_once("src/View.php");

class Controller
{
    private const DEFAULT_ACTION = 'list';

    private static array $configuration = [];

    private Database $database;
    private array $request;
    private View $view;

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;
    }

    public function __construct(array $request)
    {
        if (empty(self::$configuration['db'])) {
            throw new ConfigurationException("Configuration error");
        }

        $this->request = $request;
        $this->view = new View();
        $this->database = new Database(self::$configuration['db']);
    }

    public function run(): void
    {
        $viewParams = [];

        switch ($this->action()) {
            case 'create':
                $page = 'create';
                
                $data = $this->getRequestPost();

                if (!empty($data)) {
                    $error = $this->database->validation($data);

                    if (empty($error)) {
                        $this->database->createNote($data);
                        header('Location: /');
                    }

                    $viewParams = [
                        'title' => trim(htmlentities($data['title'])),
                        'description' => trim(htmlentities($data['description'])),
                        'error' => $error
                    ];
                }
                break;

            case 'show':
                break;

            default:
                $page = 'list';
                break;
        }

        $this->view->render($page, $viewParams);
    }

    private function action(): string 
    {
        $data = $this->getRequestGet();
        return $data['action'] ?? self::DEFAULT_ACTION;
    }

    private function getRequestGet(): array
    {
        return $this->request['get'] ?? [];
    }

    private function getRequestPost(): array
    {
        return $this->request['post'] ?? [];
    }
}
