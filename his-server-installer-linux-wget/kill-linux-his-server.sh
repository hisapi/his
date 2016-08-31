#!/bin/bash
ps x|grep his|grep -v grep|grep -v update| awk '/his/ {system("kill -9 "$1);}' || echo "kill complete"
