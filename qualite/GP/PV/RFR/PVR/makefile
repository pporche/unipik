# version 1.01 date 18/04/2016 auteur(s) Pierre Porche
# version 1.00 date 30/03/2016 auteur(s) Sergi Colomies

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars



all : pvr cleanrep cleaneps

pvr : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements PVR_Q_Unipik_d16-10-17 PVR_Q_Unipik_d16-03-23 PVR_Q_Unipik_d16-12-07 PVR_Q_Unipik_d16-12-14


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

