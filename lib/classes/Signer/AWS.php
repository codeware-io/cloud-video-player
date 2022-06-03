<?php 
namespace CVP\Signer;

use CVP\Shortcode;

class AWS {

	public static function init($src){
		$private_key_filename = '/home/test/secure/example-priv-key.pem';
		$key_pair_id = 'K2JCJMDEHXQW5F';
		
		$video_path = $src;
		
		$expires = time() + 300; // 5 min from now
		
		$client_ip = $_SERVER['REMOTE_ADDR'];
		$policy =
		'{'.
			'"Statement":['.
				'{'.
					'"Resource":"'. $video_path . '",'.
					'"Condition":{'.
						'"IpAddress":{"AWS:SourceIp":"' . $client_ip . '/32"},'.
						'"DateLessThan":{"AWS:EpochTime":' . $expires . '}'.
					'}'.
				'}'.
			']' .
			'}';
	    
		self::get_custom_policy_stream_name($video_path, $private_key_filename, $key_pair_id, $policy);
	}
	

    public static function rsa_sha1_sign($policy, $private_key_filename) {
		$signature = "";

		// load the private key
		$fp = fopen($private_key_filename, "r");
		$priv_key = fread($fp, 8192);
		fclose($fp);
		$pkeyid = openssl_get_privatekey($priv_key);

		// compute signature
		openssl_sign($policy, $signature, $pkeyid);

		// free the key from memory
		openssl_free_key($pkeyid);

		return $signature;
	}

	public static function url_safe_base64_encode($value) {
    	$encoded = base64_encode($value);
		// replace unsafe characters +, = and / with the safe characters -, _ and ~
		return str_replace(
			array('+', '=', '/'),
			array('-', '_', '~'),
			$encoded);
	}

	public static function create_stream_name($stream, $policy, $signature, $key_pair_id, $expires) {
		$result = $stream;
		// if the stream already contains query parameters, attach the new query parameters to the end
		// otherwise, add the query parameters
		$separator = strpos($stream, '?') == FALSE ? '?' : '&';
		// the presence of an expires time means we're using a canned policy
		if($expires) {
			$result .= $path . $separator . "Expires=" . $expires . "&Signature=" . $signature . "&Key-Pair-Id=" . $key_pair_id;
		}
		// not using a canned policy, include the policy itself in the stream name
		else {
			$result .= $path . $separator . "Policy=" . $policy . "&Signature=" . $signature . "&Key-Pair-Id=" . $key_pair_id;
		}

		// new lines would break us, so remove them
		return str_replace('\n', '', $result);
	}

	public static function encode_query_params($stream_name) {
		// Adobe Flash Player has trouble with query parameters being passed into it,
		// so replace the bad characters with their URL-encoded forms
		$signed_url =  str_replace(
			array('?', '=', '&'),
			array('%3F', '%3D', '%26'),
			$stream_name);
         
			echo'<video width="320" height="240" controls autoplay>
					<source src="'.$signed_url.'" type="video/mp4">
				</video>';
	}

	public static function get_custom_policy_stream_name($video_path, $private_key_filename, $key_pair_id, $policy) {
		// the policy contains characters that cannot be part of a URL, so we base64 encode it
		$encoded_policy = self::url_safe_base64_encode($policy);
		// sign the original policy, not the encoded version
		$signature =  self::rsa_sha1_sign($policy, $private_key_filename);
		// make the signature safe to be included in a URL
		$encoded_signature = self::url_safe_base64_encode($signature);

		// combine the above into a stream name
		$stream_name = self::create_stream_name($video_path, $encoded_policy, $encoded_signature, $key_pair_id, null);
		// URL-encode the query string characters to support Flash Player
		return self::encode_query_params($stream_name);
	}

}