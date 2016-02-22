# version 1.00, date 20/02/16, auteur Michel Cressant
# Importation des variables
include makevars

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : ptv cleanrep 

ptv : $(PDFDIR)/$(NOM_FICHIER).pdf 

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

# I have no idea what this thing is doing


# Clean commands
clean : cleanpdf cleanrep 

cleanpdf :
	rm -f pdf/*.pdf

# Nettoyage du répertoire
cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0



# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
