<?php

namespace App\Repository;

use App\Entity\Ingredients;
use App\Tools\JsonDataType;
use Symfony\Component\HttpKernel\KernelInterface;

class RecipesRepository {

    protected $ingredients = [];

    protected $recipes = [];

    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function lunch(): array
    {
        $ingredients = $this->getJsonData('Ingredient');

        dd($ingredients);
    }

    private function getJsonData(string $file) {
        return JsonDataType::decodeJSON( $this->getFileContents($file), true);
    }

    private function getFileContents( string $filename ) : string
    {
        return file_get_contents($this->kernel->getProjectDir() . '/src/App/' . $filename . '/data.json');
    }

}