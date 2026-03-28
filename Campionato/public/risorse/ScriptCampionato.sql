create table if not exists caseAutomobilistiche(
	nome varchar(30) primary key,
	livrea varchar(10)
)

create table if not exists piloti(
	CF char(16) primary key unique,
	nome varchar(20),
	cognome varchar(20),
	nazionalità varchar(20),
	numero int,
	nomeCasa varchar(30),
	foreign key(nomeCasa) references caseAutomobilistiche (nome)
)

create table if not exists gare(
	data date,
	nomeCampionato varchar(40),
	primary key(data,nomeCampionato),
	foreign key (nomeCampionato) references campionati(nome)
	
)

create table if not exists campionati(
	nome varchar(40) primary key
)

create table if not exists partecipazione(
	dataGara date,
	campionatoGara varchar(40),
	cfPilota char(16),
	punti int,
	tempo time,
	primary key(dataGara,campionatoGara, cfPilota),
	foreign key (dataGara, campionatoGara) references gare(data,nomeCampionato),
	foreign key (cfPilota)references piloti (CF)
)