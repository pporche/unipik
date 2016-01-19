FICHIERS_PDF=organigrame.pdf cycleFT.pdf ConduireLeProjet.pdf ProcessusFournisseur.pdf RealiserProduits.pdf organigrammeProcessusPic.pdf

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
