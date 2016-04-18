# version 1.02 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.01 date 04/03/2016 auteur(s) Michel Cressant, Pierre Porche, Mathieu Medici

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars  $(UNIPIKGENPATH)/pic_unicef/gestionConfigurations


all : imagespdf dsi cleanrep cleaneps


imagespdf: 
	$(BASHMAKEPATH)/imagesPdf.sh $(IMGDIR) $(PDFDIR)/$(NOM_FICHIER).pdf schemaArchitecture


dsi : 
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




