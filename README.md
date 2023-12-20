Touch ID Module
==============

Gets data about biometrics, like Touch ID, and enrolled fingerprints on the Mac.


Table Schema
----

* enabled - BOOLEAN - Boolean if biometrics are enabled or disabled
* unlock - BOOLEAN - Boolean if unlock with biometrics are enabled or disabled
* fingerprints - TEXT - String containing username, user ID, and count of fingerprints enrolled per user
* timeout - INT(11) - Timeout of biometrics in seconds
* match_timeout - INT(11) - Timeout of biometrics looking for a match
* passcode_input_timeout - INT(11) - Timeout of biometrics asking for passcode
