<?php

namespace App\Entity;

class PropertySearch
{
    private ?int $minSurface= null;
    private ?int $maxSurface= null;
    private ?int $minRooms= null;
    private ?int $maxRooms= null;
    private ?int $minPrice= null;
    private ?int $maxPrice= null;

	/**
	 * @return int
	 */
	public function getMinSurface(): ?int {
		return $this->minSurface;
	}
	
	/**
	 * @param int $minSurface 
	 * @return self
	 */
	public function setMinSurface(int $minSurface): self {
		$this->minSurface = $minSurface;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getMaxSurface(): ?int {
		return $this->maxSurface;
	}
	
	/**
	 * @param int $maxSurface 
	 * @return self
	 */
	public function setMaxSurface(int $maxSurface): self {
		$this->maxSurface = $maxSurface;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getMinRooms(): ?int {
		return $this->minRooms;
	}
	
	/**
	 * @param int $minRooms 
	 * @return self
	 */
	public function setMinRooms(int $minRooms): self {
		$this->minRooms = $minRooms;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getMaxRooms(): ?int {
		return $this->maxRooms;
	}
	
	/**
	 * @param int $maxRooms 
	 * @return self
	 */
	public function setMaxRooms(int $maxRooms): self {
		$this->maxRooms = $maxRooms;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getMinPrice(): ?int {
		return $this->minPrice;
	}
	
	/**
	 * @param int $minPrice 
	 * @return self
	 */
	public function setMinPrice(int $minPrice): self {
		$this->minPrice = $minPrice;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getMaxPrice(): ?int {
		return $this->maxPrice;
	}
	
	/**
	 * @param int $maxPrice 
	 * @return self
	 */
	public function setMaxPrice(int $maxPrice): self {
		$this->maxPrice = $maxPrice;
		return $this;
	}
}