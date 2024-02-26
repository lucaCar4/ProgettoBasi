-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 20 2021              
-- * Generation date: Sat Feb 10 02:29:22 2024 
-- * LUN file: /home/luca/UNI/anno_2/basi/progetto/Elaborato2.lun 
-- * Schema: Appartamenti/1-1-1-1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database Appartamenti;
use Appartamenti;


-- Tables Section
-- _____________ 

create table ADDETTI (
     Partita_Iva int not null,
     Nome char(10) not null,
     Cognome char(10) not null,
     constraint ID_ADDETTI_ID primary key (Partita_Iva));

create table APPARTAMENTI (
     tipo char(10) not null,
     id_appartamento char(1) not null,
     numero int not null,
     id_condominio int not null,
     constraint ID_APPARTAMENTI_ID primary key (id_appartamento));

create table BICICLETTE (
     prezzo float(6) not null,
     id_bicicletta char(50) not null,
     constraint ID_BICICLETTE_ID primary key (id_bicicletta));

create table CLIENTI (
     Codice_Documento bigint not null,
     Data_rilascio date not null,
     Da_chi char(30) not null,
     LuogoNascita char(30) not null,
     DataNascita date not null,
     Comune_residenza char(1) not null,
     Via char(1) not null,
     Numero_civico char(1) not null,
     constraint ID_CLIENTI_ID primary key (Codice_Documento));

create table CONDOMINI (
     id_condominio int not null,
     constraint ID_CONDOMINI_ID primary key (id_condominio));

create table FATTURE (
     Importo char(1) not null,
     Data date not null,
     Numero bigint not null,
     Codice_Documento bigint,
     Partita_Iva int,
     constraint ID_FATTURE_ID primary key (Numero));

create table formato (
     Codice_Documento bigint not null,
     id_famiglia bigint not null,
     ruolo char(10) not null,
     constraint ID_formato_ID primary key (Codice_Documento, id_famiglia));

create table GRUPPI (
     Cognome char(20) not null,
     id_famiglia bigint not null,
     constraint ID_GRUPPI_ID primary key (id_famiglia));

create table LISTINI (
     id_appartamento char(1) not null,
     Anno int not null,
     constraint ID_LISTINI_ID primary key (id_appartamento, Anno));

create table Noleggiare (
     id_bicicletta char(50) not null,
     numero bigint not null,
     constraint ID_Noleggiare_ID primary key (numero, id_bicicletta));

create table PERIODI (
     id_appartamento char(1) not null,
     Anno int not null,
     Prezzo float(15) not null,
     Data_fine date not null,
     Data_Inizio date not null,
     constraint ID_PERIODI_ID primary key (id_appartamento, Anno, Data_Inizio));

create table PRENOTAZIONI (
     sconto int,
     dataInizio date not null,
     dataFine date not null,
     Importo int not null,
     numero bigint not null,
     id_appartamento char(1) not null,
     Codice_Documento bigint,
     id_famiglia bigint,
     constraint ID_PRENOTAZIONI_ID primary key (numero));

create table PULIZIE (
     id_appartamento char(1) not null,
     Data date not null,
     Ora char(5) not null,
     Partita_Iva int not null,
     constraint ID_PULIZIE_ID primary key (id_appartamento, Data));


-- Constraints Section
-- ___________________ 

-- Not implemented
-- alter table APPARTAMENTI add constraint ID_APPARTAMENTI_CHK
--     check(exists(select * from LISTINI
--                  where LISTINI.id_appartamento = id_appartamento)); 

alter table APPARTAMENTI add constraint FKpossiede_FK
     foreign key (id_condominio)
     references CONDOMINI (id_condominio);

-- Not implemented
-- alter table CONDOMINI add constraint ID_CONDOMINI_CHK
--     check(exists(select * from APPARTAMENTI
--                  where APPARTAMENTI.id_condominio = id_condominio)); 

alter table FATTURE add constraint FKintestazione_cliente_FK
     foreign key (Codice_Documento)
     references CLIENTI (Codice_Documento);

