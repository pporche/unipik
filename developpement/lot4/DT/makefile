# version 1.00, date 08/12/16, auteur Pierre Porche

# Compilation
all: dti dtu

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
