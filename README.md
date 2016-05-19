# PHP-Tapfiliate

Simple PHP wrapper for the Tapfiliate API

### Sample Call

``` php
<?php
    require_once '/path/to/Tapfiliate.class.php';
    $key  = '*****';
    $tapfiliate = new TheNounProject($key);
    $programs = $tapfiliate->programs()->all();
    $conversion = $tapfiliate->conversions()->get(123);
    exit(0);

```
