#!/bin/bash

set -e

exec >> /tmp/xlog.txt
exec 2>> /tmp/xlog.txt

echo Command line: "$@"
echo Date: $(date)
./2upps "$@"

# clean up tempfiles older than 60 minutes

find /tmp -wholename '/tmp/pdf2up*' -mmin +60 -delete || true
