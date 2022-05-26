
CREATE TABLE TBcategoria (
	catcodigo SERIAL NOT NULL,
	catdescricao CHARACTER VARYING(100),
	CONSTRAINT pk_TBcategoria 
	PRIMARY KEY (catcodigo)

);

CREATE TABLE TBusuario (
	usulogin CHARACTER VARYING(50),
	ususenha CHARACTER VARYING(50),
	CONSTRAINT pk_TBusuario 
	PRIMARY KEY (usulogin)

);

	CREATE TABLE tbcarrinho (
	usulogin CHARACTER VARYING(50) NOT NULL,
	procodigo INTEGER NOT NULL,
	CONSTRAINT pk_tbcarrinho 
	PRIMARY KEY (usulogin), 
		
	CONSTRAINT "FK tbcarrinho -> tbusuario" 
	FOREIGN KEY (usulogin) 
	REFERENCES tbusuario (usulogin),
		
	CONSTRAINT "FK tbcarrinho -> tbproduto" 
	FOREIGN KEY (procodigo) 
	REFERENCES tbproduto (procodigo)
	)

CREATE TABLE TBproduto (
	procodigo SERIAL NOT NULL,
	pronome CHARACTER VARYING(100),
	prodescricao CHARACTER VARYING(300),
	propreco float4,
	catcodigo INTEGER,
	
	CONSTRAINT pk_TBproduto
	PRIMARY KEY (procodigo),
	
	CONSTRAINT "FK TBproduto -> TBcategoria"
	FOREIGN KEY (catcodigo)
	REFERENCES TBcategoria(catcodigo)
);
