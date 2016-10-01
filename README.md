# PHProfiler

A simple library for doing profiling without a need for thousands of external dependencies.

[![Build Status](https://travis-ci.org/ngranko/phprofiler.svg?branch=master)](https://travis-ci.org/ngranko/phprofiler) [![Code Climate](https://codeclimate.com/github/ngranko/phprofiler/badges/gpa.svg)](https://codeclimate.com/github/ngranko/phprofiler)

## Installation

The simplest way to install it is to use Composer:

```
composer require ngranko/phprofiler
```

Or you can move the contents of this repository to a folder of your liking and then have a lot of fun making the autoloading work, etc.

## Usage

#### Initialization

To use the library simply create a new PHProfiler object:

```php
<?php
$profiler = PHProfiler::initialize();
```

This will initialize the profiler and set current time and memory consumption values as reference to calculate relative time and memory usage against.

#### Capturing a point

To capture a point, do:

```php
<?php
$profiler = PHProfiler::initialize();
$profiler->rememberPoint();
```

This will capture a current state of the system: time elapsed and memory usage.

#### Exporting results

Depending on a type of export you want to do, do one of those:

```php
<?php
$profiler = PHProfiler::initialize();
$profiler->rememberPoint();
$profiler->exportToLogFile();
```

or

```php
<?php
$profiler = PHProfiler::initialize();
$profiler->rememberPoint();
$profiler->exportToCsvFile();
```

By default, a file will be created in your current working directory, named `profiler_output_[timestamp].[extension]`. If you want to save result to some other place, simply specify a desired path (with a filename) to the export call.

Currently the profiler only exports results to a text (`.log` by default) or csv file, but more options are coming later.
