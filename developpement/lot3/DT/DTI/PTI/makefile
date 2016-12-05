# version 1.00 date 30/03/2016 auteur(s) Michel Cressant

# Importation des variables
include makevars $(UNIPIKGENPATH)/pic_unicef/makevars $(UNIPIKGENPATH)/pic_unicef/gestionConfigurations



all :  pti cleanrep

pti : 
	$(BASHMAKEPATH)/texToPdf.sh $(PDFDIR) $(CLSPATH) $(VOCPATH) . $(NOM_FICHIER)



# Archivage
archive:
	$(BASHMAKEPATH)/archivage.sh ${ARCHIVEDIR}

# Clean commands
clean : cleanpdf cleanrep

cleanpdf :
	$(BASHMAKEPATH)/cleanPdf.sh pdf images annexe/pdf


# Nettoyage du répertoire
cleanrep:
	$(BASHMAKEPATH)/cleanRep.sh



