<?php
/**
* Crypto Secure PRNG
* @copyright  2014 elcodedocle
*/
class CryptoSecurePRNG {
    private $intByteCount = 4;
    private $defaultMax = 2147483647;
    private $mcrypt;
    private $openssl;
    private $urandomFileHandler = false;
    public function getRandomBytesString($byteCount){
        $chars = '';
        if ($this->mcrypt) {
            $chars = mcrypt_create_iv($byteCount, MCRYPT_DEV_URANDOM);
        }
        if (!$chars && $this->openssl) {
            $chars = openssl_random_pseudo_bytes($byteCount);
        }
        if (!$chars && is_resource($this->urandomFileHandler)) {
            while (($len  = strlen($chars))< $byteCount) {
                $chars .= fread($this->urandomFileHandler, $byteCount - $len);
            }
        }
        if ($len = strlen($chars) < $byteCount) {
            for ($i=0;$i<$len;$i++) { $chars[$i] = $chars[$i] ^ chr(mt_rand(0, 255)); }
            for ($i = $len; $i < $byteCount; $i++) {
                $chars .= chr(mt_rand(0, 255));
            }
        }
		echo strlen($chars);
		echo "<br />";
		/// $chars = '123456787888';
		
        return $chars;
    }
    public function rand($min = 0, $max = null){
        if ($max === null) { $max = $this->defaultMax; }
        //if (!is_int($min)||!is_int($max)) { throw new Exception('$min and $max must be integers'); }
        if ($min>$max) { throw new Exception('$min must be <= $max'); }
        $chars = $this->getRandomBytesString($this->intByteCount);
        $n = 0;
        for ($i=0;$i<strlen($chars);$i++) {$n|=(ord($chars[$i])<<(8*(strlen($chars)-$i-1)));}
        return (abs($n)%($max-$min+1))+$min;
    }
    public function __construct(){
        $this->mcrypt  = function_exists('mcrypt_create_iv');
        $this->openssl = function_exists('openssl_random_pseudo_bytes');
        if (is_readable('/dev/urandom')){ $this->urandomFileHandler = fopen('/dev/urandom', 'r'); }
    }
    public function __destruct(){
        if (is_resource($this->urandomFileHandler )) fclose($this->urandomFileHandler);
    }
} 

?>