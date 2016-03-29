# version 1.00 date 01/03/2016 auteur(s) Pierre Porche

# Importation des variables
include makevars ../../../makevars ../../../gestionConfigurations

all : imagespdf of cleanrep cleaneps

imagespdf:  $(IMGDIR)/organigrammeFonctionnel.pdf

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<

of : $(PDFDIR)/OF_Q_Unipik_$(VERSIONOF).pdf

$(PDFDIR)/%.pdf : ./%.tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv *.pdf $(PDFDIR)

# Clean commands
clean : cleanpdf cleanrep cleaneps

cleanpdf :
	rm -f pdf/*.pdf

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
