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

        $date = date('Y-m-d');

        foreach ($ingredients['ingredients'] as $ingredient) {

            $name = $ingredient['title'];
            $bestBefore = $ingredient['best-before'];
            $useBy = $ingredient['use-by'];

            $this->ingredients[$name] = new class($name, $date, $bestBefore, $useBy) extends Ingredients
            {
            };
        }

        $this->recipes = $this->getJsonData('Recipe');
        if (empty($this->recipes['recipes'])) {
            return [];
        }

        dd($this->ingredients);

    }

    private function getJsonData(string $file) {
        return JsonDataType::decodeJSON( $this->getFileContents($file), true);
    }

    private function getFileContents( string $filename ) : string
    {
        return file_get_contents($this->kernel->getProjectDir() . '/src/App/' . $filename . '/data.json');
    }

}