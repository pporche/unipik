# version 1.00 date 30/03/2016 auteur(s) Michel Cressant

# Compilation
all: jti pti

jti:
	make -C JTI

pti:
	make -C PTI

# Archivage
archive: archivejti archivepti

archivejti:
	make -C JTI archive

archivepti:
	make -C PTI archive

# Nettoyage
clean: cleanjti cleanpti

cleanjti:
	make -C JTI clean

cleanpti:
	make -C PTI clean
