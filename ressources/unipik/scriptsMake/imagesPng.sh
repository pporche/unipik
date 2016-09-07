#!/bin/bash
# version 1.00, date 23/01/16, auteur Pierre Porche
# Imagespng script

IMGDIR="$1"
PDFnom="$2"


for i in ${@:3}
do
	NAME=$i
	img_modif=`stat -c "%Y" ${IMGDIR}/${NAME}.dia`
	
	if [ -f ${PDFnom} ]; then 
		pdf_modif=`stat -c "%Y" ${PDFnom}`
		if [ $(($img_modif-$pdf_modif)) -gt 0 ]; then 
			dia -e ${IMGDIR}/${NAME}.png --filter=png ${IMGDIR}/${NAME}.dia
		fi
	else
		dia -e ${IMGDIR}/${NAME}.png --filter=png ${IMGDIR}/${NAME}.dia
	fi
done
