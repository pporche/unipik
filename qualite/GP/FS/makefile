# version 1.00, date 04/03/16, auteur Sergi Colomiès
# Importation des variables
include makevars ../../../makevars

#.PHONY: $(PDFDIR)/$(NOM_FICHIER).pdf

all : fs cleanrep cleaneps

fs : $(PDFDIR)/FS_Q_Unipik_pSC.pdf $(PDFDIR)/FS_Q_Unipik_pMB.pdf $(PDFDIR)/FS_Q_Unipik_pJP.pdf $(PDFDIR)/FS_Q_Unipik_pMC.pdf $(PDFDIR)/FS_Q_Unipik_pMMB.pdf $(PDFDIR)/FS_Q_Unipik_pPP.pdf $(PDFDIR)/FS_Q_Unipik_pMM.pdf $(PDFDIR)/FS_Q_Unipik_pFL.pdf $(PDFDIR)/FS_Q_Unipik_pKA.pdf

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
