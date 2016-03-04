# version 1.00, date 20/02/16, auteur Michel Cressant
# Compilation
all: cr pv

cr:
	make -C CR

pv:
	make -C PV

# Archivage
archive: archivecr archivepv

archivecr:
	make -C CR archive

archivepv:
	make -C PV archive

# Nettoyage
clean: cleancr cleanpv

cleancr:
	make -C CR clean

cleanpv:
	make -C PV clean
