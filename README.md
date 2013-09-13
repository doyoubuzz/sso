DoYouBuzz Single Sign-On (SSO)
=======

The SSO connection for DoYouBuzz Campus and DoYouBuzz Showcase allow you to connect your resume database application to your own system (intranet, extranet, etc.).

## Activate the SSO in your Company settings

Go to the [SSO settings page](http://showcase.doyoubuzz.com/a/settings/sso). Then, generate a new key and enter the  URL on your system that will handle the SSO.

![SSO Settings](http://stock.doyoubuzz.com/doc/sso/sso-settings.png "SSO Settings")

## Configure the external id of the groups

If you want to link the user to a specific group (or groups) in DoYouBuzz Showcase / Campus, you need to edit the group on DoYouBuzz Showcase / Campus as an admin, and set the "external id". The "external id" is the id of the group in your system (it can be a numeric or alphanumric value)

![Group external ID](http://stock.doyoubuzz.com/doc/sso/group-external.png "Group External Id")

## The process

The SSO follow these different steps:

* You direct you visitor on the page http://showcase.doyoubuzz.com/p/fr/your-company/sso (don't forget to add the "cid" parameter in URL, if multiple URL mode is activated : http://showcase.doyoubuzz.com/p/fr/your-company/sso?cid=mycid)
* The visitor is automatically redirected on the URL you configured earlier with a timestamp parameter (it will be used for security purpose)
* This page must check if the user is logged in into your system. In this case, you must redirect this user to a specific URL with a few parameters (this URL is given on the [SSO settings page](http://showcase.doyoubuzz.com/a/settings/sso)), it looks like http://showcase.doyoubuzz.com/p/fr/your-company/sso 
* DoYouBuzz checks these parameters. If they are valid, several cases are possible :
 * The user has alreeady been authenticated on DoYouBuzz through your SSO: in this case, he is automaticlaly connected to his DoYouBuzz account
 * If he hasn't been authenticated previously through the SSO, he is asked to join your database with his DoYouBuzz account (he can use either an existing DoYouBuzz account or create a new account). 

Please note it may take up to 10 minutes before the user appears in your user list.

## Parameters to send to the SSO URL: 

When your redirect the user on the SSO URL, you must also send a few GET parameters. In the end, the URL will look like 

http://showcase.doyoubuzz.com/p/fr/your-company/sso?cid=mycid&email=kara.thrace%40doyoubuzz.com&external_id=kara-thrace&firstname=Kara&groups[]=pilote&groups[]=viper&user_type=1&hash=653e88ecb79d1a29aa1ed6bf8529d382&lastname=Thrace&timestamp=1349192825

Of course, all the data need to be "url encoded"

### email

The email of your user on your system

### external_id

The id of your user on your system. It can be a numeric or alphanumeric value

### firstname

Firstname of your user

### lastname

Lastname of your user

### groups[]

The id of the groups on your system that your user will join. Please note that these ids must be configured in DoYouBuzz Showcase / Campus.

If you have several groups, you can use ```&groups[]=group-1&groups[]=group-2```

### timestamp

This is the timestamp given earlier to you by the SSO page as a GET parameter. You just need to send it again to the SSO page as a security measure.

### user_type (optional)

It could be '1', '2' or '3'.

### hash

The hash parameter is a md5 of the concatenation of email, firstname, lastname, external_id, groups, timestamp and the secretkey.

In PHP: ```$hash = md5($email . $firstname . $lastname . $external_id . $group . $user_type . $timestamp . $secretkey);```

Please note : the group parameter is a concatenation of the differents groups. For example if your Kara Thrace belongs to the groups 'pilot' and 'viper' the $group variable above will be 'pilotviper'
