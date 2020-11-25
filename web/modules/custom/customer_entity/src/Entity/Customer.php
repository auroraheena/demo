<?php

namespace Drupal\customer_entity\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\customer_entity\CustomerInterface;

/**
 * Defines the customer entity class.
 *
 * @ContentEntityType(
 *   id = "customer",
 *   label = @Translation("Customer"),
 *   label_collection = @Translation("Customers"),
 *   handlers = {
 *     "list_builder" = "Drupal\customer_entity\CustomerListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\customer_entity\Form\CustomerForm",
 *       "edit" = "Drupal\customer_entity\Form\CustomerForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "customer",
 *   admin_permission = "administer customer",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "customer_id",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/content/customer/add",
 *     "canonical" = "/customer/{customer}",
 *     "edit-form" = "/admin/content/customer/{customer}/edit",
 *     "delete-form" = "/admin/content/customer/{customer}/delete",
 *     "collection" = "/admin/content/customer"
 *   }
 * )
 */
class Customer extends ContentEntityBase implements CustomerInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

      $fields = parent::baseFieldDefinitions($entity_type);

      $fields['customer_id'] = BaseFieldDefinition::create('integer')
        ->setLabel(t('Customer Id'))
        ->setDisplayOptions('form', [
          'type' => 'integer',
          'weight' => 1,
      ]);


      $fields['customer_name'] = BaseFieldDefinition::create('string')
        ->setLabel(t('Customer name'))
        ->setSetting('max_length', 255)
        ->setDisplayOptions('form', [
          'type' => 'string_textfield',
          'weight' => 2,
        ])
        ->setDisplayOptions('view', [
          'label' => 'above',
          'weight' => 2,
        ]);

      $fields['balance'] = BaseFieldDefinition::create('float')
        ->setLabel(t('Balance'))
        ->setDisplayOptions('form', [
          'type' => 'float',
          'weight' => 3,
        ])
        ->setDisplayOptions('view', [
          'label' => 'above',
          'weight' => 3,
        ]);


      return $fields;
  }

}
