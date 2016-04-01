#!/bin/bash
# Cleanpdf script


for i in ${@:1}
do
	REP=$i
	rm -f ${REP}/*.pdf
done

