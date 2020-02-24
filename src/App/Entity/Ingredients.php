<?php

namespace App\Entity;

class Ingredients
{

    /**
     * Name of the ingredient
     *
     * @var string
     */
    protected $name;

    /**
     * Date
     *
     * @var false|int
     */
    protected $date;

    /**
     * Best before date
     *
     * @var false|int
     */
    protected $bestBefore;

    /**
     * Use by date
     *
     * @var false|int
     */
    protected $useBy;

    /**
     * Is the ingredient still usable
     *
     * @var bool
     */
    protected $isYetUsable = false;

    /**
     * AbstractIngredient constructor.
     *
     * @param string $name
     * @param string $date
     * @param string $bestBefore
     * @param string $useBy
     */
    public function __construct(string $name, string $date, string $bestBefore, string $useBy)
    {

        $this->name = $name;
        $this->date = strtotime($date);
        $this->bestBefore = strtotime($bestBefore);
        $this->useBy = strtotime($useBy);
    }

    /**
     * Checks the validity of the ingredient
     *
     * @return bool
     */
    public function isValid() : bool
    {

        if ($this->date === false) {
            return false;
        }

        if ($this->date > $this->useBy) {
            return false;
        }

        if ($this->date >= $this->bestBefore && $this->date <= $this->useBy) {

            $this->isYetUsable = true;
            return true;
        }

        return true;

    }

    /**
     * Gets ingredient's name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets ingredients usability
     *
     * @return bool
     */
    public function isYetUsable() : bool
    {
        return $this->isYetUsable;
    }


}