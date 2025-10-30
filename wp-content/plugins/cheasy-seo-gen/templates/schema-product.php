<?php
$structured_data = array(
'@context'    => 'https://schema.org/',
'@type'       => 'Product',
'name'        => $payload['name'],
'description' => $payload['description'],
'sku'         => $payload['sku'],
'offers'      => array(
'@type'         => 'Offer',
'priceCurrency' => $payload['currency'],
'price'         => $payload['price'],
'availability'  => $payload['availability'],
'url'           => get_permalink(),
),
);

echo wp_json_encode( $structured_data );
