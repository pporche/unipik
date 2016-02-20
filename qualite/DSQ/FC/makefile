# version 1.00, date 20/02/16, auteur Michel Cressant
# Importation des variables
include makevars

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : fc cleanrep cleaneps

fc : $(PDFDIR)/FC_Q_Unipik_pFL_v1.00.pdf $(PDFDIR)/FC_Q_Unipik_pJP_v1.00.pdf $(PDFDIR)/FC_Q_Unipik_pKA_v1.00.pdf $(PDFDIR)/FC_Q_Unipik_pMB_v1.00.pdf $(PDFDIR)/FC_Q_Unipik_pMC_v1.00.pdf $(PDFDIR)/FC_Q_Unipik_pMMB_v1.00.pdf $(PDFDIR)/FC_Q_Unipik_pMM_v1.00.pdf $(PDFDIR)/FC_Q_Unipik_pPP_v1.00.pdf $(PDFDIR)/FC_Q_Unipik_pSC_v1.00.pdf 

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
	cp pdf/*.pdf ${ARCHIVEDIR}
