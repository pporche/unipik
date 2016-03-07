# version 1.00, date 01/03/16, auteur Pierre Porche
# Importation des variables
include makevars ../../../makevars

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : fr cleanrep cleaneps

fr : $(PDFDIR)/FR_Q_Unipik_rCPA_v1.00.pdf $(PDFDIR)/FR_Q_Unipik_rCP_v1.00.pdf $(PDFDIR)/FR_Q_Unipik_rRD_v1.00.pdf $(PDFDIR)/FR_Q_Unipik_rRGC_v1.00.pdf $(PDFDIR)/FR_Q_Unipik_rRQA_v1.00.pdf $(PDFDIR)/FR_Q_Unipik_rRQ_v1.00.pdf $(PDFDIR)/FR_Q_Unipik_rRRS_v1.00.pdf 

$(PDFDIR)/%.pdf : enregistrements/%.tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv *.pdf $(PDFDIR)



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
	/cp pdf/*.pdf ${ARCHIVEDIR}
