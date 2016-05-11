# version 1.01 date 18/04/2016 auteur(s) Pierre Porche
# version 1.00 date 30/03/2016 auteur(s) Sergi Colomies

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars



all : pvptv cleanrep cleaneps

pvptv : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements PVPTV_Q_Unipik_d16-03-07 PVPTV_Q_Unipik_d16-05-11


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


