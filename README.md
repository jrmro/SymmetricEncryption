# Symmetric Encryption Class

This PHP class provides methods for symmetric encryption and decryption using OpenSSL. It encapsulates the necessary logic for encrypting and decrypting data with a provided secret key.

## Sample Usage

```
include 'SymmetricEncryption.class.php'; // Include the SymmetricEncryption class

$secret_key = "YourSecretKey"; // Replace with your actual secret key
$encryptor = new SymmetricEncryption($secret_key);

$encrypted_data = $encryptor->encrypt("Hello, this is a test message.");
echo "Encrypted Data: {$encrypted_data}\n";

$decrypted_data = $encryptor->decrypt($encrypted_data);
echo "Decrypted Data: {$decrypted_data}\n";
```

## Note
* Ensure you replace 'YourSecretKey' with your actual secret key in the examples.
* The class uses OpenSSL for encryption and decryption. Make sure OpenSSL is enabled in your PHP configuration.
* Handle and store the secret key securely. Do not hardcode it in your code.

## License
This code is released under the MIT License.
