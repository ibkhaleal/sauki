<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://fsi.ng/api/v1/flutterwave/v3/charges?type=card',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "client": "C10EgEYkJrusinoq55RgQ7rl+hlselSCuuX6GWx6VIJ7Ec7hXCGXup9Ukx8Luge/2HH2WYqXHvqdgrwMxhwlFMUV7tgqgH9ZCoe37pCnvkSkToNPiAbU0jG7L5i+WCxVR5/RaF0p0wbts8nb291rlgpnkk7QPuI2HcqR9R5Uairt/0O+PEmmFhF9v9A92X1w3zyAsGKQH98XxJxP9tAn176RahJL0upUhxrkJHoyJdaE55iicZGpg7Gu/CMYkgQHBGj3ODzL4Bla+pO+50wh5j2BIR+yjx8/V6uMw0qEPvfi5w+zQMoyQhFKvaYxk9P23L+SqR1tBzkty/aV4SCwLmpnzQnbXUewBqxZTQH+1MI="
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'sandbox-key: FL7Xppism18pd9RAtnYhsSi6Y8hKkENI1660725874',
    'Authorization: dskjdks'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>