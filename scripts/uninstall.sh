#!/bin/bash

# Remove touch_id script
rm -f "${MUNKIPATH}preflight.d/touch_id"

# Remove touch_id.plist cache file
rm -f "${MUNKIPATH}preflight.d/cache/touch_id.plist"
