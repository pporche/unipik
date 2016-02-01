# Compilation
all: cri crtp crtq

cri:
	make -C CRI

crtp:
	make -C CRTP

crtq:
	make -C CRTQ

# Archivage
archive: archivecri archivecrtp archivecrtq

archivecri:
	make -C CRI archive

archivecrtp:
	make -C CRTP archive

archivecrtq:
	make -C CRTQ archive

# Nettoyage
clean: cleancri cleancrtp cleancrtq

cleancri:
	make -C CRI clean

cleancrtp:
	make -C CRTP clean

cleancrtq:
	make -C CRTQ clean
