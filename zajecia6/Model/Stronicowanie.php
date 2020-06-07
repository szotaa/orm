<?php

namespace Model;

use \Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

class Stronicowanie
{
	/**
	 * @var Query
	 */
	private $query;
	
	private $strona;
	private $limit;
	
	public function __construct(Query $query, $strona, $limit)
	{
		$this->query = $query;
		$this->strona = $strona;
		$this->limit = $limit;
		
		$this->query->setFirstResult($strona * $limit);
		$this->query->setMaxResults($limit);
	}
	
	/**
	 * Zwraca rekordy dla danej podstrony.
	 * 
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function pobierzDane()
	{
		return $this->query->execute();
	}
	
	/**
	 * Zwraca HTML z linkami do wszystkich podstron.
	 * 
	 * @return string
	 */
	public function pobierzLinki()
	{
		$paginator = new Paginator($this->query);
		$liczbaRekordow = $paginator->count();
		$liczbaStron = ceil($liczbaRekordow / $this->limit);
		$nazwaPliku = $_SERVER['SCRIPT_NAME'];
		
		// czyszczenie parametrow z linka
		$parametry = array();
		foreach($_GET as $kl => $wart) {
			if (!in_array($kl, ['szukaj', 'strona'])) {
				$parametry[] = "$kl=$wart";
			}
		}
		
		// stworzenie poczatku query stringa
		$qs = implode('&', $parametry);
		
		// generowanie linkow do podstron
		$html = '<nav aria-label="Page navigation example"><ul class="pagination">';

		for($i = 0; $i < $liczbaStron; $i++) {
			if($i == $this->strona) {
				$html .= '<li class="page-item active" aria-current="page"><a class="page-link" href="#">' .
                    ($i + 1) .
                    ' <span class="sr-only">(current)</span></a></li>';

			} else {
			    $html .= sprintf(
			        '<li class="page-item"><a class="page-link" href="%s?%s&strona=%d">%d</a></li>',
                    $nazwaPliku,
                    $qs,
                    $i,
                    $i + 1
                );
			}
		}
        $html .= '</ul></nav>';
        $html .= "<nav><ul class='pagination'>";

        if($this->strona > 0) {
            $html .= sprintf(
                "<li class='page-item'><a href='%s?%s&strona=%d' class='page-link'>Pierwsza</a></li>",
                $nazwaPliku,
                $parametry,
                0
            );
            $html .= sprintf(
                "<li class='page-item'><a href='%s?%s&strona=%d' class='page-link'>Poprzednia</a></li>",
                $nazwaPliku,
                $parametry,
                $this->strona - 1
            );
        }

        if($this->strona < $liczbaStron - 1) {
            $html .= sprintf(
                "<li class='page-item'><a href='%s?%s&strona=%d' class='page-link'>Nastepna</a></li>",
                $nazwaPliku,
                $parametry,
                $this->strona + 1
            );
            $html .= sprintf(
                "<li class='page-item'><a href='%s?%s&strona=%d' class='page-link'>Ostatnia</a></li>",
                $nazwaPliku,
                $parametry,
                $liczbaStron - 1
            );
        }


        $html .= "</ul></nav>";
        $start = $this->strona*$this->limit+1;
        $koniec = min($start + $this->limit-1, $liczbaRekordow);
        $html .= "<p>wyswietlono ". $start . "- ". $koniec. " z ". $liczbaRekordow. "</p>";
		return $html;
	}

//    public function pobierzLiczbeRekordow(): string
//    {
//        $start = $this->strona*$this->limit+1;
//        $koniec = min($start + $this->limit-1, $strona);
//        return "Wyswietlono " .$start. " - " .$koniec. " rekordow z ". $num;
//    }

}