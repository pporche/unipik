# version 1.02 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.01 date 26/02/2016 auteur(s) Michel Cressant, Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars  $(UNIPIKGENPATH)/pic_unicef/gestionConfigurations


all : imagespng dse cleanrep cleaneps cleanpng

imagespng: 
	$(UML) $(IMGDIR)/modeleDUsage.uml

dse : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) . $(NOM_FICHIER)


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

cleanpng :
	$(BASHMAKEPATH)/cleanPng.sh


