# version 1.02 date 18/04/2016 auteur(s) Pierre Porche
# version 1.01 date 04/03/2016 auteur(s) Michel Cressant, Pierre Porche

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars 



all : cri cleanrep cleaneps


cri : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements CRI_Q_Unipik_d16-01-22 CRI_Q_Unipik_d16-01-29 CRI_Q_Unipik_d16-02-02 CRI_Q_Unipik_d16-02-23 CRI_Q_Unipik_d16-03-04 CRI_Q_Unipik_d16-03-10 CRI_Q_Unipik_d16-03-14 CRI_Q_Unipik_d16-03-22 CRI_Q_Unipik_d16-03-29 CRI_Q_Unipik_d16-04-19 CRI_Q_Unipik_d16-04-26 CRI_Q_Unipik_d16-05-03 CRI_Q_Unipik_d16-05-10 


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


