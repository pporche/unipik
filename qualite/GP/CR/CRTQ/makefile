# version 1.01 date 26/02/2016 auteur(s) Michel Cressant, Pierre Porche

# Importation des variables
include makevars ../../../../makevars

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : crtq cleanrep cleaneps

crtq : $(PDFDIR)/CRTQ_Q_Unipik_d16-01-26.pdf $(PDFDIR)/CRTQ_Q_Unipik_d16-02-02.pdf $(PDFDIR)/CRTQ_Q_Unipik_d16-02-23.pdf $(PDFDIR)/CRTQ_Q_Unipik_d16-03-01.pdf $(PDFDIR)/CRTQ_Q_Unipik_d16-03-22.pdf

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
