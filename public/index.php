<?php
declare(strict_types=1);

spl_autoload_register(function (string $class): void {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../src/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

use App\Entity\Filiere;
use App\Entity\Etudiant;
use App\Entity\Enseignant;
use App\Service\PrinterService;

$fInfo = new Filiere(1, "Informatique");

$e1 = new Etudiant(null, "Sara", "sara@example.com", $fInfo);
$e2 = new Etudiant(null, "Youssef", "youssef@example.com", $fInfo);

$ens1 = new Enseignant(null, "Dr Karim", "karim@example.com", "Maitre de conferences");

$personnes = [$e1, $e2, $ens1];

$printer = new PrinterService();
$printer->printLabels($personnes);

echo PHP_EOL . "Export tableau (exemple) :" . PHP_EOL;
print_r($e1->toArray());
print_r($ens1->toArray());
