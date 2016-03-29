# version 1.01 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.00 date 01/03/2016 auteur(s) Michel Cressant

# Importation des variables
include makevars ../../../../../makevars ../../../../../gestionConfigurations

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all :  ptu cleanrep

ptu : $(PDFDIR)/$(NOM_FICHIER).pdf 

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
