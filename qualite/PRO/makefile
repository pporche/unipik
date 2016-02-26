# version 1.01, date 26/02/16, auteur Michel Cressant, Pierre Porche
# Importation des variables
include makevars ../../makevars

.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : imagespdf pro cleanrep cleaneps

pro : $(PDFDIR)/$(NOM_FICHIER).pdf

$(PDFDIR)/$(NOM_FICHIER).pdf : $(NOM_FICHIER).tex
	TEXINPUTS=${TEXINPUTS}:$(CLSPATH):$(VOCPATH);\
	export TEXINPUTS;\
	$(CCTEX) $<
	mv $(NOM_FICHIER).pdf $(PDFDIR)

imagespdf: $(IMGDIR)/AnalyseOpportunite_nPourquoi_FDO001.pdf $(IMGDIR)/AnalyseOpportunite_nPourquoi_FDO002.pdf $(IMGDIR)/AnalyseOpportunite_nPourquoi_FDO003.pdf $(IMGDIR)/AnalyseOpportunite_nPourquoi_FDO004.pdf $(IMGDIR)/AnalyseOpportunite_nPourquoi_FDO005.pdf $(IMGDIR)/AnalyseOpportunite_nPourquoi_FDO006.pdf $(IMGDIR)/AnalyseOpportunite_nPourquoi_FDO007.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR001.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR002.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR003.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR004.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR005.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR006.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR007.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR008.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR009.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR010.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR011.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR012.pdf $(IMGDIR)/AnalyseRisque_nPourquoi_FDR013.pdf

$(IMGDIR)/%.pdf : $(IMGDIR)/%.eps
	$(EPSPDF) -dEPSCrop $< $@

$(IMGDIR)/%.eps: $(IMGDIR)/%.dia
	$(DIA) -e $@ --filter=eps-builtin $<

# Archivage
archive:
	mkdir -p ${ARCHIVEDIR}
	cp pdf/*.pdf ${ARCHIVEDIR}

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


