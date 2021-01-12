<?php
   class Order extends Config {
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

      public function create_order()
      {
         /*$id = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'sale.order', 'create',
         array(array('partner_id'=>"11",'confirmation_date'=>"18/12/2020 12:18:31") , [0,0,array(
            'product_id'=>"28",
            'name'=>"test description",
            'product_uom_qty'=>"1111",
            'qty_delivered'=>"111",
            'qty_invoiced'=>"11",
            'qty_invoiced'=>"11",
            'price_unit'=>"100"
         )]));*/

         $id = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'sale.order', 'create', [
            'product_id'=>"28",
            'name'=>"test description",
            'product_uom_qty'=>"1111",
            'qty_delivered'=>"111",
            'qty_invoiced'=>"11",
            'qty_invoiced'=>"11",
            'price_unit'=>"100"
        ]);

         echo '---------------------------';
         echo '<br><br><br>';
         echo '<pre>'; 
         echo 'Order Created ID : ';
         print_r($id);
         echo '</pre>'; 
      }



   }

?>