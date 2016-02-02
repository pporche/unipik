# Compilation
all: dse dsi

dse:
	make -C DSE

dsi:
	make -C DSI


# Archivage
archive: archivedse archivedsi

archivedse:
	make -C DSE archive

archivedsi:
	make -C DSI archive




# Nettoyage
clean : cleandse clean dsi

cleandse:
	make -C DSE clean

cleandsi:
	make -C DSI clean

