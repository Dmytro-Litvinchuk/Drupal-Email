<?php

/**
 * @file
 * Contains guest_entity.page.inc.
 *
 * Page callback for Guest entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Guest entity templates.
 *
 * Default template: guest_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_guest_entity(array &$variables) {
  // Fetch GuestEntity Entity Object.
  $guest_entity = $variables['elements']['#guest_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
