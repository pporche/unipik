# version 1.02, date 01/03/16, auteur Michel Cressant, Pierre Porche
# Compilation
all: fc ff pf fr
 
fc:
	make -C FC

ff:
	make -C FF

pf:
	make -C PF

fr:
	make -C FR

# Archivage
archive: archivefc archiveff archivepf archivefr

archivefc:
	make -C FC archive

archiveff:
	make -C FF archive

archivepf:
	make -C PF archive

archivefr:
	make -C FR archive




# Nettoyage
clean : cleanfc cleanff cleanpf cleanfr

cleanfc:
	make -C FC clean

cleanff:
	make -C FF clean

cleanpf:
	make -C PF clean

cleanfr:
	make -C FR clean
