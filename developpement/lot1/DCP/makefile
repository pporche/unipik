# version 1.02 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.01 date 04/03/2016 auteur(s) Mélissa Bignoux, Pierre Porche et Sergi Colomiès

# Importation des variables
include makevars ../../../makevars ../../../gestionConfigurations
.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf


# Compilation

all: dcp modeleea diagrammeclasse diagrammepackage diagrammesequence cleanrep

dcp : $(PDFDIR)/$(NOM_FICHIER).pdf 

modeleea:
	make -C modeleEA

diagrammeclasse:
	make -C diagrammeClasse

diagrammepackage:
	make -C diagrammePackage

diagrammesequence:
	make -C diagrammeSequence


# LaTex to pdf
$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)


# Archivage
archive: archivedcp archivemodeleea archivediagrammeclasse archivediagrammepackage archivediagrammesequence 

archivedcp:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}

archivemodeleea:
	make -C modeleEA archive

archivediagrammeclasse:
	make -C diagrammeClasse archive

archivediagrammepackage:
	make -C diagrammePackage archive

archivediagrammesequence:
	make -C diagrammeSequence archive



# Clean commands

clean: cleandcp cleanmodeleea cleandiagrammeclasse cleandiagrammepackage cleandiagrammesequence

cleandcp: cleanpdf cleanrep

cleanmodeleea:
	make -C modeleEA clean

cleandiagrammeclasse:
	make -C diagrammeClasse clean

cleandiagrammepackage:
	make -C diagrammePackage clean

cleandiagrammesequence:
	make -C diagrammeSequence clean

cleanpdf:
	rm -f pdf/*.pdf

cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0



