# version 1.00, date 29/02/16, auteur Michel Cressant
# Importation des variables
include makevars ../../../../makevars

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all :  pti cleanrep

pti : $(PDFDIR)/$(NOM_FICHIER).pdf 

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)


# Clean commands
clean : cleanpdf cleanrep 

cleanpdf :
	rm -f pdf/*.pdf

# Nettoyage du répertoire
cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0


# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
