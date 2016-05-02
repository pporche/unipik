# version 1.00 date 01/05/2016 auteur(s) Sergi Colomies

# Compilation
all: rbcp rbrq

rbcp:
	make -C RBCP

rbrq:
	make -C RBRQ


# Archivage
archive: archiverbcp archiverbrq

archiverbcp:
	make -C RBCP archive

archiverbrq:
	make -C RBRQ archive


# Nettoyage
clean: cleanrbcp cleanrbrq

cleanrbcp:
	make -C RBCP clean

cleanrbrq:
	make -C RBRQ clean
