<?php

class Task1 {
	//Function add custom meta field interested on products
	function add_custom_fields() {
		register_rest_field(
			'product',
			'interested',
			array(
				'get_callback'    => null,
				'update_callback' => null,
				'schema'          => null,
			)
		);
	}

	//Function if not in stock
	function if_not_in_stock( $id ) {
		return "<button class='button product_type_simple ajaxPhp' value='{$id}'>Interested</button>";
	}
	

	//Sending emails to interested customers
	function send_mail( $product ) {
		$email_api = get_post_meta( $product->id, 'interested' );
		foreach ( $email_api[0] as $email ) {
			$to      = $email;
			$subject = 'Product Availability Notice';
			$message = `Dear users, we inform you that the product {$product->name} is available.`;
			$headers = 'From: webmaster@example.com' . "\r\n" .
			           'Reply-To: webmaster@example.com' . "\r\n" .
			           'X-Mailer: PHP/' . phpversion();

			mail( $to, $subject, $message, $headers );

		}
		delete_post_meta( $product->id, 'interested' );
	}
}








