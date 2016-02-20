# version 1.00, date 20/02/16, auteur Michel Cressant
# Compilation
all: dse dsi ptv

dse:
	make -C DSE

dsi:
	make -C DSI

ptv:
	make -C PTV


# Archivage
archive: archivedse archivedsi archiveptv

archivedse:
	make -C DSE archive

archivedsi:
	make -C DSI archive

archiveptv:
	make -C PTV archive




# Nettoyage
clean : cleandse clean dsi

cleandse:
	make -C DSE clean

cleandsi:
	make -C DSI clean

cleanptv:
	make -C PTV clean

