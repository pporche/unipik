# version 1.00, date 24/02/16, auteur Pierre Porche et Sergi Colomiès
# Compilation
all: modeleea diagrammeclasse

modeleea:
	make -C modeleEA

diagrammeclasse:
	make -C diagrammeClasse



# Archivage
archive: archivemodeleea archivediagrammeclasse

archivemodeleea:
	make -C modeleEA archive

archivediagrammeclasse:
	make -C diagrammeClasse archive



# Nettoyage
clean: cleanmodeleea cleandiagrammeclasse

cleanmodeleea:
	make -C modeleEA clean

cleandiagrammeclasse:
	make -C diagrammeClasse clean

