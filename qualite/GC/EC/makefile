# version 1.03 date 18/04/2016 auteur(s) Pierre Porche
# version 1.02 date 26/02/2016 auteur(s) Michel Cressant, Pierre Porche, Mathieu Medici

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars



all : ec cleanrep 

ec : 

	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements EC_Q_Unipik_d16-05-10_cInspection EC_Q_Unipik_d16-10-17_cLivraison EC_Q_Unipik_d16-11-14_cInspectionPairs EC_Q_Unipik_d16-12-07_cLivraison EC_Q_Unipik_d16-12-07_cInspection


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