alter table FATTURE add constraint FKintestazione_addetto_FK
     foreign key (Partita_Iva)
     references ADDETTI (Partita_Iva);

alter table formato add constraint FKfor_GRU_FK
     foreign key (id_famiglia)
     references GRUPPI (id_famiglia);

alter table formato add constraint FKfor_CLI
     foreign key (Codice_Documento)
     references CLIENTI (Codice_Documento);

-- Not implemented
-- alter table GRUPPI add constraint ID_GRUPPI_CHK
--     check(exists(select * from formato
--                  where formato.id_famiglia = id_famiglia)); 

-- Not implemented
-- alter table LISTINI add constraint ID_LISTINI_CHK
--     check(exists(select * from PERIODI
--                  where PERIODI.id_appartamento = id_appartamento and PERIODI.Anno = Anno)); 

alter table LISTINI add constraint FKha
     foreign key (id_appartamento)
     references APPARTAMENTI (id_appartamento);

alter table Noleggiare add constraint FKNol_PRE
     foreign key (numero)
     references PRENOTAZIONI (numero);

alter table Noleggiare add constraint FKNol_BIC_FK
     foreign key (id_bicicletta)
     references BICICLETTE (id_bicicletta);

alter table PERIODI add constraint FKcomposto
     foreign key (id_appartamento, Anno)
     references LISTINI (id_appartamento, Anno);

alter table PRENOTAZIONI add constraint FKriferire_FK
     foreign key (id_appartamento)
     references APPARTAMENTI (id_appartamento);

alter table PRENOTAZIONI add constraint FKeffettua_sing_FK
     foreign key (Codice_Documento)
     references CLIENTI (Codice_Documento);

alter table PRENOTAZIONI add constraint FKeffettua_gruppo_FK
     foreign key (id_famiglia)
     references GRUPPI (id_famiglia);

alter table PULIZIE add constraint FKpulito
     foreign key (id_appartamento)
     references APPARTAMENTI (id_appartamento);

alter table PULIZIE add constraint FKesegue_FK
     foreign key (Partita_Iva)
     references ADDETTI (Partita_Iva);


-- Index Section
-- _____________ 

create unique index ID_ADDETTI_IND
     on ADDETTI (Partita_Iva);

create unique index ID_APPARTAMENTI_IND
     on APPARTAMENTI (id_appartamento);

create index FKpossiede_IND
     on APPARTAMENTI (id_condominio);

create unique index ID_BICICLETTE_IND
     on BICICLETTE (id_bicicletta);

create unique index ID_CLIENTI_IND
     on CLIENTI (Codice_Documento);

create unique index ID_CONDOMINI_IND
     on CONDOMINI (id_condominio);

create unique index ID_FATTURE_IND
     on FATTURE (Numero);

create index FKintestazione_cliente_IND
     on FATTURE (Codice_Documento);

create index FKintestazione_addetto_IND
     on FATTURE (Partita_Iva);

create unique index ID_formato_IND
     on formato (Codice_Documento, id_famiglia);

create index FKfor_GRU_IND
     on formato (id_famiglia);

create unique index ID_GRUPPI_IND
     on GRUPPI (id_famiglia);

create unique index ID_LISTINI_IND
     on LISTINI (id_appartamento, Anno);

create unique index ID_Noleggiare_IND
     on Noleggiare (numero, id_bicicletta);

create index FKNol_BIC_IND
     on Noleggiare (id_bicicletta);

create unique index ID_PERIODI_IND
     on PERIODI (id_appartamento, Anno, Data_Inizio);

create unique index ID_PRENOTAZIONI_IND
     on PRENOTAZIONI (numero);

create index FKriferire_IND
     on PRENOTAZIONI (id_appartamento);

create index FKeffettua_sing_IND
     on PRENOTAZIONI (Codice_Documento);

create index FKeffettua_gruppo_IND
     on PRENOTAZIONI (id_famiglia);

create unique index ID_PULIZIE_IND
     on PULIZIE (id_appartamento, Data);

create index FKesegue_IND
     on PULIZIE (Partita_Iva);

