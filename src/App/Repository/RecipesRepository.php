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

        return $this->menu();
    }

    private function menu() : array
    {
        $lunch = [];

        foreach ($this->recipes['recipes'] as $recipe) {

            $name = $recipe['title'];
            $hasIngredientsAfterBestBefore = false;

            foreach ($recipe['ingredients'] as $ingredient) {

                $recipeIngredient = $this->ingredients[$ingredient] ?? null;

                if (!($recipeIngredient instanceof Ingredients) || !$recipeIngredient->isValid()) {
                    continue 2;
                }
                if ($recipeIngredient->isYetUsable()) {
                    $hasIngredientsAfterBestBefore = true;
                }
            }

            if ($hasIngredientsAfterBestBefore) {
                array_push($lunch, $name);
            } else {
                array_unshift($lunch, $name);
            }
        }

        return $lunch;
    }

    private function getJsonData(string $file) {
        return JsonDataType::decodeJSON( $this->getFileContents($file), true);
    }

    private function getFileContents( string $filename ) : string
    {
        return file_get_contents($this->kernel->getProjectDir() . '/src/App/' . $filename . '/data.json');
    }

}