#version 1.01, date 19/04/16, auteur Pierre Porche
#version 1.00, date 04/03/16, auteur Pierre Porche
# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars



all :  diagClasse cleanrep cleaneps



diagClasse : 
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


