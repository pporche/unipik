# version 1.00 date 20/02/2016 auteur(s) Michel Cressant

# Compilation
all: cr pv fs

cr:
	make -C CR

pv:
	make -C PV

fs:
	make -C FS

# Archivage
archive: archivecr archivepv archivefs

archivecr:
	make -C CR archive

archivepv:
	make -C PV archive

archivefs:
	make -C FS archive

# Nettoyage
clean: cleancr cleanpv

cleancr:
	make -C CR clean

cleanpv:
	make -C PV clean

cleanfs:
	make -C FS clean
