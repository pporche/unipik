# version 1.00 date 12/05/2016 auteur(s) Mathieu Medici
# version 1.00 date 04/05/2016 auteur(s) Pierre Porche

# Importation des variables
include makevars ../../../../makevars


# Compilation

all : imagespdf sp cleanrep cleaneps cleanpng


imagespdf : 
	$(BASHMAKEPATH)/imagesPdf.sh $(IMGDIR) $(PDFDIR)/$(NOM_FICHIER).pdf mvcVue mvcControleur mvcModele twig archiTemplates

imagespng : 
	$(BASHMAKEPATH)/imagesPng.sh $(IMGDIR) $(PDFDIR)/$(NOM_FICHIER).pdf 

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

