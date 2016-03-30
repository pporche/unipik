#!/bin/bash
# Archivage script

ARCHIVEDIR="$1"
mkdir -p ${ARCHIVEDIR}
cp pdf/*.pdf ${ARCHIVEDIR}
