# version 1.02 date 18/04/2016 auteur(s) Pierre Porche
# version 1.01 date 26/02/2016 auteur(s) Michel Cressant, Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars 



all : crtq cleanrep cleaneps


crtq : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements CRTQ_Q_Unipik_d16-01-26 CRTQ_Q_Unipik_d16-02-02 CRTQ_Q_Unipik_d16-02-23 CRTQ_Q_Unipik_d16-03-01 CRTQ_Q_Unipik_d16-03-22 CRTQ_Q_Unipik_d16-03-29 CRTQ_Q_Unipik_d16-04-19 CRTQ_Q_Unipik_d16-04-26 CRTQ_Q_Unipik_d16-05-10 CRTQ_Q_Unipik_d16-09-14 CRTQ_Q_Unipik_d16-09-28 CRTQ_Q_Unipik_d16-10-12 CRTQ_Q_Unipik_d16-11-23 CRTQ_Q_Unipik_d16-12-07


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


