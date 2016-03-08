# version 1.00, date 04/03/16, auteur Pierre Porche
# Compilation
all: jti pti

jti:
	make -C JTI

pti:
	make -C PTI


# Archivage
archive: archivejti archivepti

archivedti:
	make -C JTI archive

archivepti:
	make -C PTI archive




# Nettoyage
clean: cleanjti cleanpti

cleanjti:
	make -C JTI clean

cleanpti:
	make -C PTI clean
