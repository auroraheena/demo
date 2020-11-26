<?php

namespace Drupal\customer_entity_functionality\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\StreamWrapper\PublicStream;

/**
 * Returns responses for Customer entity functionality routes.
 */
class customerEntityFunctionalityController extends ControllerBase {

    public $filepath;

    public function __construct() {
        // setting default filepath of CSV for now.
        $this->filepath = PublicStream::basePath() . '/customer_list.csv';
    }

    /**
     * Returns Customer List page with rendered view.
     */
    public function customerListPage($customer_id) {
      $view = views_embed_view('customer_list', 'default', $customer_id);
      return $view;
    }

    /**
     * Get data as array from CSV file.
     */
    public function csvFileData($filepath) {
        $csv_rows = [];
        $handle = fopen($filepath, 'r');
        if ($handle) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $csv_rows[] = $data;
            }
            fclose($handle);
        }
        $headers = array_shift($csv_rows);
        return $csv_rows;
    }

    /**
     * Update existing Customer Entities with CSV row data.
     * (updates all for now - no check if it needs update or not)
     */
    public function updateCustomerEntity($customer, $customer_csv_data) {
        $customer_entity = \Drupal::entityTypeManager()->getStorage('customer')->load($customer);
        $customer_entity->customer_name = $customer_csv_data[1];
        $customer_entity->balance = $customer_csv_data[2];
        $customer_entity->save();
        \Drupal::logger('customer_entity_functionality')->notice("Customer %customer_id updated",
        [
            '%customer_id' => $customer_csv_data[0],
        ]);
    }

    /**
     * Create new Customer Entities with CSV row data.
     */
    public function createCustomerEntity($customer_csv_data) {
        $customer_entity = \Drupal::entityTypeManager()->getStorage('customer')->create([
                'customer_id' => $customer_csv_data[0],
                'customer_name' => $customer_csv_data[1],
                'balance' => $customer_csv_data[2]
            ]);
        $customer_entity->save();
        if ($customer_entity->id()) {
            \Drupal::logger('customer_entity_functionality')->notice("New Customer %customer_id created",
            [
                '%customer_id' => $customer_csv_data[0],
            ]);
        }
    }

}
