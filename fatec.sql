--
-- PostgreSQL database dump
--

-- Dumped from database version 16.2
-- Dumped by pg_dump version 16.2

-- Started on 2024-05-24 16:09:02

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 218 (class 1259 OID 16409)
-- Name: financeiro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.financeiro (
    id integer NOT NULL,
    data_abertura timestamp without time zone NOT NULL,
    data_fechamento timestamp without time zone,
    responsavel character varying(255) NOT NULL,
    saldo_abertura numeric(10,2) NOT NULL,
    entradas numeric(10,2) NOT NULL,
    saidas numeric(10,2) NOT NULL,
    saldo_fechamento numeric(10,2)
);


ALTER TABLE public.financeiro OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16408)
-- Name: financeiro_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.financeiro_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.financeiro_id_seq OWNER TO postgres;

--
-- TOC entry 4873 (class 0 OID 0)
-- Dependencies: 217
-- Name: financeiro_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.financeiro_id_seq OWNED BY public.financeiro.id;


--
-- TOC entry 220 (class 1259 OID 16441)
-- Name: produto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produto (
    id integer NOT NULL,
    nome character varying(100) NOT NULL,
    descricao text,
    preco numeric(10,2) NOT NULL,
    estoque integer NOT NULL,
    fornecedor character varying(100)
);


ALTER TABLE public.produto OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16440)
-- Name: produto_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.produto_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.produto_id_seq OWNER TO postgres;

--
-- TOC entry 4874 (class 0 OID 0)
-- Dependencies: 219
-- Name: produto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.produto_id_seq OWNED BY public.produto.id;


--
-- TOC entry 216 (class 1259 OID 16399)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    usucodigo integer NOT NULL,
    usumail character varying(100) NOT NULL,
    ususenha character varying(100) NOT NULL,
    usunome character varying(200) NOT NULL,
    usustatus character(1) NOT NULL,
    tipo_usuario character varying(255)
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 16398)
-- Name: usuario_usucodigo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_usucodigo_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuario_usucodigo_seq OWNER TO postgres;

--
-- TOC entry 4875 (class 0 OID 0)
-- Dependencies: 215
-- Name: usuario_usucodigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_usucodigo_seq OWNED BY public.usuario.usucodigo;


--
-- TOC entry 222 (class 1259 OID 16450)
-- Name: vendas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vendas (
    id integer NOT NULL,
    produto_id integer NOT NULL,
    quantidade integer NOT NULL,
    cliente character varying(100) NOT NULL,
    data_venda timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.vendas OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 16449)
-- Name: vendas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vendas_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.vendas_id_seq OWNER TO postgres;

--
-- TOC entry 4876 (class 0 OID 0)
-- Dependencies: 221
-- Name: vendas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vendas_id_seq OWNED BY public.vendas.id;


--
-- TOC entry 4704 (class 2604 OID 16412)
-- Name: financeiro id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.financeiro ALTER COLUMN id SET DEFAULT nextval('public.financeiro_id_seq'::regclass);


--
-- TOC entry 4705 (class 2604 OID 16444)
-- Name: produto id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produto ALTER COLUMN id SET DEFAULT nextval('public.produto_id_seq'::regclass);


--
-- TOC entry 4703 (class 2604 OID 16402)
-- Name: usuario usucodigo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario ALTER COLUMN usucodigo SET DEFAULT nextval('public.usuario_usucodigo_seq'::regclass);


--
-- TOC entry 4706 (class 2604 OID 16453)
-- Name: vendas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas ALTER COLUMN id SET DEFAULT nextval('public.vendas_id_seq'::regclass);


--
-- TOC entry 4863 (class 0 OID 16409)
-- Dependencies: 218
-- Data for Name: financeiro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.financeiro (id, data_abertura, data_fechamento, responsavel, saldo_abertura, entradas, saidas, saldo_fechamento) FROM stdin;
\.


--
-- TOC entry 4865 (class 0 OID 16441)
-- Dependencies: 220
-- Data for Name: produto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.produto (id, nome, descricao, preco, estoque, fornecedor) FROM stdin;
1	davi	burro\r\nmacaco\r\npeida mt	2.50	2	MAE
2	SUCO DE SACO	SAIU DO MEU SACO	10.00	5	EU MSM
\.


--
-- TOC entry 4861 (class 0 OID 16399)
-- Dependencies: 216
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario (usucodigo, usumail, ususenha, usunome, usustatus, tipo_usuario) FROM stdin;
6	teste@gmail	MTIzOjpQb3J0YWxa	teste	A	adm
7	joao@gmail	MTIzOjpQb3J0YWxa	Joao	A	usuario
\.


--
-- TOC entry 4867 (class 0 OID 16450)
-- Dependencies: 222
-- Data for Name: vendas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vendas (id, produto_id, quantidade, cliente, data_venda) FROM stdin;
\.


--
-- TOC entry 4877 (class 0 OID 0)
-- Dependencies: 217
-- Name: financeiro_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.financeiro_id_seq', 6, true);


--
-- TOC entry 4878 (class 0 OID 0)
-- Dependencies: 219
-- Name: produto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produto_id_seq', 2, true);


--
-- TOC entry 4879 (class 0 OID 0)
-- Dependencies: 215
-- Name: usuario_usucodigo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_usucodigo_seq', 7, true);


--
-- TOC entry 4880 (class 0 OID 0)
-- Dependencies: 221
-- Name: vendas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vendas_id_seq', 10, true);


--
-- TOC entry 4711 (class 2606 OID 16414)
-- Name: financeiro financeiro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.financeiro
    ADD CONSTRAINT financeiro_pkey PRIMARY KEY (id);


--
-- TOC entry 4713 (class 2606 OID 16448)
-- Name: produto produto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produto
    ADD CONSTRAINT produto_pkey PRIMARY KEY (id);


--
-- TOC entry 4709 (class 2606 OID 16404)
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (usucodigo);


--
-- TOC entry 4715 (class 2606 OID 16456)
-- Name: vendas vendas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas
    ADD CONSTRAINT vendas_pkey PRIMARY KEY (id);


--
-- TOC entry 4716 (class 2606 OID 16457)
-- Name: vendas vendas_produto_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas
    ADD CONSTRAINT vendas_produto_id_fkey FOREIGN KEY (produto_id) REFERENCES public.produto(id);


-- Completed on 2024-05-24 16:09:02

--
-- PostgreSQL database dump complete
--

