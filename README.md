# PHP-Tapfiliate
Factory based PHP wrapper for the Tapfiliate API.

### Note
Requires
[PHP-RemoteRequests](https://github.com/onassar/PHP-RemoteRequests).

### Sample Calls
``` php
require_once '/path/to/Factory.class.php';
$key  = '*****';
$tapfiliate = new onassar\Tapfiliate\Factory($key);
$programs = $tapfiliate->programs()->find();
$conversion = $tapfiliate->conversions()->get(123);
exit(0);
```
