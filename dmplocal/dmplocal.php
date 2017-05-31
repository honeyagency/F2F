<?php

// Create JSON to send to dmplocal

$skey = 'f3c5ba7f422ecc95a452fa2c5421b24896f4ff1f';
$operator_email = 'maggie@honeyagency.com';
$api_id = 'visitsacramento';

$first_name = $_GET['first'];
$last_name = $_GET['last'];
$email = $_GET['email'];

$vars = array('skey' => $skey,
				'operator_email' => $operator_email,
				'api_id' => $api_id,
				'contacts' => array(array('email' => $email,
									'first_name' => $first_name,
									'last_name' => $last_name,
									'owner_email' => $operator_email
									)
									),
				'return_fields' => array('id',
										'email'
										)
			);
			
			
$vars = json_encode($vars, JSON_FORCE_OBJECT);

$url = 'https://visitsacramento.dmplocal.com/api/Contact/Update.json';

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $vars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = json_decode(curl_exec( $ch ));
$response = $response->Valid;

if($response[0]->email == $email) { echo '1'; } else { echo '0'; }

?>