#!/bin/bash
# Imagespng script

IMGDIR="$1"
PDFnom="$2"


for i in ${@:3}
do
	NAME=$i
	img_modif=`stat -c "%Y" ${IMGDIR}/${NAME}.uml`
	
	if [ -f ${PDFnom} ]; then 
		pdf_modif=`stat -c "%Y" ${PDFnom}`
		if [ $(($img_modif-$pdf_modif)) -gt 0 ]; then 
			${UML} ${IMGDIR}/${NAME}.uml
		fi
	else
		${UML} ${IMGDIR}/${NAME}.uml
	fi
done
