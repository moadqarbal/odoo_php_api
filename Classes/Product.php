<?php
   class Product extends Config {
      /* Member variables */
      public $common;
      public $uid;
      public $models;

      public function __construct()
      {
         $this->common = ripcord::client($this->url.'/xmlrpc/2/common');
         // auth
         $this->uid = $this->common->authenticate($this->db, $this->username, $this->password, array());
         $this->models = ripcord::client("$this->url/xmlrpc/2/object");
      }
      

      public function get_Odoo_Version()
      {
         $version = $this->common->version();
         echo '<pre>';
         print_r($version);
         echo '</pre>';
      }

      public function create_product()
      {
         /*$product = array('name' => 'Sample',
                    'type' => 'product',
                    'list_price' => 4.6,
                    'standard_price' => 3.25
              );
         $product_id = $this->models->execute_kw($this->db, $this->uid, $this->password, 
          'product.template','create',array($product));*/

         $existing_prodid = 59;
         $existing_attribute_id = 5;
         $existing_value_id = 4;
         $product_attribute_line = $this->models->execute_kw($this->db, $this->uid, $this->password,
                                          'product.attribute.line','create',
                                           array('product_tmpl_id' => $existing_prodid,
                                               'attribute_id'=>$existing_attribute_id,
                                               'value_ids'=>array(array(6,0,array($existing_value_id)))
            ));

         echo '<pre>';
         print_r($product_attribute_line);
         echo '</pre>';
         
      }



   }

?>