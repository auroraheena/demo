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
    public function customerListPage() {
      $view = views_embed_view('customer_list');
      return $view;
    }

}
