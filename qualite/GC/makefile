# Compilation
all: frd pgc

frd:
	make -C FRD

pgc:
	make -C PGC


# Archivage
archive: archivefrd archivepgc 

archivefrd:
	make -C FRD archive

archivepgc:
	make -C PGC archive


# Nettoyage
clean : cleanfrd cleanpgc 

cleanfrd:
	make -C FRD clean

cleanpgc:
	make -C PGC clean

