# version 1.00, date 20/02/16, auteur Michel Cressant
# Compilation
all: pro pq gp dsq gc

pro:
	make -C PRO

pq:
	make -C PQ

gp:
	make -C GP

dsq:
	make -C DSQ

gc:
	make -C GC



# Archivage
archive: archivepq archivepro archivegp archivedsq archivegc

archivepq:
	make -C PQ archive

archivepro:
	make -C PRO archive

archivegp:
	make -C GP archive

archivedsq:
	make -C DSQ archive

archivegc:
	make -C GC archive


# Nettoyage
clean: cleanpq cleanpro cleangp cleandsq cleangc

cleanpq:
	make -C PQ clean

cleanpro:
	make -C PRO clean

cleangp: 
	make -C GP clean

cleandsq:
	make -C DSQ clean

cleangc:
	make -C GC clean
