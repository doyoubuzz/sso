<?php 

class DYB {

	/**
	 * Once your user is logged into your system call this method to redirect user on DoYouBuzz and automaticaly connect him.
	 * Here an example of call :
	 * <code>
	 * <?php
	 * DYB::sso_connect('votre-nom', 					// Your slug
						 'fr', 							// Lang (fr, us)
						 '123', 			            // The user id on your system
						 $_SESSION['timestamp'], 		// Timestamp given to you in GET by DoYouBuzz
						 'john.doe@gmail.com', 			// User's email
						'supercalifragilistic', 		// Secret key, set in settings pages, or given to you by DYB
						'John', 						// User firstname
						'Doe', 						    // User lastname
						 null, 							// The Group ID which the user is member of
						 0, 							// Do we do a callback? (need to specify the url in settings) 
						 0);                            // Do we do a return (need to specify the url in settings)
	 * ?>
	 * </code>
	 * @param string $slug Your slug, given by DoYouBuzz
	 * @param string $lang The lang for DoYouBuzz, 'fr', 'us'. Maybe more in future.
	 * @param string $external_id The user's id in your system. Must be less than 250 characters
	 * @param int $timestamp The timestamp given to you when calling your page. $_GET['timestamp'].
	 * @param string $email User email.
	 * @param string $secretkey The secret key that you set in your settings section. Do not display this one!
	 * @param string $firstname User firstname
	 * @param string $lastname User lastname
	 * @param string|array $groups_id The id of your groups
	 * @param $doCallback
	 * @param $doReturn
	 * @param string $redirect 
	 * @param string $redirectCvId 
	 * @param string $back_title 
	 * @param string $back_href 
	 * @param string $back_target 
	 * @param string $button_title 
	 * @param string $button_action 
	 */
	function sso_connect($slug, $lang, $external_id, $timestamp, $email, $secretkey, $firstname = null, 
	                     $lastname = null, $groups_id = null, $doCallback = false, $doReturn = false, 
	                     $redirect = null, $redirectCvId = null, $back_title = null, $back_href = null, $back_target = null,
	                     $button_title = null, $button_action = null) {
		$groupsParam = '';
		if (!is_array($groups_id) && !empty($groups_id)) {
			$groups_id = array($groups_id);
		}
		$group = '';
		if (is_array($groups_id)) {
			foreach($groups_id as $g) {
				$groupsParam .= '&groups[]=' . rawurlencode($g);
				$group .= $g;
			}
		}
		
		$hash = md5($email . $firstname . $lastname . $external_id . $group . $timestamp . $secretkey);
				
		$param = '?email=' . rawurlencode($email) . '&external_id=' . rawurlencode($external_id) .  '&firstname=' 
		. rawurlencode($firstname) . $groupsParam . '&hash=' . $hash . '&lastname=' . rawurlencode($lastname) 
		. '&timestamp=' . $timestamp . '&redirect=' . $redirect . '&redirectCvId=' . $redirectCvId . '&back_title=' . 
		$back_title . '&back_href=' . $back_href . '&back_target=' . $back_target . '&button_title=' . $button_title 
		. '&button_action=' . $button_action;
		
		$url = 'http://showcase.doyoubuzz.com/p/' . $lang . '/' . $slug . '/sso' . $param;

		header('location:'.$url, true, 302);
		exit;
	}
}