<?php

/**
* https://github.com/jrmro/SymmetricEncryption
* 
* This PHP class provides methods for symmetric encryption and decryption using OpenSSL. 
* It encapsulates the necessary logic for encrypting and decrypting data with a secret key.
*
* (Note: For client-side JavaScript symmetric encryption, see https://github.com/jrmro/SymmetricEncryptionJS).
*
* Example Usage:
*
* include 'SymmetricEncryption.class.php'; // Include the SymmetricEncryption class
*
* $original_data = "Hello, this is a secret message.";
*
* $encryptor = new SymmetricEncryption('AES-256-CBC'); // Initialize with optional encryption algorithm (default: 'AES-256-CBC')
*
* // Create a secret key from a password (optional). You can bring your own secret key too.
* $secret_key = derive_key("YourPassword"); // Replace with your actual password
*
* $encrypted_data = $encryptor->encrypt($original_data, $secret_key);
* echo "Encrypted Data: {$encrypted_data}\n";
*
* $decrypted_data = $encryptor->decrypt($encrypted_data, $secret_key);
* echo "Decrypted Data: {$decrypted_data}\n";
*
* @license    MIT License
* @author     Joseph Romero
* @version    2.0.0
* ...
*/
class SymmetricEncryption 
{

    private $algorithm;

    public function __construct($algorithm  = 'AES-256-CBC') 
    {
        $this->algorithm = $algorithm;
    }

    public function derive_key($password) 
    {
        // Convert password to UTF-8 encoding
        $password = mb_convert_encoding($password, 'UTF-8');
    
        // Define salt, iteration count, and key length
        $salt = bin2hex(random_bytes(16)); // Random 16 byte salt
        $iterations = 100000;
        $key_length = 32; // 256 bits
    
        // Derive key using PBKDF2
        $derivedKey = hash_pbkdf2('sha256', $password, $salt, $iterations, $key_length, true);
    
        // Convert the binary key to a hexadecimal string
        $secret_key = bin2hex($derivedKey);
    
        return $secret_key;
    }

    public function encrypt($data, $secret_key) 
    {
        $nonce = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->algorithm));
        $encrypted = openssl_encrypt($data, $this->algorithm, $secret_key, 0, $nonce);
        return base64_encode($nonce . $encrypted);
    }

    public function decrypt($encrypted, $secret_key) 
    {
        $encrypted = base64_decode($encrypted);
        $nonce = substr($encrypted, 0, openssl_cipher_iv_length($this->algorithm));
        $encrypted = substr($encrypted, openssl_cipher_iv_length($this->algorithm));
        return openssl_decrypt($encrypted, $this->algorithm, $secret_key, 0, $nonce);
    }

}
