# version 1.03, date 19/04/16, auteur Pierre Porche
# version 1.02 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.01 date 04/03/2016 auteur(s) Mélissa Bignoux, Pierre Porche et Sergi Colomiès

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars  $(UNIPIKGENPATH)/pic_unicef/gestionConfigurations


all: dcp modeleea diagrammeclasse diagrammepackage diagrammesequence cleanrep


dcp : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) . $(NOM_FICHIER)

modeleea:
	make -C modeleEA

diagrammeclasse:
	make -C diagrammeClasse

diagrammepackage:
	make -C diagrammePackage

diagrammesequence:
	make -C diagrammeSequence



# Archivage
archive: archivedcp archivemodeleea archivediagrammeclasse archivediagrammepackage archivediagrammesequence 

archivedcp:
	$(BASHMAKEPATH)/archivage.sh ${ARCHIVEDIR}

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
	$(BASHMAKEPATH)/cleanPdf.sh pdf

cleanrep:
	$(BASHMAKEPATH)/cleanRep.sh



