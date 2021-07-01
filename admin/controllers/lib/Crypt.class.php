<?php

class crypt
{
	private $algorithm;
	private $mode;
	private $random_source;
	public $cleartext;
	public $ciphertext;
	public $iv;

	public function __construct($algorithm = MCRYPT_BLOWFISH,$mode = MCRYPT_MODE_CBC,$random_source = MCRYPT_DEV_URANDOM)
	{
		$this->algorithm = $algorithm;
		$this->mode = $mode;
		$this->random_source = $random_source;
	}
	
	
	public function generate_iv()
	{
		$this->iv = mcrypt_create_iv(mcrypt_get_iv_size($this->algorithm,
		$this->mode), $this->random_source);
	}
	
	
	public function encrypt($text)
	{
		$this->cleartext = $text;
		$this->generate_iv();
		$this->ciphertext = mcrypt_encrypt($this->algorithm,CRYPT_KEY, $this->cleartext, $this->mode, $this->iv);
		$ciphertext = $this->ciphertext;
		$iv = $this->iv;
		$string = base64_encode($iv . $ciphertext);
		 $string = base64_encode($iv . $ciphertext);
		$string = urlencode($string);
		return $string = htmlentities($string);
	}
	
	public function decrypt($text)
	{
	$string = base64_decode($text);
	$iv_size = mcrypt_get_iv_size( MCRYPT_BLOWFISH, MCRYPT_MODE_CBC);
	$ciphertext = substr($string, $iv_size);
	$iv = substr($string, 0, $iv_size);
	$this->iv = $iv;
	$this->ciphertext = $ciphertext;
	$this->cleartext = mcrypt_decrypt($this->algorithm,CRYPT_KEY, $this->ciphertext, $this->mode, $this->iv);
	return trim(urldecode($cleartext = $this->cleartext));
	}
	
	
}
$crypt = new crypt();

?>