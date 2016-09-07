#!/bin/bash
# version 1.00, date 23/01/16, auteur Pierre Porche
# Cleanpdf script


for i in ${@:1}
do
	REP=$i
	rm -f ${REP}/*.pdf
done

