# version 1.02 date 18/04/2016 auteur(s) Pierre Porche
# version 1.01 date 26/02/2016 auteur(s) Michel Cressant, Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars 



all : crtp cleanrep cleaneps


crtp : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements CRTP_Q_Unipik_d16-01-22 CRTP_Q_Unipik_d16-01-29 CRTP_Q_Unipik_d16-02-05 CRTP_Q_Unipik_d16-02-26 CRTP_Q_Unipik_d16-03-04 CRTP_Q_Unipik_d16-03-18 CRTP_Q_Unipik_d16-03-25 CRTP_Q_Unipik_d16-04-01 CRTP_Q_Unipik_d16-04-22 CRTP_Q_Unipik_d16-04-29 CRTP_Q_Unipik_d16-05-13 CRTP_Q_Unipik_d16-09-12 CRTP_Q_Unipik_d16-09-19 CRTP_Q_Unipik_d16-09-26 CRTP_Q_Unipik_d16-10-03 CRTP_Q_Unipik_d16-10-10


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


