# version 1.02 date 01/03/2016 auteur(s) Michel Cressant, Pierre Porche

# Compilation
all: fc ff pf fr of tb
 
fc:
	make -C FC

ff:
	make -C FF

pf:
	make -C PF

fr:
	make -C FR

of:
	make -C OF

tb:
	make -C TB


# Archivage
archive: archivefc archiveff archivepf archivefr archiveof archivetb

archivefc:
	make -C FC archive

archiveff:
	make -C FF archive

archivepf:
	make -C PF archive

archivefr:
	make -C FR archive

archiveof:
	make -C OF archive

archivetb:
	make -C TB archive




# Nettoyage
clean : cleanfc cleanff cleanpf cleanfr cleanof cleantb

cleanfc:
	make -C FC clean

cleanff:
	make -C FF clean

cleanpf:
	make -C PF clean

cleanfr:
	make -C FR clean

cleanof:
	make -C OF clean

cleantb:
	make -C TB clean














