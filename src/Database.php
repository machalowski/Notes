<?php 

declare(strict_types=1);

namespace App;

session_start();
require_once("src/Exception/StorageException.php");

use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use PDO;
use PDOException;
use Throwable;

class Database 
{
    private PDO $conn;

    public function __construct(array $config)
    {
        try {

            $this->validateConfig($config);
            $this->createConnection($config);

        } catch(PDOException $e) {
            throw new StorageException('Connection error');
        }
    }

    public function createNote(array $data): void
    {
        try {
            $title = $this->conn->quote(trim($data['title']));
            $description = $this->conn->quote(trim($data['description']));
            $created = date('Y-m-d H:i:s');

            $query = "INSERT INTO notes(title, description, created) VALUES($title, $description, '$created')";
            $this->conn->exec($query);
            
            $_SESSION['before'] = 'Notatka została utworzona';

        } catch(Throwable $e) {
            throw new StorageException('Nie udało się utworzyć notatki');
        }
    }

    public function validation(array $data): array
    {
        $error = [];

        if (empty($data['title'])) :
             $error['TitleError'] = "Pole nie może być puste";
        elseif (strlen($data['title']) < 3) :
            $error['TitleError'] = "Pole musi posiadać minimum 3 znaki";
        endif;

        if (empty($data['description'])) {
            $error['DescriptionEmpty'] = "Pole nie może być puste";
        }

        return $error;
    }

    private function createConnection(array $config): void 
    {
        $dsn = "mysql:dbname={$config['database']};host={$config['host']}";
        $this->conn = new PDO(
            $dsn,
            $config['user'],
            $config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    private function validateConfig(array $config): void
    {
        if (empty($config['database']) or empty($config['host']) or empty($config['user'])) {
            throw new ConfigurationException('Storage configutarion error');
        }
    }
}