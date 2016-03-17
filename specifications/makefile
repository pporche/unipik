# version 1.01, date 24/02/16, auteur Michel Cressant, Pierre Porche
# Compilation
all: dse dsi ptv cdr

dse:
	make -C DSE

dsi:
	make -C DSI

ptv:
	make -C PTV

cdr:
	make -C CDR



# Archivage
archive: archivedse archivedsi archiveptv archivecdr

archivedse:
	make -C DSE archive

archivedsi:
	make -C DSI archive

archiveptv:
	make -C PTV archive

archivecdr:
	make -C CDR archive





# Nettoyage
clean : cleandse cleandsi cleanptv cleancdr

cleandse:
	make -C DSE clean

cleandsi:
	make -C DSI clean

cleanptv:
	make -C PTV clean

cleancdr:
	make -C CDR clean















