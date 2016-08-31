#!/bin/bash
./kill-linux-his-server.sh || echo "kill complete"

if [ -d his ]; then
  rm -rf his
fi

# DOWNLOAD HIS
if [ ! -d his ]; then
    wget --no-check-certificate --output-document=his.tar "https://humanintelligencesystem.com/version/?get=current&type=tar"
    tar xvf his.tar
fi
