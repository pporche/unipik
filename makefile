# Compilation
all: qualite

qualite:
	make -C qualite


# Archivage
archive: archivequalite 

archivequalite:
	make -C qualite archive


# Nettoyage
clean : cleanqualite 

cleanqualite:
	make -C qualite clean

