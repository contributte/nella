![](https://heatbadger.now.sh/github/readme/contributte/nella/)

<p align=center>
  <a href="https://github.com/contributte/nella/actions"><img src="https://badgen.net/github/checks/contributte/nella/master?cache=300"></a>
  <a href="https://codecov.io/gh/contributte/nella"><img src="https://badgen.net/codecov/c/github/contributte/nella"></a>
  <a href="https://packagist.org/packages/contributte/nella"> <img src="https://badgen.net/packagist/dm/contributte/nella"> </a>
  <a href="https://packagist.org/packages/contributte/nella"> <img src="https://badgen.net/packagist/v/contributte/nella"> </a>
</p>
<p align=center>
  <a href="https://packagist.org/packages/contributte/nella"><img src="https://badgen.net/packagist/php/contributte/nella"></a>
  <a href="https://github.com/contributte/nella"><img src="https://badgen.net/github/license/contributte/nella"></a>
  <a href="https://bit.ly/ctteg"><img src="https://badgen.net/badge/support/gitter/cyan"></a>
  <a href="https://bit.ly/cttfo"><img src="https://badgen.net/badge/support/forum/yellow"></a>
  <a href="https://contributte.org/partners.html"><img src="https://badgen.net/badge/become/a%20patron/F96854"></a>
</p>

<p align=center>
Website 🚀 <a href="https://contributte.org">contributte.org</a> | Contact 👨🏻‍💻 <a href="https://f3l1x.io">f3l1x.io</a> | Twitter 🐦 <a href="https://twitter.com/contributte">@contributte</a>
</p>

Nella is an opinionated pre-configured kernel based on Nette. It is suitable for prototyping and smaller applications.

## Versions

| State  | Version | Branch   | Nette | PHP     |
|--------|---------|----------|-------|---------|
| dev    | `^0.3`  | `master` | 3.1+  | `>=8.1` |
| stable | `^0.2`  | `master` | 3.1+  | `>=8.1` |

## Installation

To install the latest version of `contributte/nella` use [Composer](https://getcomposer.org).

```bash
composer require contributte/nella
```

## Usage

You can imagine Nella like a base layer for your application. It contains default setup for your app, thus you can focus on prototyping.

At this time it's suitable for smaller applications.

### Getting Started

1. Build an application around it.

2. Run your application via `php -S 0.0.0.0:8000 -t www` and open your browser at [localhost:8000](http://localhost:8000).

3. Well, that's hard. Isn't it?

### Generator

1. Install `contributte/nellagen` via `composer require contributte/nellagen`.

2. Let's generate your project structure via `vendor/bin/nellagen skeleton`.

3. Run your application via `php -S 0.0.0.0:8000 -t www` and open your browser at [localhost:8000](http://localhost:8000).

4. That's all. You can play with it.

### Architecture

**Project structure**

```
├── app
│ ├── Bootstrap.php
│ └── UI
│     ├── @Templates
│     │ └── @layout.latte
│     ├── BasePresenter.php
│     └── Home
│         ├── HomePresenter.php
│         └── Templates
│             └── default.latte
├── config
│ ├── config.neon
├── var
│ ├── log
│ └── tmp
└── www
    └── index.php
```

**Bootstrap**

```php
<?php declare(strict_types = 1);

namespace App;

use Contributte\Bootstrap\ExtraConfigurator;

final class Bootstrap
{

	public static function boot(): ExtraConfigurator
	{
		return Bootloader::create()
			->use(NellaPreset::create(__DIR__))
			->boot();
	}

}

```

**Presenters**

The presenters in your app can extend `Contributte\Nella\UI\NellaPresenter`.

You can also create a `BasePresenter`.

```php
<?php declare(strict_types = 1);

namespace App\UI;

use Contributte\Nella\UI\NellaPresenter;

abstract class BasePresenter extends NellaPresenter
{
}
```

**Layout**

Nella will try to lookup for `app/UI/@Templates/@layout.latte` according to conventions.

## Examples

There is example project [contributte/nella-skeleton](https://github.com/contributte/nella-skeleton).

## Development

See [how to contribute](https://contributte.org/contributing.html) to this package.

This package is currently maintaining by these authors.

<a href="https://github.com/f3l1x">
  <img width="80" height="80" src="https://avatars2.githubusercontent.com/u/538058?v=3&s=80">
</a>

-----

Consider to [support](https://contributte.org/partners.html) **contributte** development team.
Also thank you for using this package.
