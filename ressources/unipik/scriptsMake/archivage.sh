#!/bin/bash
# version 1.00, date 23/01/16, auteur Pierre Porche
# Archivage script

ARCHIVEDIR="$1"
mkdir -p ${ARCHIVEDIR}
cp pdf/*.pdf ${ARCHIVEDIR}
