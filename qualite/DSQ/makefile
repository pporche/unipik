# version 1.01, date 26/02/16, auteur Michel Cressant, Pierre Porche
# Compilation
all: fc ff
 
fc:
	make -C FC

ff:
	make -C FF

# Archivage
archive: archivefc archiveff

archivefc:
	make -C FC archive

archiveff:
	make -C FF archive



# Nettoyage
clean : cleanfc cleanff

cleanfc:
	make -C FC clean

cleanff:
	make -C FF clean


