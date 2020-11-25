<?php

namespace Drupal\customer_entity\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the customer entity edit forms.
 */
class CustomerForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $entity = $this->getEntity();
    $result = $entity->save();
    $link = $entity->toLink($this->t('View'))->toRenderable();

    $message_arguments = ['%label' => $this->entity->label()];
    $logger_arguments = $message_arguments + ['link' => render($link)];

    if ($result == SAVED_NEW) {
      $this->messenger()->addStatus($this->t('New customer %label has been created.', $message_arguments));
      $this->logger('customer_entity')->notice('Created new customer %label', $logger_arguments);
    }
    else {
      $this->messenger()->addStatus($this->t('The customer %label has been updated.', $message_arguments));
      $this->logger('customer_entity')->notice('Updated new customer %label.', $logger_arguments);
    }

    $form_state->setRedirect('entity.customer.canonical', ['customer' => $entity->id()]);
  }

}
