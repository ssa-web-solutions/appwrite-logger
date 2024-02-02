# appwrite-logger

It's just a helper class I use in my appwrite functions to call my log function that submits the log to logz.io services.

If you find it useful you could deploy the function in your appwrite server and then install the Logger package in your PHP function and use it like below:

```php
$logger = new Logger(new Functions($client));
$logger->log("My Log", ['tagA', 'tagB']);
```

It seems to be recommended to avoid using appwrite log functions due to the issue below:

https://discord.com/channels/564160730845151244/1202496275967115275