<?php

namespace Drupal\pathperdomain;

/**
 * Supplies loader methods for common domain path requests.
 */
interface PathPerDomainLoaderInterface {

  /**
   * Loads a single domain paths.
   *
   * @param int $id
   *   A domain id to load.
   * @param bool $reset
   *   Indicates that the entity cache should be reset.
   *
   * @return \Drupal\pathperdomain\PathPerDomainInterface|null
   *   A domain path record or NULL.
   */
  public function load($id, $reset = FALSE);

  /**
   * Loads a single domain paths by properties.
   *
   * @param array $properties
   *   A domain properties to load.
   *
   * @return \Drupal\pathperdomain\PathPerDomainInterface|null
   *   A domain path record or NULL.
   */
  public function loadByProperties($properties);

  /**
   * Loads multiple domain paths.
   *
   * @param array $ids
   *   An optional array of specific ids to load.
   * @param bool $reset
   *   Indicates that the entity cache should be reset.
   *
   * @return \Drupal\pathperdomain\PathPerDomainInterface[]
   *   An array of domain path records.
   */
  public function loadMultiple(array $ids = NULL, $reset = FALSE);

}
