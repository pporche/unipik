# version 1.00 date 25/04/2016 auteur(s) Sergi Colomies

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars 



all : rbcp cleanrep cleaneps


rbcp : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) enregistrements debriefing_L_Unipik_d16-05-23_rCP poster_L_Unipik_d16-05-23 resumePic_L_Unipik_d16-05-23


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


