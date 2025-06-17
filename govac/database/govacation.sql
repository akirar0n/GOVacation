create schema if not exists govacation default character set utf8;
use govacation;

create table if not exists usuario (
    idusuario int auto_increment not null,
    tipousuario int not null,
    email varchar(100) not null,
    senha varchar(255) not null,
    nome varchar(70) not null,
    cpf varchar(13) not null,
    endereco varchar(100) not null,
    telefone varchar(11) not null,
	primary key (idusuario)
) engine = innodb; 

create table if not exists locacoes (
	idloc int auto_increment not null,
    tipoloc varchar(20) not null,
	titulo varchar(255) not null,
    imagem varchar(255) not null,
    descr varchar(255) not null,
	preco decimal(10,2) not null,
	localizacao varchar(100) not null,
    qtdhospedes int not null,
	disp varchar(15) not null,
    primary key (idloc)
) engine = innodb;

create table if not exists reservas (
	idreserva int auto_increment not null,
    idusuario int not null,
    idloc int not null,
    metodopag varchar(15),
    datacheckin date,
    datacheckout date,
    primary key (idreserva),
    foreign key (idusuario) references usuario(idusuario),
	foreign key (idloc) references locacoes(idloc)
) engine = innodb;

INSERT INTO usuario (tipousuario, email, senha, nome, cpf, endereco, telefone) VALUES
(1, 'adm1@gmail.com', 'adm1234',  'Administrador', '99988877766', 'Ceilandia/DF', '61999008877'),
(2, 'roney.santos@email.com', 'ronzin777', 'Roney Santos', '78912345678', 'Av. Brasil, 1500 - Rio de Janeiro/RJ', '21987654321');

INSERT INTO locacoes (tipoloc, titulo, imagem, descr, preco, localizacao, qtdhospedes, disp) VALUES
('Casa', 'Casa na Praia com Vista para o Mar', 'https://objectstorage.sa-saopaulo-1.oraclecloud.com/n/grq6lwb4htd1/b/tecimob-production/o/media/8f72eb8d-a912-4d7f-8729-65ca7be23356/properties/5b0dcb04-e1cd-4a3b-9da0-d0f13be6e85f/images/c360839b-090a-4b4d-8980-07872e96dfef1736741010YrqV.jpg', 'Encantadora casa a 50m da praia, com 3 quartos, piscina e vista panorâmica', 350.00, 'Rio de Janeiro - RJ', 6, 'Disponível'),
('Apartamento', 'Apto Luxo no Centro', 'https://monterre.com.br/app/uploads/2021/02/decorar-apartamento-de-luxo.jpg', 'Apartamento moderno no centro da cidade, com 2 quartos e vista para o parque', 250.00, 'Asa Sul - DF', 4, 'Disponível'),
('Chalé', 'Chalé Aconchegante na Montanha', 'https://minhacasaprefabricada.com.br/wp-content/uploads/2023/09/chales-de-madeiras-1024x576.jpg', 'Chalé de madeira com lareira, ideal para casais, próximo a trilhas', 180.00, 'Gramado - RS', 2, 'Disponível'),
('Sítio', 'Sítio com Piscina e Lago', 'https://blog.zanardiempreendimentos.com.br/content/images/2023/12/sitio_pequeno.jpg','Propriedade rural com 5 quartos, área de lazer completa e natureza', 420.00, 'Sobradinho - DF', 10, 'Disponível'),
('Loft', 'Loft Industrial no Bairro Artístico', 'https://www.casadevalentina.com.br/wp-content/uploads/2019/01/Adriana-Giacometti-Projetos-Casa-Decornautas-4.jpg.optimal.jpg', 'Espaço aberto com decoração industrial, perfeito para quem busca inspiração', 200.00, 'São Paulo - SP', 2, 'Disponível');