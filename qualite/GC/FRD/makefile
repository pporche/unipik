# Importation des variables
include makevars

#.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : frd cleanrep cleaneps

frd : $(PDFDIR)/FRD_Q_Unipik_d16-01-28.pdf $(PDFDIR)/FRD_Q_Unipik_d16-02-01.pdf

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
