<?php

namespace Drupal\guest\Form;

use Drupal\Component\Serialization\Json;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form controller for Guest entity edit forms.
 *
 * @ingroup guest
 */
class GuestEntityForm extends ContentEntityForm {

  /**
   * The current user account.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $account;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    $instance = parent::create($container);
    $instance->account = $container->get('current_user');
    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var \Drupal\guest\Entity\GuestEntity $entity */
    $form = parent::buildForm($form, $form_state);
    // Add ajax function to the submit.
    $form['actions']['submit']['#ajax'] = [
      'callback' => '::ajaxSave',
      'event' => 'click',
      'progress' => [
        'type' => 'throbber',
      ],
    ];
    $authenticated = $this->account->isAuthenticated();
    if ($authenticated == TRUE) {
      $form['name']['#attributes']['hidden'] = TRUE;
      $form['last_name']['#attributes']['hidden'] = TRUE;
      $form['mail']['#attributes']['hidden'] = TRUE;
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function ajaxSave(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $message = ($this->t('Created the %label Guest entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        $message = ($this->t('Saved the %label Guest entity.', [
          '%label' => $entity->label(),
        ]));
    }
    // Change example_id to #example-id.
    $bad_form_id = $this->getFormId();
    $form_id = str_replace('_', '-', $bad_form_id);
    $selector = '#' . $form_id;
    // Render some html.
    $build['message'] = [
      '#type' => 'html_tag',
      '#tag' => 'h3',
      '#value' => $message,
    ];
    // Render link as button via modal window.
    $build['link'] = [
      '#title' => $this
        ->t('Your message here'),
      '#type' => 'link',
      '#url' => Url::fromRoute('entity.guest_entity.canonical', ['guest_entity' => $entity->id()]),
      '#options' => [
        'attributes' => [
          // use-ajax for modal window, button etc for view as button.
          'class' => ['use-ajax', 'button', 'button--small'],
          'data-dialog-type' => 'modal',
          'data-dialog-options' => Json::encode([
            'width' => 500,
          ]),
        ],
      ],
      // Required library for using ajax modal window.
      '#attached' => ['library' => ['core/drupal.dialog.ajax']],
    ];
    // Ajax magic - replace form and render some new html.
    $ajax_response = new AjaxResponse();
    $ajax_response->addCommand(new ReplaceCommand($selector, $build));
    return $ajax_response;
  }

}
