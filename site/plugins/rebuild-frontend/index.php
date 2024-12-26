<?php

Kirby::plugin('ericwaetke/rebuild-frontend', [
	'options' => [
		'enabled' => false,
		'dokploy' => [
			'url' => '',
			'token' => '',
			'application_id' => ''
		]
	],
	'hooks' => [
		'page.update:after' => function ($newPage, $oldPage) {
			$enabled = option('ericwaetke.rebuild-frontend.enabled');
			if (!$enabled) {
				return;
			}
			$dokploy = option('ericwaetke.rebuild-frontend.dokploy');
			$url = $dokploy['url'];
			$token = $dokploy['token'];
			$token = str_replace(PHP_EOL, '', $token);
			$application_id = $dokploy['application_id'];
			if (empty($url)) {
				throw new Exception('Dokploy URL is not set');
			}
			if (empty($token)) {
				throw new Exception('Dokploy Token is not set');
			}
			if (empty($application_id)) {
				throw new Exception('Dokploy Application ID is not set');
			}
			// Rebuild Frontend by calling Dokploy API
			$url = $url . 'api/application.deploy';
			// Add Token as Bearer Auth Header
			$authorization = 'Authorization: Bearer '.$token;
			// Add Application ID to JSON Body
			// $data = array('application_id' => option('ericwaetke.rebuild-frontend.dokploy.application_id'));
			$data = [
				"applicationId" => $application_id
			];

			// Convert the array to JSON
			$json = json_encode($data); // Use JSON_PRETTY_PRINT for nicely formatted JSON

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://dokploy.woven.design/api/application.deploy");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true); // Specify this is a POST request
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json); // Add the JSON data to the body
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				"Authorization: Bearer " . $token,
				"Content-Type: application/json"
			]);

			$response = curl_exec($ch);

			if(curl_errno($ch)) {
				echo 'Curl error: ' . curl_error($ch);
			} else {
				echo $response;
			}

			curl_close($ch);
		}
	]
]);