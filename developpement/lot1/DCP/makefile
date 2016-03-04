# version 1.02, date 04/03/16, auteur Pierre Porche et Sergi Colomiès
# Compilation
all: modeleea diagrammeclasse diagrammepackage diagrammesequence

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
clean: cleanmodeleea cleandiagrammeclasse cleandiagrammepackage cleandiagrammesequence

cleanmodeleea:
	make -C modeleEA clean

cleandiagrammeclasse:
	make -C diagrammeClasse clean

cleandiagrammepackage:
	make -C diagrammePackage clean

cleandiagrammesequence:
	make -C diagrammeSequence clean

