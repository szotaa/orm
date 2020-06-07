<?php

namespace Entity;

/**
 * Komunikacja
 */
class Komunikacja
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nazwa;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nazwa.
     *
     * @param string $nazwa
     *
     * @return Komunikacja
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa.
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }
}
