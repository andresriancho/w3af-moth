## w3af's moth

A set of vulnerable PHP scripts used to test w3af's vulnerability detection features.

The main repository for the [w3af project](https://github.com/andresriancho/w3af/) can
be found [here](https://github.com/andresriancho/w3af/).

## Usage

The easiest way to use `w3af-moth` is to start a [docker](https://www.docker.com/) container:

```bash
sudo docker run -p 80:80 -p 2222:22 andresriancho/w3af-moth
```

And then add the following lines to your `/etc/hosts` file:
```text
127.0.0.1 intranet
127.0.0.1 default
127.0.0.1 moth
```

Please note that you can build the docker image yourself:
```bash
sudo docker build -t andresriancho/w3af-moth .
```

Or simply [get it from the registry](https://registry.hub.docker.com/u/andresriancho/w3af-moth/):
```bash
sudo docker pull andresriancho/w3af-moth
```

Use SSH to connect to `moth` with `root` and `MxqQt6iKUP6igE` as password:
```bash
ssh root@127.0.0.1 -p 2222
```

## History

`Moth` was born as a test environment for the [w3af project](https://github.com/andresriancho/w3af/)
can be found [here](https://github.com/andresriancho/w3af/). The code that lives in this repository
was usually bundled in a Virtual Machine and used from there.

After years of development I decided to move most of the features provided by this code to two different
repositories:
 * https://github.com/andresriancho/django-moth
 * https://github.com/andresriancho/php-moth

The decision was made while writing unittests for `w3af`, which needed to run easily on our CI system,
and `w3af-moth` wasn't designed to be used in that way (too many custom Apache configs, ugly PHP
configs, etc).

Django-moth, received most of the attention and code. This is the repository which holds most of the test
cases for the `w3af` framework.

PHP-moth is a much smaller test suite which only contains test scripts for PHP-specific vulnerabilities.

## Deprecation warning

While you can still use this repository for testing your scanner, education or any other purpose, I
don't guarantee that I'll fix bugs, issues, or improve it in any way.
