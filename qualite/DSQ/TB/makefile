# version 1.00, date 29/02/16, auteur Pierre Porche
# Importation des variables
include makevars ../../../makevars

#.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : tb cleanrep cleaneps

tb : $(PDFDIR)/TB_Q_Unipik_s01.pdf $(PDFDIR)/TB_Q_Unipik_s02.pdf $(PDFDIR)/TB_Q_Unipik_s03.pdf $(PDFDIR)/TB_Q_Unipik_s04.pdf $(PDFDIR)/TB_Q_Unipik_s05.pdf

$(PDFDIR)/%.pdf : enregistrements/%.tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv *.pdf $(PDFDIR)


imagespdf:

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	rm -f pdf/*.pdf
	rm -f images/*.pdf
	rm -f annexe/pdf/*.pdf

# Nettoyage du répertoire
cleanrep:
	rm -f *.aux *.cb *.cb2 *.log *.toc *.out *.lot *.lof *.maf *.mtc *.mtc0

cleaneps :
	rm -f images/*.eps

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}
