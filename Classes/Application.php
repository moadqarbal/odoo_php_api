<?php
   class Application extends Config {
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

      public function fetch_all_modules()
      {
         $ids = $this->models->execute_kw($this->db, $this->uid, $this->password,
         'ir.model', 'search',
         array(array(/*array('is_company', '=', true),
         array('customer', '=', true)*/)),
         array('limit'=>1000));

         $all_apps = $this->models->execute_kw($this->db, $this->uid, $this->password,
            'ir.model', 'read',
         array($ids),
         array('fields'=>array()));

         echo '<pre>';
         echo 'three fields in objs : ';
         print_r($all_apps);
         echo '</pre>';  
      }
      
      public function create_module()
      {
        $module_created = $this->models->execute_kw($this->db, $this->uid, $this->password,
            'ir.model', 'create', array(array(
                'name' => "New Model",
                'model' => 'x_new_custom_model',
                'state' => 'manual'
            ))
        );

        $module_fields = $this->models->execute_kw($this->db, $this->uid, $this->password,
            'x_new_custom_model', 'fields_get',
            array(),
            array('attributes' => array('string', 'help', 'type'))
        );

        echo '<pre>';
        print_r($module_fields);
        echo '</pre>';
        echo '<br><br><br>';
        echo '<pre>';
        print_r($module_created);
        echo '</pre>';
      }

      public function create_model_plus_fields()
      {
         $id = $this->models->execute_kw($this->db, $this->uid, $this->password,
            'ir.model', 'create', array(array(
                'name' => "Custom Model",
                'model' => 'x_custom',
                'state' => 'manual'
            ))
        );
        $this->models->execute_kw($this->db, $this->uid, $this->password,
            'ir.model.fields', 'create', array(array(
                'model_id' => $id,
                'name' => 'x_name',
                'type' => 'char',
                'state' => 'manual',
                'required' => true
            ))
        );
        $record_id = $this->models->execute_kw($this->db, $this->uid, $this->password,
            'x_custom', 'create', array(array(
                'x_name' => "test record"
            ))
        );
        $record_created = $this->models->execute_kw($this->db, $this->uid, $this->password,
            'x_custom', 'read',
            array(array($record_id)));

        echo '<pre>';
        print_r($record_created);
        echo '</pre>';
      }



   }

?>