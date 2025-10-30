<?php
$structured_data = array(
'@context'   => 'https://schema.org',
'@type'      => 'FAQPage',
'mainEntity' => array_map(
function ( $item ) {
return array(
'@type'          => 'Question',
'name'           => $item['question'],
'acceptedAnswer' => array(
'@type' => 'Answer',
'text'  => $item['answer'],
),
);
},
$payload['faq']
),
);

echo wp_json_encode( $structured_data );
