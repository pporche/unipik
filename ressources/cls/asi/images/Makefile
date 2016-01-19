FICHIERS_PDF=assurerActivitesProcessus.pdf auditsTechniquesEtInspections.pdf decompositionObjectifsAAtteindre.pdf mqAsi.pdf organigrammePic.pdf organigrammeUniteP3.pdf cycleDeveloppementLogiciel.pdf deroulementActivitePICASI.pdf smq.pdf

.SUFFIXES : .pdf .eps .tex .fig .dia

all: ${FICHIERS_PDF}

.eps.pdf:
	epstopdf $*.eps

.fig.pdf:
	fig2dev -L pdf $*.fig $*.pdf

.dia.eps:
	dia --export=$*.eps --filter=eps-builtin $*.dia

clean:
	rm -f ${FICHIERS_PDF}
