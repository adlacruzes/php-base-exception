# PHP Base exception

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.2-8892BF.svg?style=flat-square)](https://php.net/)
[![Packagist](https://img.shields.io/packagist/v/adlacruzes/php-base-exception?style=flat-square)](https://packagist.org/packages/adlacruzes/php-base-exception)
![Github actions](https://github.com/adlacruzes/php-base-exception/workflows/Continuous%20Integration/badge.svg?branch=master)

PHP base exception is a library that provides exceptions with a default message and a custom value in an easy way.


## Requirements
PHP needs to be a minimum version of PHP 7.2.

## Installation

The recommended way to install is through Composer.

```sh
composer require adlacruzes/php-base-exception
```

## Usage

Create an exception that extends from BaseException.

```php
use Adlacruzes\Exceptions\BaseException;

class SomethingNotFoundException extends BaseException {}
```

Then the exception can be called with no arguments.

```php
try {
    throw new SomethingNotFoundException();
} catch (SomethingNotFoundException $e) {
    echo $e->getMessage();
}
```

The method ``getMessage()`` returns an auto generated message based on the class name without typing anything more.

```php
echo $e->getMessage();
// Something not found
```

### Default message

You can choose a default message instead. Just initialize the message variable.

```php
class SomethingNotFoundException extends BaseException {
    
    protected $message = 'This is a default message';
    
}
```

```php
try {
    throw new SomethingNotFoundException();
} catch (SomethingNotFoundException $e) {
    echo $e->getMessage();
}
```

```php
echo $e->getMessage();
// This is a default message
```

### Message with contextual information

In addition to the message, you can provide more information to the exception and it will append to the result.

```php
try {
    throw new SomethingNotFoundException('information');
} catch (SomethingNotFoundException $e) {
    echo $e->getMessage();
}
```

And the output will be:

```php
echo $e->getMessage();
// Something not found: information
```
