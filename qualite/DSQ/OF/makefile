# version 1.01 date 18/04/2016 auteur(s) Pierre Porche
# version 1.00 date 01/03/2016 auteur(s) Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars $(UNIPIKGENPATH)/pic_unicef/gestionConfigurations


all : imagespdf of cleanrep cleaneps

imagespdf: 
	$(BASHMAKEPATH)/imagesPdf.sh $(IMGDIR) $(PDFDIR)/$(NOM_FICHIER).pdf organigrammeFonctionnel



of : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) . $(NOM_FICHIER)


# Archivage
archive:
	$(BASHMAKEPATH)/archivage.sh ${ARCHIVEDIR}

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	$(BASHMAKEPATH)/cleanPdf.sh pdf images annexe/pdf

# Nettoyage du répertoire
cleanrep:
	$(BASHMAKEPATH)/cleanRep.sh

cleaneps :
	$(BASHMAKEPATH)/cleanEps.sh


