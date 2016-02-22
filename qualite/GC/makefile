# version 1.00, date 20/02/16, auteur Michel Cressant
# Compilation
all: frd pgc

frd:
	make -C FEDC

pgc:
	make -C PGC


# Archivage
archive: archivefrd archivepgc 

archivefrd:
	make -C FEDC archive

archivepgc:
	make -C PGC archive


# Nettoyage
clean : cleanfrd cleanpgc 

cleanfrd:
	make -C FEDC clean

cleanpgc:
	make -C PGC clean

