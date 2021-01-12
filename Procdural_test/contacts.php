<?php 

/*require('config.php');
require('Ripcord/Ripcord.php');*/

/*$info = ripcord::client('http://3.134.11.97:8112')->start();
list($url, $db, $username, $password) =
  array($info['host'], $info['database'], $info['user'], $info['password']);


$common = Ripcord::client("$url/xmlrpc/2/common");
$version = $common->version();
print($version);*/



$url = "http://3.134.11.97:8112";
$db = "ODOO";
$username = "admin";
$password = "admin";


require_once('ripcord/ripcord.php');

$common = ripcord::client($url.'/xmlrpc/2/common');
$version = $common->version();
echo '<pre>';
print_r($version);
echo '</pre>';

// Logging in
$uid = $common->authenticate($db, $username, $password, array());

// Calling methods
$models = ripcord::client("$url/xmlrpc/2/object");

$models = ripcord::client("$url/xmlrpc/2/object");
$models->execute_kw($db, $uid, $password,
    'res.partner', 'check_access_rights',
    array('read'), array('raise_exception' => false));


// List Record
$list_record = $models->execute_kw($db, $uid, $password,
    'res.partner', 'search', array(
        array(array('is_company', '=', true),
              array('customer', '=', true))));

echo '<pre>';
print_r($list_record);
echo '</pre>';

// Pagination
$pagination = $models->execute_kw($db, $uid, $password,
    'res.partner', 'search',
    array(array(array('is_company', '=', true),
                array('customer', '=', true))),
    array('offset'=>10, 'limit'=>5));
              
echo '<pre>';
print_r($pagination);
echo '</pre>';


// Count records
$count_record = $models->execute_kw($db, $uid, $password,
'res.partner', 'search_count',
array(array(array('is_company', '=', true),
            array('customer', '=', true))));

echo '<pre>';
echo 'company customers count : ';
print_r($count_record);
echo '</pre>';  


// Read records
$ids = $models->execute_kw($db, $uid, $password,
    'res.partner', 'search',
    array(array(array('is_company', '=', true),
                array('customer', '=', true))),
    array('limit'=>1));
$records = $models->execute_kw($db, $uid, $password,
    'res.partner', 'read', array($ids));

// count the number of fields fetched by default
echo 'count records : ' . count($records[0]);
// Records
/*echo '<pre>';
echo 'records objs : ';
print_r($records);
echo '</pre>'; */

$three_fields = $models->execute_kw($db, $uid, $password,
    'res.partner', 'read',
    array($ids),
    array('fields'=>array('name', 'country_id', 'comment')));

echo '<pre>';
echo 'three fields in objs : ';
print_r($three_fields);
echo '</pre>';  

// Listing record fields
$listing_record_fields = $models->execute_kw($db, $uid, $password,
    'res.partner', 'fields_get',
    array(), array('attributes' => array('string', 'help', 'type')));

echo '<pre>';
echo 'Listing record fields : ';
print_r($listing_record_fields);
echo '</pre>'; 


// Search and read
$search_and_read = $models->execute_kw($db, $uid, $password,
    'res.partner', 'search_read',
    array(array(array('is_company', '=', true),
                array('customer', '=', true))),
    array('fields'=>array('name', 'country_id', 'comment'), 'limit'=>5));

echo '---------------------------';
echo '<br><br><br>';
echo '<pre>';

echo 'Search and read : ';
print_r($search_and_read);
echo '</pre>'; 


// Create Record
/*$id = $models->execute_kw($db, $uid, $password,
    'res.partner', 'create',
    array(array('name'=>"New Partner 6",'phone'=>"+21236547898", 'user_id' => "6")));

    echo '---------------------------';
    echo '<br><br><br>';
    echo '<pre>'; 
    echo 'Partner Created ID : ';
    print_r($id);
    echo '</pre>'; */

// Create Commande
$id = $models->execute_kw($db, $uid, $password,
    'sale.order', 'create',
    array(array('partner_id'=>"35",'date_order'=>"20/12/2020 11:11:11", "order_line" => 
    array(array(0,0,['product_id'=>"16" , 'name'=>"description article test", 'product_uom_qty'=>"1000", 'qty_delivered'=>"500" , 'qty_invoiced'=>"250" , 'price_unit'=>"100"])))));

    

    echo '---------------------------';
    echo '<br><br><br>';
    echo '<pre>'; 
    echo 'Sale Order Created ID : ';
    print_r($id);
    echo '</pre>';


/*$partners = $models->execute_kw(
    $db,
    $uid,
    $password,
    'res.partner',
    'search',
    array(
        array(
            array('is_company', '=', true),
            array('customer', '=', true)
        )
    )
);

echo('RESULT:<br/>');
foreach ($partners as $partner) {
    echo $partner.'<br/>';
}*/