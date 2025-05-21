create schema if not exists govacation default character set utf8;
use govacation;

create table if not exists usuario (
    idusuario int auto_increment not null,
    tipousuario int not null,
    email varchar(100) not null,
    senha varchar(255) not null,
    nome varchar(70) not null,
    cpf varchar(11) not null,
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
(2, 'joao.silva@email.com', '123456789', 'João Silva', '12345678901', 'Rua das Flores, 123 - São Paulo/SP', '11987654321'),
(2, 'maria.oliveira@email.com', '987654321', 'Maria Oliveira', '98765432109', 'Av. Paulista, 1000 - São Paulo/SP', '11912345678'),
(2, 'carlos.souza@email.com','vasco1234', 'Carlos Souza', '45678912345', 'Rua XV de Novembro, 50 - Curitiba/PR', '41998765432'),
(2, 'ana.pereira@email.com', 'aninha2005', 'Ana Pereira', '32165498701', 'Rua da Praia, 200 - Florianópolis/SC', '48912345678'),
(2, 'pedro.santos@email.com', 'pedrin777', 'Pedro Santos', '78912345678', 'Av. Brasil, 1500 - Rio de Janeiro/RJ', '21987654321');

INSERT INTO locacoes (tipoloc, titulo, imagem, descr, preco, localizacao, qtdhospedes, disp) VALUES
('Casa', 'Casa na Praia com Vista para o Mar', 'https://projetaronline.com/wp-content/uploads/2025/04/P467-FOTOS_Photo-1-1024x576.jpg', 'Encantadora casa a 50m da praia, com 3 quartos, piscina e vista panorâmica', 350.00, 'Rio de Janeiro - RJ', 6, 'Disponível'),
('Apartamento', 'Apto Luxo no Centro', 'https://projetaronline.com/wp-content/uploads/2025/04/P467-FOTOS_Photo-1-1024x576.jpg', 'Apartamento moderno no centro da cidade, com 2 quartos e vista para o parque', 250.00, 'Asa Sul - DF', 4, 'Disponível'),
('Chalé', 'Chalé Aconchegante na Montanha', 'https://projetaronline.com/wp-content/uploads/2025/04/P467-FOTOS_Photo-1-1024x576.jpg', 'Chalé de madeira com lareira, ideal para casais, próximo a trilhas', 180.00, 'Gramado - RS', 2, 'Ocupado'),
('Sítio', 'Sítio com Piscina e Lago', 'https://projetaronline.com/wp-content/uploads/2025/04/P467-FOTOS_Photo-1-1024x576.jpg','Propriedade rural com 5 quartos, área de lazer completa e natureza', 420.00, 'Sobradinho - DF', 10, 'Disponível'),
('Loft', 'Loft Industrial no Bairro Artístico', 'https://projetaronline.com/wp-content/uploads/2025/04/P467-FOTOS_Photo-1-1024x576.jpg', 'Espaço aberto com decoração industrial, perfeito para quem busca inspiração', 200.00, 'São Paulo - SP', 2, 'Disponível');

INSERT INTO reservas (idusuario, idloc, metodopag, datacheckin, datacheckout) VALUES
(1, 3, 'Pix','2023-11-15', '2023-11-20'),
(2, 1, 'Crédito','2023-12-10', '2023-12-20'),
(3, 2, 'Pix','2024-01-05', '2024-01-10'),
(4, 5, 'Débito','2024-02-14', '2024-02-16'),
(5, 4, 'Crédito','2024-03-01', '2024-03-10');

-- Selecionar todos os usuários
SELECT * FROM usuario;

-- Selecionar todas as locações
SELECT * FROM locacoes;

-- Selecionar todas as reservas
SELECT * FROM reservas;