# version 1.02 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.01 date 04/03/2016 auteur(s) Mélissa Bignoux, Pierre Porche et Sergi Colomiès

# Importation des variables
include makevars ../../../makevars ../../../gestionConfigurations
.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf


# Compilation

all: modeleea diagrammeclasse diagrammepackage diagrammesequence dcp cleanrep

dcp : $(PDFDIR)/$(NOM_FICHIER).pdf 

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

modeleea:
	make -C modeleEA

diagrammeclasse:
	make -C diagrammeClasse

diagrammepackage:
	make -C diagrammePackage

diagrammesequence:
	make -C diagrammeSequence



# Archivage
archive: archivemodeleea archivediagrammeclasse archivediagrammepackage archivediagrammesequence

archivemodeleea:
	make -C modeleEA archive

archivediagrammeclasse:
	make -C diagrammeClasse archive

archivediagrammepackage:
	make -C diagrammePackage archive

archivediagrammesequence:
	make -C diagrammeSequence archive


# Nettoyage
clean: cleanrep cleanmodeleea cleandiagrammeclasse cleandiagrammepackage cleandiagrammesequence

cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0

cleanmodeleea:
	make -C modeleEA clean

cleandiagrammeclasse:
	make -C diagrammeClasse clean

cleandiagrammepackage:
	make -C diagrammePackage clean

cleandiagrammesequence:
	make -C diagrammeSequence clean

