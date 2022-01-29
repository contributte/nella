# Contributte Nella

Nella is opinionated pre-configured kernel based on Nette. Suitable for all kind of apps.

## Installation

```bash
composer require contributte/nella
```

## Usage

You can imagine Nella like a base layer for your application. It contains default setup for your app, thus you can focus on prototyping.

At this time it's suitable for smaller applications.

### Getting started

1. Install `contributte/nella` via `composer require contributte/nella`.

2. Build an application around it.

3. Run your application via `php -S 0.0.0.0:8000 -t www` and open your browser at [localhost:8000](http://localhost:8000).

4. Well, that's hard. Isn't it?

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
