<?php

namespace Schemax\App\Data;

class DataBuilder
{
	protected $dependencies = [];

	/**
	 * Add a dependency to the builder.
	 *
	 * @param string $key The key to identify the dependency (e.g., 'offer', 'review').
	 * @param mixed $dependency The dependency instance (e.g., OfferData, ReviewData).
	 * @return $this
	 */
	public function addDependency(string $key, $dependency): self
	{
		$this->dependencies[$key] = $dependency;
		return $this;
	}

	/**
	 * Build the final data object with all dependencies.
	 *
	 * @param string $dataType The class name of the data type to build (e.g., ProductData, PostData).
	 * @return DataInterface The final data object.
	 */
	public function build(string $dataType): DataInterface
	{
		// Dynamically instantiate the class and pass the dependencies
		$this->data = new $dataType($this->dependencies);

		return $this->data;
	}
}
