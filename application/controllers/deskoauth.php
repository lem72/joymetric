<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deskoauth extends CI_Controller {
//
// Desk.com Single Access Token API Example
//
// 1) Copy this file to the root of your webserver and change the $my_desk_url variable to point to your desk.com hostname
// 2) Go to https://[yoursite].desk.com/admin/settings/api-applications and create an API Application
// 3) Copy the consumer key & secret on the listing page after you create your API Application
// 4) Click the "Your Access Token" link to get your single access token & secret
// 5) Copy your single access token & secret and paste it into the appropriate variable in this file
//
// Note: This was tested with PHP 5.4 with OAuth Extension installed
//
public function index()
		{
			

$my_desk_url = 'https://aritzia.desk.com';
 
//Application key and secret found here:
// https://[yoursite].desk.com/admin/settings/api-applications
$consumer_key = 'gdCcZ8awl9Z0NLcZGLS7';
$consumer_secret = 'rWxfb6PEJ0b5h6EgyeZVgjefTJnXBNx772GortFj';
 
//Access token & secret (Click [Your Access Token] on App Listing)
// https://[yoursite].desk.com/admin/settings/api-applications)
$access_token = 'rFI1WU7kKbaUDZ1SJOXv';
$access_secret = '3LQfUUzeheXHCkaglKJdJl0D8ATy4XlEFt5rMIeV';
 
try {
//Create a new Oauth request.
$oauth = new OAuth($consumer_key, $consumer_secret);
$oauth->enableDebug();
$oauth->setToken($access_token,$access_secret);
$action = 'list';
if(isset($_GET['action'])) $action = $_GET['action'];
 
switch($action) {
case 'resolve':
$id = $_GET['id'];
//Example of a PUT API action - resolve a case
$oauth->fetch($my_desk_url."/api/v1/cases/".$id.".json",array('case_status_type_id'=>70),OAUTH_HTTP_METHOD_PUT);
 
header('Location: /desk-oauth-example-single.php');
 
break;
 
case 'show':
$id = $_GET['id'];
//Example of GET Show action
$oauth->fetch($my_desk_url."/api/v1/cases/".$id.".json",array(),OAUTH_HTTP_METHOD_GET);
 
//Get Response
$json = json_decode($oauth->getLastResponse());
 
echo "<a href='/desk-oauth-example-single.php'>BACK</a>";
 
print_obj($json->case);
 
break;
 
default:
//Example of a List action
 
//Parse query parameters
$query = '';
if(isset($_GET['email'])) {
$query = '?email='.$_GET['email'];
}
 
//Sample GET Request
$oauth->fetch($my_desk_url."/api/v1/cases.json".$query,array(),OAUTH_HTTP_METHOD_GET);
//Get Response
$json = json_decode($oauth->getLastResponse());
echo "<h3>Total Cases: ".($json->total)."</h3>";
echo "<ul>";
foreach($json->results as $key => $value) {
$case = $value->case;
echo "<li>";
echo "<b>Case #".($case->id).": ".($case->subject)."</b>";
if (!in_array($case->case_status_type, array("resolved", "closed"))) {
echo "&nbsp;(<a href='/desk-oauth-example-single.php?action=resolve&id=".($case->id)."'>resolve</a>)";
} else {
echo "&nbsp;(".$case->case_status_type.")";
}
echo "&nbsp;(<a href='/desk-oauth-example-single.php?action=show&id=".($case->id)."'>details</a>)";
//echo "<br/>".($case->preview);
echo "</li>";
}
echo "</ul>";
 
//print_r($json);
break;
}
 
} catch(OAuthException $E) {
print_r($E);
}
 
function print_obj($obj){
echo "<ul>";
foreach($obj as $key => $value) {
echo "<li>";
echo "<b>".($key)."</b> ";
if (is_object($value)) {
print_obj($value);
} else if (is_array($value)) {
echo implode(",", $value);
} else {
echo $value;
}
echo "</li>";
}
echo "</ul>";
}

}
}
