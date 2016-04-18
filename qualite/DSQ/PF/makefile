# version 1.02 date 18/04/2016 auteur(s) Pierre Porche
# version 1.01 date 18/03/2016 auteur(s) Mathieu Medici
# version 1.00 date 29/02/2016 auteur(s) Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars $(UNIPIKGENPATH)/pic_unicef/gestionConfigurations

all : pf cleanrep cleaneps

pf : 
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

