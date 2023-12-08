# Symmetric Encryption Class

This PHP class provides methods for symmetric encryption and decryption using OpenSSL. It encapsulates the necessary logic for encrypting and decrypting data with a secret key.

(Note: For client-side JavaScript symmetric encryption, see [https://github.com/jrmro/SymmetricEncryptionJS](https://github.com/jrmro/SymmetricEncryptionJS)).

## Sample Usage

```
include 'SymmetricEncryption.class.php'; // Include the SymmetricEncryption class

$original_data = "Hello, this is a secret message.";

$encryptor = new SymmetricEncryption('AES-256-CBC'); // Initialize with optional encryption algorithm (default: 'AES-256-CBC')

// Create a secret key from a password (optional). You can bring your own secret key too.
$secret_key = $encryptor->derive_key("YourPassword"); // Replace with your actual password

$encrypted_data = $encryptor->encrypt($original_data, $secret_key);
echo "Encrypted Data: {$encrypted_data}\n";

$decrypted_data = $encryptor->decrypt($encrypted_data, $secret_key);
echo "Decrypted Data: {$decrypted_data}\n";
```

## Note
* If deriving a secret key from a password, ensure you replace 'YourPassword' with your actual password in the example.
* Alternatively, if bringing your own secret key, assign it to the `$secret_key` variable instead of using `$encryptor->derive_key('YourPassword')`. 
* The class uses OpenSSL for encryption and decryption. Make sure OpenSSL is enabled in your PHP configuration.
* Handle and store your secret key securely. Do not hardcode it in your project.

## Author
Joseph Romero

## License
This code is released under the MIT License.
