#!/bin/bash
# Textopdf script


PDFDIR="$1"
CLSPATH="$2"
VOCPATH="$3"
FICPATH="$4"
CCTEX="rubber -d"
TEXINPUTS=${TEXINPUTS}:${CLSPATH}:${VOCPATH}
export TEXINPUTS



for i in ${@:5}
do
	NAME=$i
	${CCTEX} $FICPATH/${NAME}
	mv ${NAME}.pdf ${PDFDIR}
done

