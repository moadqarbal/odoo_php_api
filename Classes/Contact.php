<?php
   class Contact extends Config {
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

      public function calling_odoo_methods()
      {
         // Calling methods
         // call $this->model and auth($this->uid) from construct
         $this->models->execute_kw($this->db, $this->uid, $this->password,
            'res.partner', 'check_access_rights',
            array('read'), array('raise_exception' => false));
      }

      public function contact_list()
      {
         // Contact List ID's partner
         $list_record = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'search', array(
            array(array('is_company', '=', true),
               array('customer', '=', true))));

            echo '<pre>';
            print_r($list_record);
            echo '</pre>';
      }

      public function pagination()
      {
         //  return the ids of all records (from val to val)
         $pagination = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'search',
         array(array(array('is_company', '=', true),
                     array('customer', '=', true))),
         array('offset'=>0, 'limit'=>5));
                  
         echo '<pre>';
         print_r($pagination);
         echo '</pre>';
      }

      public function contacts_count()
      {
         // Count partners or customers (client) are Company
         $count_record = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'search_count',
         array(array(array('is_company', '=', true),
                     array('customer', '=', true))));

         echo '<pre>';
         echo '(company) customers count : ';
         print_r($count_record);
         echo '</pre>'; 
      }

      public function fetch_contacts()
      {
         // Read records
         $ids = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'search',
         array(array(array('is_company', '=', true),
                     array('customer', '=', true))),
         array('limit'=>10));

         $records = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'read', array($ids));

         echo 'count records : ' . count($records[0]);
      }

      public function fetch_contacts_specific_fields()
      {
         $ids = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'search',
         array(array(/*array('is_company', '=', true),
         array('customer', '=', true)*/)),
      array('limit'=>1000));

         $three_fields = $this->models->execute_kw($this->db, $this->uid, $this->password,
            'res.partner', 'read',
         array($ids),
         array('fields'=>array('name', 'country_id', 'comment')));

         echo '<pre>';
         echo 'three fields in objs : ';
         print_r($three_fields);
         echo '</pre>';  
      }

      public function listing_contacts()
      {
         // Get Contacts Fields name and type and description 
         $listing_record_fields = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'fields_get',
         array(), array('attributes' => array('string', 'help', 'type')));

         echo '<pre>';
         echo 'Listing record fields : ';
         print_r($listing_record_fields);
         echo '</pre>'; 
      }

      public function search_read_contacts()
      {
         // Search and read
         $search_and_read = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'search_read',
         array(array(array('is_company', '=', true),
                     array('customer', '=', true))),
         array('fields'=>array('name', 'country_id', 'comment'), 'limit'=>5));

         echo '<pre>';
         echo 'Search and read : ';
         print_r($search_and_read);
         echo '</pre>'; 
      }

      public function create_contact()
      {
         $id = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'create',
         array(array('name'=>"Moad",'phone'=>"+2126666666", 'user_id' => "6")));

         echo '---------------------------';
         echo '<br><br><br>';
         echo '<pre>'; 
         echo 'Partner Created ID : ';
         print_r($id);
         echo '</pre>'; 
      }

      public function update_contact($id)
      {
         $this->models->execute_kw($this->db, $this->uid, $this->password, 'res.partner', 'write',
         array(array($id), array('name'=>"Newer partner")));
         // get record name after having changed it
         $contact_udated = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'name_get', array(array($id)));
      
         echo '<pre>'; 
         echo 'Partner Created ID : ';
         print_r($contact_udated);
         echo '</pre>'; 
      }

      public function delete_contact($id)
      {
         $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'unlink',
         array(array($id)));
         // check if the deleted record is still in the database
         $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'search',
         array(array(array('id', '=', $id))));
      }



      

      /*public function create_contact($id)
      {
         $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'unlink',
         array(array($id)));
         // check if the deleted record is still in the database
         $this->models->execute_kw($this->db, $this->uid, $this->password,
         'res.partner', 'search',
         array(array(array('id', '=', $id))));
      }*/





   }

?>