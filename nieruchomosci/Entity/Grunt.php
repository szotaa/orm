<?php

namespace Entity;

/**
 * Grunt
 */
class Grunt
{
    /**
     * @var bool
     */
    private $pozwolenie_na_budowe;

    /**
     * @var int
     */
    private $id;

    /**
     * @var \Entity\Nieruchomosc
     */
    private $nieruchomosc;


    /**
     * Set pozwolenieNaBudowe.
     *
     * @param bool $pozwolenieNaBudowe
     *
     * @return Grunt
     */
    public function setPozwolenieNaBudowe($pozwolenieNaBudowe)
    {
        $this->pozwolenie_na_budowe = $pozwolenieNaBudowe;

        return $this;
    }

    /**
     * Get pozwolenieNaBudowe.
     *
     * @return bool
     */
    public function getPozwolenieNaBudowe()
    {
        return $this->pozwolenie_na_budowe;
    }

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
     * Set nieruchomosc.
     *
     * @param \Entity\Nieruchomosc|null $nieruchomosc
     *
     * @return Grunt
     */
    public function setNieruchomosc(\Entity\Nieruchomosc $nieruchomosc = null)
    {
        $this->nieruchomosc = $nieruchomosc;

        return $this;
    }

    /**
     * Get nieruchomosc.
     *
     * @return \Entity\Nieruchomosc|null
     */
    public function getNieruchomosc()
    {
        return $this->nieruchomosc;
    }
}
