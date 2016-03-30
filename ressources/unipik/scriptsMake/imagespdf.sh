#!/bin/bash
# Imagespdf script


IMGDIR="$1"


for i in ${@:2}
do
	NAME=$i
	dia -e ${IMGDIR}/${NAME}.eps --filter=eps-builtin ${IMGDIR}/${NAME}.dia
	ps2pdf -dEPSCrop ${IMGDIR}/${NAME}.eps ${IMGDIR}/${NAME}.pdf
done
