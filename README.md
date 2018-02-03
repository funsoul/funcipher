funcipher
======
Custom random ciphertext

## Install

```
composer require "funsoul/funcipher: 1.3"
```

## Usage

```php
use Funsoul\Funcipher\Funcipher;

echo Funcipher::create(10,[CIPHER_USE_LOWER,CIPHER_USE_CAPITAL,CIPHER_USE_NUMBER]);
// 5C987I9d8L
```

# License

MIT