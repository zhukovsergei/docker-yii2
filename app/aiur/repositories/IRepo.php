<?php

namespace aiur\repositories;

interface IRepo
{

  /**
   * Find data by id
   *
   * @param mixed $id The identifier.
   *
   * @return object|null The object.
   */
  public function get($id);

  /**
   * Retrieve all data of repository
   *
   * @return mixed
   */
  public function getAll();


  /**
   * Save a new entity in repository
   *
   * @param object $object
   *
   * @return mixed
   */
  public function save($object);


  /**
   * Delete a entity in repository by id
   *
   * @param $id
   *
   * @return int
   */
  public function delete($id);
}