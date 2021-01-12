<?php

require_once('ripcord/ripcord.php');

spl_autoload_register(function ($class){
	
	require 'Classes/' . $class . '.php';
	
});

/*echo '<pre>';
print_r(get_declared_classes());
print_r(get_class_methods('Contact'));
echo '<pre>';*/

$database = new Config('http://3.134.11.97:8112','ODOO','admin','admin');

$contact = new Contact();
//$contact->get_Odoo_Version();
//$contact->contact_list();
//$contact->pagination();
//$contact->contacts_count();
//$contact->fetch_contacts();
//$contact->fetch_contacts_specific_fields();
//$contact->listing_contacts();
//$contact->search_read_contacts();
$contact->create_contact();
//$contact->update_contact(56);
//$contact->delete_contact(53);

$app = new Application();
//$app->create_model_plus_fields();
//$app->create_module();
//$app->fetch_all_modules();

$order = new Order();
//$order->get_Odoo_Version();
//$order->create_order();


$product = new Product();
$product->create_product();




