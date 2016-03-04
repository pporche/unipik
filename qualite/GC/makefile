# version 1.01, date 24/02/16, auteur Michel Cressant, Pierre Porche
# Compilation
all: fedc pgc ec 

fedc:
	make -C FEDC

pgc:
	make -C PGC

ec:
	make -C EC


# Archivage
archive: archivefedc archivepgc archiveec

archivefedc:
	make -C FEDC archive

archivepgc:
	make -C PGC archive

archiveec:
	make -C EC archive

# Nettoyage
clean : cleanfedc cleanpgc cleanec

cleanfedc:
	make -C FEDC clean

cleanpgc:
	make -C PGC clean

cleanec:
	make -C EC clean
