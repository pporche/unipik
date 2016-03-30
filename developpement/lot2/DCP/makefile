# version 1.00 date 29/03/2016 auteur(s) Michel Cressant

# Importation des variables
include makevars ../../../makevars ../../../gestionConfigurations
.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf


# Compilation

all:  dcp cleanrep

dcp : $(PDFDIR)/$(NOM_FICHIER).pdf 

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)




# Archivage
archive: archivedcp

archivedcp:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}


# Nettoyage
clean: cleanrep cleanpdf

cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0

cleanpdf:
	rm -f pdf/*.pdf





