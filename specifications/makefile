# version 1.01 date 24/02/2016 auteur(s) Michel Cressant, Pierre Porche

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
clean : cleandse cleandsi cleanptv 

cleandse:
	make -C DSE clean

cleandsi:
	make -C DSI clean

cleanptv:
	make -C PTV clean















