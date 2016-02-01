# Importation des variables
include makevars

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : ec cleanrep cleaneps

ec : $(PDFDIR)/$(NOM_FICHIER).pdf

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	rm -f pdf/*.pdf
	rm -f images/*.pdf

# Nettoyage du répertoire
cleanrep:	
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof

cleaneps :
	rm -f images/*.eps

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
