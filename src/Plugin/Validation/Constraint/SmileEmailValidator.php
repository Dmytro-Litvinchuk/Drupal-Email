<?php

namespace Drupal\guest\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class SmileEmailValidator.
 *
 * Validates the SmileEmail constraint.
 */
class SmileEmailValidator extends ConstraintValidator {

  /**
   * @param mixed $value
   * @param \Symfony\Component\Validator\Constraint $constraint
   */
  public function validate($items, Constraint $constraint) {
    foreach ($items as $item) {
      $value = trim($item->value);
      if (empty($value)) {
        $this->context->addViolation($constraint->notData);
      }
      if (!is_string($value)) {
        $this->context->addViolation($constraint->notString, ['%value' => $value]);
      }
      if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        $this->context->addViolation($constraint->notEmail, ['%value' => $value]);
      }
    }
  }

}
