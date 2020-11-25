<?php

namespace Drupal\customer_entity_functionality\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Customer entity functionality routes.
 */
class CustomerEntityFunctionalityController extends ControllerBase {
    /**
     * Returns Customer List page.
     */
    public function customerListPage($customer_id) {
      $view = views_embed_view('customer_list', 'default', $customer_id);
      return $view;
    }

}
