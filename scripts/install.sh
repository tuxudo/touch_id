#!/bin/bash

# touch_id controller
CTL="${BASEURL}index.php?/module/touch_id/"

# Get the scripts in the proper directories
"${CURL[@]}" "${CTL}get_script/touch_id" -o "${MUNKIPATH}preflight.d/touch_id"

# Check exit status of curl
if [ $? = 0 ]; then
	# Make executable
	chmod a+x "${MUNKIPATH}preflight.d/touch_id"

	# Set preference to include this file in the preflight check
	setreportpref "touch_id" "${CACHEPATH}touch_id.plist"

else
	echo "Failed to download all required components!"
	rm -f "${MUNKIPATH}preflight.d/touch_id"

	# Signal that we had an error
	ERR=1
fi
