# version 1.00, date 20/02/16, auteur Michel Cressant
# Compilation
all: dse dsi ptv modeleea

dse:
	make -C DSE

dsi:
	make -C DSI

ptv:
	make -C PTV

modeleea:
	make -C ModeleEA


# Archivage
archive: archivedse archivedsi archiveptv archivemodeleea

archivedse:
	make -C DSE archive

archivedsi:
	make -C DSI archive

archiveptv:
	make -C PTV archive

archivemodeleea:
	make -C ModeleEA archive




# Nettoyage
clean : cleandse cleandsi cleanptv cleanmodeleea

cleandse:
	make -C DSE clean

cleandsi:
	make -C DSI clean

cleanptv:
	make -C PTV clean

cleanmodeleea:
	make -C ModeleEA clean
