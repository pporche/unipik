# version 1.01 date 30/03/2016 auteur(s) Michel Cressant, Sergi Colomies

# Compilation
all: rfd rffps rfr

rfd:
	make -C RFD

rffps:
	make -C RFFPS

rfr:
	make -C RFR

# Archivage
archive: archiverfd archiverffps archiverfr

archiverfd:
	make -C RFD archive

archiverffps:
	make -C RFFPS archive

archiverfr:
	make -C RFR archive


# Nettoyage
clean: cleanrfd cleanrffps cleanrfr

cleanrfd:
	make -C RFD clean

cleanrffps:
	make -C RFFPS clean

cleanrfr:
	make -C RFR clean
