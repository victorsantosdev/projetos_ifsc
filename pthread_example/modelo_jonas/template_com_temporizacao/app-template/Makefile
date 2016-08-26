#
# File:		Makefile
# Author:	Jonas Murilo Antunes (jonasmuriloantunes@gmail.com)

PROJECT	= application

CFILES = $(wildcard ./*.c)

CDEFS = DEBUG

INCPATH	= include
LIBPATH = lib

DEPS = conf

LIBS = pthread $(DEPS) 

ELF = $(PROJECT)
LST = $(PROJECT).lst

SFLAGS  = -Wall
CFLAGS  = -O
LDFLAGS =

CC      = gcc
LD      = gcc
AR      = ar
OBJCOPY = objcopy
OBJDUMP = objdump
STRIP = strip

LIB_DIR = $(abspath lib)
INSTALL_DIR = /tftpboot
OFILES = $(CFILES:.c=.o)

CFLAGS := $(OPTIONS) $(CFLAGS) -Wall $(addprefix -D,$(CDEFS))

FLAGS_TO_PASS := $(FLAGS_TO_PASS)\
				 'CC=$(CC)'\
				 'LD=$(LD)'\
				 'AS=$(AS)'\
				 'AR=$(AR)'\
				 'OBJCOPY=$(OBJCOPY)'\
				 'OBJDUMP=$(OBJDUMP)'\
				 'STRIP=$(STRIP)'\
				 'CDEFS=$(CDEFS)'

build: deps app lst 

deps: 
	echo $(LIB_DIR)
	@for d in $(DEPS); do\
		if [ -f ./$$d/Makefile ]; then\
			(cd ./$$d && $(MAKE) $(FLAGS_TO_PASS) all) || exit 1;\
		fi;\
	done;\
	for d in $(DEPS); do\
		if [ -f ./$$d/Makefile ]; then\
			(cd ./$$d && $(MAKE) INSTALL_DIR=$(LIB_DIR) install)\
			|| exit 1;\
		fi;\
	done;

build-clean: 
	@rm -fv $(OFILES) 
	@rm -fv $(ELF) $(LST)

deps-clean:
	@for d in $(DEPS); do\
		if [ -f ./$$d/Makefile ]; then\
			(cd ./$$d && $(MAKE) $(FLAGS_TO_PASS) clean) || exit 1;\
		fi;\
	done

clean: build-clean deps-clean

app: $(ELF)

lst: $(LST)

clean:
	@rm -fv $(OFILES) $(PROJECT).lst $(PROJECT) $(PROJECT)

install: $(ELF)
	if [ ! -d $(INSTALL_DIR) ]; then\
		mkdir $(INSTALL_DIR) || exit 1;\
	fi;\
	cp $(ELF) $(INSTALL_DIR)

$(ELF): Makefile $(OFILES)
	$(LD) $(OPTIONS) $(LDFLAGS) $(addprefix -L,$(LIBPATH)) -o $@ $(OFILES) \
	$(addprefix -l,$(LIBS))

$(LST): $(ELF) Makefile
	$(OBJDUMP) -w -D -t -S -r -z $< | sed '/^[0-9,a-f]\{8\} .[ ]*d[f]\?.*$$/d' > $@

%.o : %.c Makefile
	$(CC) $(OPTIONS) $(CFLAGS) $(addprefix -I,$(INCPATH)) -o $@ -c $<

