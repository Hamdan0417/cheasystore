<?php
$structured_data = array(
'@context' => 'https://schema.org',
'@type'    => 'Organization',
'name'     => $payload['name'],
'url'      => $payload['url'],
);

echo wp_json_encode( $structured_data );
