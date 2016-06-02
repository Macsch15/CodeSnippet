###CodeSnippet
CodeSnippet - get code snippet from file (helpful on exceptions page for example)

###Requirements
- PHP 5.4 (or above)
- Composer
- PHPUnit (for automated testing)

###Usage
```
$ composer require macsch15/codesnippet dev-master
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
public function toJson($trim = false)
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

###Unit testing
```
$ composer install --dev
$ phpunit
```

###MIT Licence

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
