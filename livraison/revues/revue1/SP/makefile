# version 1.01 date 04/03/2016 auteur(s) Matthieu Martins-Baltar, Mathieu Medici

# Importation des variables
include makevars ../../../../makevars


# Compilation

all : imagespdf imagespng sp cleanrep cleaneps cleanpng


imagespdf : 
	$(BASHMAKEPATH)/imagesPdf.sh $(IMGDIR) $(PDFDIR)/$(NOM_FICHIER).pdf cycleCorrectionFT planningProjet2 schemaArchitecture


imagespng : 
	$(BASHMAKEPATH)/imagesPng.sh $(IMGDIR) $(PDFDIR)/$(NOM_FICHIER).pdf organigrammeFonctionnel cycleCorrectionFT modeleSpirale risque

sp : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH):$(THEMEPATH) . $(NOM_FICHIER)


# Archivage
archive:
	$(BASHMAKEPATH)/archivage.sh ${ARCHIVEDIR}

# Clean commands
clean : cleanpdf cleanrep cleaneps cleanpng

cleanpdf :
	$(BASHMAKEPATH)/cleanPdf.sh pdf images annexe/pdf


# Nettoyage du répertoire
cleanrep:
	$(BASHMAKEPATH)/cleanRep.sh

cleaneps :
	$(BASHMAKEPATH)/cleanEps.sh

cleanpng:
	$(BASHMAKEPATH)/cleanPng.sh

