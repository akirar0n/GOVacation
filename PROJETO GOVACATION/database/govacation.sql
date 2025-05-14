drop database govacation;
create schema if not exists govacation default character set utf8;
use govacation;

create table if not exists usuario (
    idusuario int auto_increment not null,
    tipousuario int not null,
    cpf varchar(11) not null,
    nome varchar(70) not null,
    endereco varchar(100) not null,
    email varchar(100) not null,
    telefone varchar(11) not null,
	primary key (idusuario)
) engine = innodb; 

create table if not exists locacoes (
	idloc int auto_increment not null,
    tipoloc varchar(20) not null,
	titulo varchar(255) not null,
    descr varchar(255) not null,
	preco decimal(10,2) not null,
	localizacao int(11) not null,
    qtdhospedes int not null,
	disp varchar(15) not null,
    primary key (idloc)
) engine = innodb;

create table if not exists reservas (
	idreserva int auto_increment not null,
    idusuario int not null,
    idloc int not null,
    datacheckin date,
    datacheckout date,
    primary key (idreserva),
    foreign key (idusuario) references usuario(idusuario),
	foreign key (idloc) references locacoes(idloc)
) engine = innodb;

INSERT INTO usuario (tipousuario, cpf, nome, endereco, email, telefone) VALUES
(2, '12345678901', 'João Silva', 'Rua das Flores, 123 - São Paulo/SP', 'joao.silva@email.com', '11987654321'),
(2, '98765432109', 'Maria Oliveira', 'Av. Paulista, 1000 - São Paulo/SP', 'maria.oliveira@email.com', '11912345678'),
(2, '45678912345', 'Carlos Souza', 'Rua XV de Novembro, 50 - Curitiba/PR', 'carlos.souza@email.com', '41998765432'),
(2, '32165498701', 'Ana Pereira', 'Rua da Praia, 200 - Florianópolis/SC', 'ana.pereira@email.com', '48912345678'),
(2, '78912345678', 'Pedro Santos', 'Av. Brasil, 1500 - Rio de Janeiro/RJ', 'pedro.santos@email.com', '21987654321');

INSERT INTO locacoes (tipoloc, titulo, descr, preco, localizacao, qtdhospedes, disp) VALUES
('Casa', 'Casa na Praia com Vista para o Mar', 'Encantadora casa a 50m da praia, com 3 quartos, piscina e vista panorâmica', 350.00, 1, 6, 'Disponível'),
('Apartamento', 'Apto Luxo no Centro', 'Apartamento moderno no centro da cidade, com 2 quartos e vista para o parque', 250.00, 2, 4, 'Disponível'),
('Chalé', 'Chalé Aconchegante na Montanha', 'Chalé de madeira com lareira, ideal para casais, próximo a trilhas', 180.00, 3, 2, 'Ocupado'),
('Sítio', 'Sítio com Piscina e Lago', 'Propriedade rural com 5 quartos, área de lazer completa e natureza', 420.00, 4, 10, 'Disponível'),
('Loft', 'Loft Industrial no Bairro Artístico', 'Espaço aberto com decoração industrial, perfeito para quem busca inspiração', 200.00, 5, 2, 'Disponível');

INSERT INTO reservas (idusuario, idloc, datacheckin, datacheckout) VALUES
(1, 3, '2023-11-15', '2023-11-20'),
(2, 1, '2023-12-10', '2023-12-20'),
(3, 2, '2024-01-05', '2024-01-10'),
(4, 5, '2024-02-14', '2024-02-16'),
(5, 4, '2024-03-01', '2024-03-10');

-- Selecionar todos os usuários
SELECT * FROM usuario;

-- Selecionar todas as locações
SELECT * FROM locacoes;

-- Selecionar todas as reservas
SELECT * FROM reservas;