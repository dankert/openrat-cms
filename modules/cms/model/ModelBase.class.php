<?php
namespace cms\model;

use LogicException;
use util\text\TextMessage;

abstract class ModelBase
{
    public function __construct()
    {
    }

    /**
     * All public properties of this object.
     * @return array
     */
    public function getProperties()
    {
        return get_object_vars( $this );
    }

	/**
	 * The logical name of this object.
	 *
	 * @return string name
	 */
    public abstract function getName();

	/**
	 * Loading the instance from the database
	 */
    public abstract function load();

	/**
	 * Saving the instance to the database
	 */
    protected abstract function save();

	/**
	 * Adding the instance to the database
	 */
    protected abstract function add();

	/**
	 * Delete this instance
	 */
    public abstract function delete();

	/**
	 * Returns the unique ID of this object.
	 *
	 * @return int
	 */
    public abstract function getId();


	/**
	 * Is this instance already persistent in the database?
	 *
	 * @return bool
	 */
	public function isPersistent()
	{
		return (bool) $this->getId();
	}


	/**
	 * Persist the object in the database
	 */
	public function persist()
	{
		if   ( ! $this->isPersistent() )
			$this->add();

		$this->save();
	}

	/**
	 * Updates the already existing object in the database
	 *
	 * @throws LogicException if not persistent
	 */
	public function update()
	{
		if   ( ! $this->isPersistent() )
			throw new LogicException(TextMessage::create('Object ${0} is not persistent and cannot be updated', [ get_class($this).' '.$this->getName() ]) );

		$this->save();
	}


	public function __toString() {
		return $this->getId().':'.$this->getName();
	}
}
