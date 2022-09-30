<?php

$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://freesms8.p.rapidapi.com/index.php?uid=username&pwd=password&phone=7979968593&msg=hello",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"x-rapidapi-host: freesms8.p.rapidapi.com",
		"x-rapidapi-key: 3c217dad6emshd445c15d3698d28p10a7a3jsnc5fec55d532e"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}