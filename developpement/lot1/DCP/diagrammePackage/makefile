# version 1.02, date 19/04/16, auteur Pierre Porche
# version 1.01, date 26/02/16, auteur Michel CRESSANT, Pierre Porche
# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars



all :  diagPackage cleanrep cleaneps



diagPackage : 
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


