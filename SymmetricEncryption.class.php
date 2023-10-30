<?php

/**
* https://github.com/jrmro/SymmetricEncryption
* 
* This PHP class provides methods for symmetric encryption and decryption using OpenSSL. 
* It encapsulates the necessary logic for encrypting and decrypting data with a provided secret key.
*
* Example Usage:
*
* include 'SymmetricEncryption.class.php'; // Include the SymmetricEncryption class
*
* $secret_key = "YourSecretKey"; // Replace with your actual secret key
* $encryptor = new SymmetricEncryption($secret_key);
*
* $encrypted_data = $encryptor->encrypt("Hello, this is a test message.");
* echo "Encrypted Data: $encrypted_data\n";
*
* $decrypted_data = $encryptor->decrypt($encrypted_data);
* echo "Decrypted Data: $decrypted_data\n";
*
* @license    MIT License
* @author     Joseph Romero
* @version    1.0
* ...
*/
class SymmetricEncryption {

    private $method;
    private $secret_key;

    public function __construct($secret_key, $method = 'AES-256-CBC') {
        $this->secret_key = $secret_key;
        $this->method = $method;
    }

    public function encrypt($data) {
        $nonce = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method));
        $encrypted = openssl_encrypt($data, $this->method, $this->secret_key, 0, $nonce);
        return base64_encode($nonce . $encrypted);
    }

    public function decrypt($data) {
        $encrypted = base64_decode($data);
        $nonce = substr($encrypted, 0, openssl_cipher_iv_length($this->method));
        $encrypted = substr($encrypted, openssl_cipher_iv_length($this->method));
        return openssl_decrypt($encrypted, $this->method, $this->secret_key, 0, $nonce);
    }

}
