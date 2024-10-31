# PHP CPU Core Count Detection

This PHP script detects the number of CPU cores available on a Linux server. It can be helpful for optimizing performance in multi-threaded applications by dynamically assessing hardware capabilities.

## Purpose

This tool enables developers to retrieve the number of CPU cores on a Linux server using PHP. This is especially useful for performance optimizations and load balancing in server environments.

## Features

- Detects the number of CPU cores on Linux-based systems.
- Utilizes shell commands (`hash`, `nproc`, `taskset`) to gather system information.
- Lightweight and easy to integrate into existing PHP applications.

## Supported OS/Programs

Currently supports **Linux** only, using the following utilities:
- `hash`
- `nproc`
- `taskset`

## Clone this repository:

```bash
git clone https://github.com/your-user/php-cpu-core-detection.git
```

## Contributing
Contributions are welcome! To contribute:

1. Fork this repository.
2. Make your changes in a new branch.
3. Submit a pull request with a detailed description of your changes.

## Examples

Check out these examples to see the CPU core detection in action:
 ### Async
 ```
 $loop = Factory::create();

Detector::detectAsync($loop)->then(function ($result): void {
    echo $result, \PHP_EOL;
    for ($i = 0; $i < $result; $i++) {
        Resolver::resolve($i, 'uptime')->then(function ($cmd): void {
            echo $cmd, \PHP_EOL;
        });
    }
});

$loop->run();
 ```
 
 [Full Example](examples/async.php)
 
 ### Sync
 ```
$result = Detector::detect();
echo $result, \PHP_EOL;

for ($i = 0; $i < $result; $i++) {
    Resolver::resolve((string)$i, 'uptime')->then(function ($cmd): void {
        echo $cmd, \PHP_EOL;
    });
}
 ```
 
 [Full Example](examples/sync.php)


 
## License ##

Copyright 2016 [Cees-Jan Kiewiet](http://wyrihaximus.net/)

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
