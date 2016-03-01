# version 1.02, date 01/03/16, auteur Michel Cressant, Pierre Porche
# Compilation
all: fc ff pf
 
fc:
	make -C FC

ff:
	make -C FF

pf:
	make -C PF

# Archivage
archive: archivefc archiveff archivepf

archivefc:
	make -C FC archive

archiveff:
	make -C FF archive

archivepf:
	make -C PF archive



# Nettoyage
clean : cleanfc cleanff cleanpf

cleanfc:
	make -C FC clean

cleanff:
	make -C FF clean

cleanpf:
	make -C PF clean

