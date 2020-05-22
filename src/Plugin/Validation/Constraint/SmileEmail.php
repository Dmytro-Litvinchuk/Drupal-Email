<?php

namespace Drupal\guest\Plugin\Validation\Constraint;

use Drupal\Core\Annotation\Translation;
use Symfony\Component\Validator\Constraint;

/**
 * Class SmileEmail
 *
 * @Constraint(
 *   id = "SmileEmail",
 *   label = @Translation("Custom email validator"),
 *   type = "string"
 * )
 */
class SmileEmail extends Constraint {

  /**
   * Error message.
   *
   * @var string
   */
  public $notData = 'Please enter any data to email field';

  /**
   * @var string
   */
  public $notString = '%value is not string';

  /**
   * @var string
   */
  public $notEmail = '%value is not Email';

}
