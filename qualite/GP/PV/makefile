# version 1.00 date 20/02/2016 auteur(s) Michel Cressant, Sergi Colomies

# Compilation
all: rfd rffps

rfd:
	make -C RFD

rffps:
	make -C RFFPS

# Archivage
archive: archiverfd archiverffps

archiverfd:
	make -C RFD archive

archiverffps:
	make -C RFFPS archive


# Nettoyage
clean: cleanrfd cleanrffps

cleanrfd:
	make -C RFD clean

cleanrffps:
	make -C RFFPS clean
