<?php

namespace Drupal\guest\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Guest entity entities.
 *
 * @ingroup guest
 */
interface GuestEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Guest entity name.
   *
   * @return string
   *   Name of the Guest entity.
   */
  public function getName();

  /**
   * Sets the Guest entity name.
   *
   * @param string $name
   *   The Guest entity name.
   *
   * @return \Drupal\guest\Entity\GuestEntityInterface
   *   The called Guest entity entity.
   */
  public function setName($name);

  /**
   * Gets the Guest entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Guest entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Guest entity creation timestamp.
   *
   * @param int $timestamp
   *   The Guest entity creation timestamp.
   *
   * @return \Drupal\guest\Entity\GuestEntityInterface
   *   The called Guest entity entity.
   */
  public function setCreatedTime($timestamp);

}
