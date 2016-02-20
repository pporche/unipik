# version 1.00, date 20/02/16, auteur Michel Cressant
# Compilation
all: cri crtp crtq crc

cri:
	make -C CRI

crtp:
	make -C CRTP

crtq:
	make -C CRTQ

crc:
	make -C CRC

# Archivage
archive: archivecri archivecrtp archivecrtq archivecrc

archivecri:
	make -C CRI archive

archivecrtp:
	make -C CRTP archive

archivecrtq:
	make -C CRTQ archive

archivecrc:
	make -C CRC archive

# Nettoyage
clean: cleancri cleancrtp cleancrtq cleancrc

cleancri:
	make -C CRI clean

cleancrtp:
	make -C CRTP clean

cleancrtq:
	make -C CRTQ clean

cleancrc:
	make -C CRC clean
