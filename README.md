### CodeSnippet [![Build Status](https://travis-ci.org/Macsch15/CodeSnippet.svg?branch=master)](https://travis-ci.org/Macsch15/CodeSnippet) [![Coverage Status](https://coveralls.io/repos/github/Macsch15/CodeSnippet/badge.svg?branch=master)](https://coveralls.io/github/Macsch15/CodeSnippet?branch=master)
CodeSnippet - get code snippet from file (helpful for exception handlers for example)

### Requirements
- PHP 5.6 (or above)
- Composer
- PHPUnit (for automated testing)

### Usage
```
$ composer require macsch15/codesnippet 1.1.*
```

```php
<?php
require './vendor/autoload.php';

use CodeSnippet\Snippet;

$snippet = new Snippet();
$snippet
    ->file(__DIR__ . '/myFile.ext') // Load file, throws NotFoundException if file not exists
    ->start(33) // Start from 33 line
    ->length(10) // Maximum snippet length is 10
    ->toArray(); // Return results as array, if first argument is set to true, returned lines will be trimmed
```

Available return methods:
```php
public function toArray($trim = false)
```
```php
public function toJson($trim = false, $options = 0)
```
```php
public function toString($new_line = '\n', $trim = false)
```

Helper methods:
```php
public function startsFrom()
```
```php
public function getLength()
```
```php
public function getFilename()
```

### Unit testing
```
$ composer install
$ phpunit
```

## Author
**Maciej Schmidt**
- [Homepage](http://www.macsch15.pl/ "Homepage")
- [Twitter](https://twitter.com/Macsch15 "Twitter")
- [Donate with PayPal](https://www.paypal.me/MaciejSchmidt "Donate with PayPal")

### MIT Licence

Copyright (c) 2016 Maciej Schmidt

Permission is hereby granted, free of charge, to any person obtaining a copy 
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is furnished
to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
