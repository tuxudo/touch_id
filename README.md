Touch ID Module
==============

Gets data about Touch ID and enrolled fingerprints on the Mac.


Table Schema
----

* enabled - BOOLEAN - Boolean if Touch ID is enabled or disabled
* unlock - BOOLEAN - Boolean if unlock with Touch ID is enabled or disabled
* fingerprints - TEXT - String containing username, user ID, and count of fingerprints enrolled per user
* timeout - INT(11) - Timeout of Touch ID in seconds
