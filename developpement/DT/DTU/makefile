# version 1.00 date 04/03/2016 auteur(s) Pierre Porche

# Compilation
all: jtu ptu 

jtu:
	make -C JTU

ptu:
	make -C PTU



# Archivage
archive: archivejtu archiveptu 

archivejtu:
	make -C JTU archive

archiveptu:
	make -C PTU archive





# Nettoyage
clean: cleanjtu cleanptu 

cleanjtu:
	make -C JTU clean

cleanptu:
	make -C PTU clean

