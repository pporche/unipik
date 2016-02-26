# version 1.01, date 26/02/16, auteur Michel Cressant, Pierre Porche
# Importation des variables
include makevars ../../../../makevars

#.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : crtp cleanrep cleaneps

crtp : $(PDFDIR)/CRTP_Q_Unipik_d16-01-22.pdf $(PDFDIR)/CRTP_Q_Unipik_d16-01-29.pdf $(PDFDIR)/CRTP_Q_Unipik_d16-02-05.pdf

$(PDFDIR)/%.pdf : enregistrements/%.tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv *.pdf $(PDFDIR)

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	rm -f pdf/*.pdf

# Nettoyage du répertoire
cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0

cleaneps :
	rm -f images/*.eps
	rm -f images/*.pdf
	rm -f annexe/pdf/*.pdf

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
