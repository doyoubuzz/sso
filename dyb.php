<?php
$_SESSION['timestamp'] = isset( $_GET['timestamp'] ) ? $_GET['timestamp'] : '';

$slug = 'battlestar';							 		            // Your slug		
$user = array( 'id'        => 'kara-thrace',					// The user id on your system
			   'email'     => 'kara.thrace@doyoubuzz.com',      // User email
			   'firstname' => 'Kara',			 	            // User first name
			   'lastname'  => 'Thrace',				 	        // User last name
			   'user_type' => '2'				 	            // User type
			  );
$secret_key = 'IBebIUWBAah7EiQ';				 	            // SSO Secret Key (in your BO > Settings > General Settings > SSO)				    
$groups = array('pilote', 'viper');                      	    // Array of the groups id (on your system) the user belongs to

if ( isset($_GET['timestamp']) ) {
	include('class.DYB.php');	
	DYB::sso_connect($slug, 		
		'fr', 					    // Lang (fr, us)
		$user['id'], 			    // The user id on your system
		$_SESSION['timestamp'], 	// Timestamp given to you in GET by DoYouBuzz
		$user['email'], 			// User's email
		$secret_key,
		$user['firstname'],
		$user['lastname'],
		$groups,
		$user['user_type']
	);  
	
}
else {
	echo '<a href="http://showcase.doyoubuzz.com/p/fr/'.$slug.'/sso">Connexion</a>';

	// If you used the multi-site configuration you could do this : 
	// echo '<a href="http://showcase-beta.doyoubuzz.com/p/fr/'.$slug.'/sso?cid=site_1">Connexion Site 1</a>';		
	// echo '<a href="http://showcase-beta.doyoubuzz.com/p/fr/'.$slug.'/sso?cid=site_2">Connexion Site 2</a>';		
}

?>