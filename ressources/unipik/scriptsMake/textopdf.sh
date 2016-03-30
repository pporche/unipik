#!/bin/bash
# Textopdf script


PDFDIR="$1"
CLSPATH="$2"
VOCPATH="$3"
CCTEX="rubber -d"
TEXINPUTS=${TEXINPUTS}:${CLSPATH}:${VOCPATH}
export TEXINPUTS



for i in ${@:4}
do
	NAME=$i
	${CCTEX} ${NAME}
	mv ${NAME}.pdf ${PDFDIR}
done

