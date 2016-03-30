# version 1.00 date 30/03/2016 auteur(s) Michel Cressant

# Compilation
all: dti 

dti:
	make -C DTI

dtu:
	make -C DTU

# Archivage
archive: archivedti archivedtu

archivedti:
	make -C DTI archive

archivedtu:
	make -C DTU archive

# Nettoyage
clean: cleandti cleandtu

cleandti:
	make -C DTI clean

cleandtu:
	make -C DTU clean
