--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.4
-- Dumped by pg_dump version 9.6.4

-- Started on 2018-01-30 20:34:59

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12387)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2279 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 185 (class 1259 OID 17347)
-- Name: cargo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE cargo (
    codtipcargo integer NOT NULL,
    nombre character varying(20)
);


ALTER TABLE cargo OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 17350)
-- Name: ciudad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE ciudad (
    codciudad integer NOT NULL,
    codestado integer,
    nombre character varying(40),
    capital boolean
);


ALTER TABLE ciudad OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 17353)
-- Name: empresa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE empresa (
    cod_rif character varying(15) NOT NULL,
    rnc character varying(16) NOT NULL,
    nombre character varying(30) NOT NULL,
    codcedula character varying(12) NOT NULL,
    correo character varying(30) NOT NULL,
    telefono character varying(15) NOT NULL,
    telefono2 character varying(15) NOT NULL,
    codregion integer,
    codestado integer NOT NULL,
    codmunicipio integer NOT NULL,
    codparroquia integer NOT NULL,
    codciudad integer NOT NULL,
    dirrecion character varying NOT NULL,
    fecha_ing timestamp(6) without time zone DEFAULT now() NOT NULL,
    soli boolean,
    aprob boolean,
    confirm boolean,
    visto boolean NOT NULL
);


ALTER TABLE empresa OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 17360)
-- Name: estado; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE estado (
    codestado integer NOT NULL,
    nombre character varying(30),
    "iso_3166-2" character varying(5),
    codregion integer
);


ALTER TABLE estado OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 17363)
-- Name: tipo_estatus; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipo_estatus (
    cod_tipo_estatus integer NOT NULL,
    descripcion character varying(100) NOT NULL,
    siglas character varying(7) NOT NULL,
    cod_rol character varying,
    seleccion boolean,
    nombre_seleccion character varying
);


ALTER TABLE tipo_estatus OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 17369)
-- Name: estado_ped_cod_estado_ped_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE estado_ped_cod_estado_ped_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE estado_ped_cod_estado_ped_seq OWNER TO postgres;

--
-- TOC entry 2280 (class 0 OID 0)
-- Dependencies: 190
-- Name: estado_ped_cod_estado_ped_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE estado_ped_cod_estado_ped_seq OWNED BY tipo_estatus.cod_tipo_estatus;


--
-- TOC entry 191 (class 1259 OID 17371)
-- Name: estatus; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE estatus (
    id integer NOT NULL,
    cod_estatus character varying(30),
    cod_pedido character varying(30) NOT NULL,
    cod_tipo_estatus integer NOT NULL,
    cod_usuario character varying NOT NULL,
    observaciones character varying(500),
    fecha_estatus timestamp without time zone DEFAULT now()
);


ALTER TABLE estatus OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 17378)
-- Name: municipio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE municipio (
    codmunicipio integer NOT NULL,
    codestado integer,
    nombre character varying(40)
);


ALTER TABLE municipio OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 17381)
-- Name: parroquia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE parroquia (
    codparroquia integer NOT NULL,
    codmunicipio integer,
    nombre character varying(40)
);


ALTER TABLE parroquia OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 17384)
-- Name: pedido; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pedido (
    codpedido character varying NOT NULL,
    descripcion json NOT NULL,
    fecha_registro timestamp without time zone DEFAULT now() NOT NULL,
    visto_produccion boolean DEFAULT false NOT NULL,
    fecha_produccion timestamp without time zone,
    cod_usuario_produccion character varying,
    visto_compras boolean DEFAULT false NOT NULL,
    fecha_compras time without time zone,
    cod_usuario_compras character varying,
    cod_usuario_registro character varying,
    estatus_actual integer
);


ALTER TABLE pedido OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 17393)
-- Name: pedido_estatus_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pedido_estatus_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE pedido_estatus_id_seq OWNER TO postgres;

--
-- TOC entry 2281 (class 0 OID 0)
-- Dependencies: 195
-- Name: pedido_estatus_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE pedido_estatus_id_seq OWNED BY estatus.id;


--
-- TOC entry 196 (class 1259 OID 17395)
-- Name: region; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE region (
    cod_region integer NOT NULL,
    nombre character varying(20)
);


ALTER TABLE region OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 17398)
-- Name: repre_legal; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE repre_legal (
    cedula character varying(11) NOT NULL,
    nombre character varying(30),
    apellido character varying(30),
    cod_tipcargo integer,
    tlfcelular character varying(15),
    correo_repre character varying(75)
);


ALTER TABLE repre_legal OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 17401)
-- Name: rol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE rol (
    id integer NOT NULL,
    cod_rol character varying NOT NULL,
    descripcion character varying NOT NULL
);


ALTER TABLE rol OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 17407)
-- Name: rubro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE rubro (
    cod_rubro integer NOT NULL,
    cod_tipo integer NOT NULL,
    nombre character varying(20) NOT NULL
);


ALTER TABLE rubro OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 17410)
-- Name: rubro_empresa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE rubro_empresa (
);


ALTER TABLE rubro_empresa OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 17413)
-- Name: tipo_rubro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE tipo_rubro (
    cod_tipo integer NOT NULL,
    nombre character varying(30)
);


ALTER TABLE tipo_rubro OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 17554)
-- Name: unidad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE unidad (
    id integer NOT NULL,
    codusuario character varying(255) NOT NULL,
    tipo_unidad character varying(255) NOT NULL,
    rif character varying(255) NOT NULL,
    codestado integer NOT NULL,
    codmunicipio integer NOT NULL,
    codparroquia integer NOT NULL,
    codciudad integer NOT NULL,
    avenida character varying(255) NOT NULL,
    casa character varying(255) NOT NULL,
    sector character varying(255) NOT NULL,
    updated_at time without time zone NOT NULL,
    created_at time without time zone NOT NULL
);


ALTER TABLE unidad OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 17552)
-- Name: unidad_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE unidad_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE unidad_id_seq OWNER TO postgres;

--
-- TOC entry 2282 (class 0 OID 0)
-- Dependencies: 205
-- Name: unidad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE unidad_id_seq OWNED BY unidad.id;


--
-- TOC entry 204 (class 1259 OID 17545)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE usuario (
    id integer NOT NULL,
    codusuario character varying(255),
    nombre character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    rol character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE usuario OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 17543)
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuario_id_seq OWNER TO postgres;

--
-- TOC entry 2283 (class 0 OID 0)
-- Dependencies: 203
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuario_id_seq OWNED BY usuario.id;


--
-- TOC entry 202 (class 1259 OID 17419)
-- Name: ws_respuesta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE ws_respuesta (
    codrespuesta character varying(20) NOT NULL,
    mensaje character varying(100)
);


ALTER TABLE ws_respuesta OWNER TO postgres;

--
-- TOC entry 2085 (class 2604 OID 17422)
-- Name: estatus id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estatus ALTER COLUMN id SET DEFAULT nextval('pedido_estatus_id_seq'::regclass);


--
-- TOC entry 2083 (class 2604 OID 17423)
-- Name: tipo_estatus cod_tipo_estatus; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_estatus ALTER COLUMN cod_tipo_estatus SET DEFAULT nextval('estado_ped_cod_estado_ped_seq'::regclass);


--
-- TOC entry 2090 (class 2604 OID 17557)
-- Name: unidad id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY unidad ALTER COLUMN id SET DEFAULT nextval('unidad_id_seq'::regclass);


--
-- TOC entry 2089 (class 2604 OID 17548)
-- Name: usuario id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario ALTER COLUMN id SET DEFAULT nextval('usuario_id_seq'::regclass);


--
-- TOC entry 2251 (class 0 OID 17347)
-- Dependencies: 185
-- Data for Name: cargo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY cargo (codtipcargo, nombre) FROM stdin;
1	DIRECTOR
2	PRESIDENTE
3	EJECUTIVO
\.


--
-- TOC entry 2252 (class 0 OID 17350)
-- Dependencies: 186
-- Data for Name: ciudad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ciudad (codciudad, codestado, nombre, capital) FROM stdin;
1	1	Maroa	f
2	1	Puerto Ayacucho	t
3	1	San Fernando de Atabapo	f
4	2	Anaco	f
5	2	Aragua de Barcelona	f
6	2	Barcelona	t
7	2	Boca de Uchire	f
8	2	Cantaura	f
9	2	Clarines	f
10	2	El Chaparro	f
11	2	El Pao Anzoátegui	f
12	2	El Tigre	f
13	2	El Tigrito	f
14	2	Guanape	f
15	2	Guanta	f
16	2	Lechería	f
17	2	Onoto	f
18	2	Pariaguán	f
19	2	Píritu	f
20	2	Puerto La Cruz	f
21	2	Puerto Píritu	f
22	2	Sabana de Uchire	f
23	2	San Mateo Anzoátegui	f
24	2	San Pablo Anzoátegui	f
25	2	San Tomé	f
26	2	Santa Ana de Anzoátegui	f
27	2	Santa Fe Anzoátegui	f
28	2	Santa Rosa	f
29	2	Soledad	f
30	2	Urica	f
31	2	Valle de Guanape	f
43	3	Achaguas	f
44	3	Biruaca	f
45	3	Bruzual	f
46	3	El Amparo	f
47	3	El Nula	f
48	3	Elorza	f
49	3	Guasdualito	f
50	3	Mantecal	f
51	3	Puerto Páez	f
52	3	San Fernando de Apure	t
53	3	San Juan de Payara	f
54	4	Barbacoas	f
55	4	Cagua	f
56	4	Camatagua	f
58	4	Choroní	f
59	4	Colonia Tovar	f
60	4	El Consejo	f
61	4	La Victoria	f
62	4	Las Tejerías	f
63	4	Magdaleno	f
64	4	Maracay	t
65	4	Ocumare de La Costa	f
66	4	Palo Negro	f
67	4	San Casimiro	f
68	4	San Mateo	f
69	4	San Sebastián	f
70	4	Santa Cruz de Aragua	f
71	4	Tocorón	f
72	4	Turmero	f
73	4	Villa de Cura	f
74	4	Zuata	f
75	5	Barinas	t
76	5	Barinitas	f
77	5	Barrancas	f
78	5	Calderas	f
79	5	Capitanejo	f
80	5	Ciudad Bolivia	f
81	5	El Cantón	f
82	5	Las Veguitas	f
83	5	Libertad de Barinas	f
84	5	Sabaneta	f
85	5	Santa Bárbara de Barinas	f
86	5	Socopó	f
87	6	Caicara del Orinoco	f
88	6	Canaima	f
89	6	Ciudad Bolívar	t
90	6	Ciudad Piar	f
91	6	El Callao	f
92	6	El Dorado	f
93	6	El Manteco	f
94	6	El Palmar	f
95	6	El Pao	f
96	6	Guasipati	f
97	6	Guri	f
98	6	La Paragua	f
99	6	Matanzas	f
100	6	Puerto Ordaz	f
101	6	San Félix	f
102	6	Santa Elena de Uairén	f
103	6	Tumeremo	f
104	6	Unare	f
105	6	Upata	f
106	7	Bejuma	f
107	7	Belén	f
108	7	Campo de Carabobo	f
109	7	Canoabo	f
110	7	Central Tacarigua	f
111	7	Chirgua	f
112	7	Ciudad Alianza	f
113	7	El Palito	f
114	7	Guacara	f
115	7	Guigue	f
116	7	Las Trincheras	f
117	7	Los Guayos	f
118	7	Mariara	f
119	7	Miranda	f
120	7	Montalbán	f
121	7	Morón	f
122	7	Naguanagua	f
123	7	Puerto Cabello	f
124	7	San Joaquín	f
125	7	Tocuyito	f
126	7	Urama	f
127	7	Valencia	t
128	7	Vigirimita	f
129	8	Aguirre	f
130	8	Apartaderos Cojedes	f
131	8	Arismendi	f
132	8	Camuriquito	f
133	8	El Baúl	f
134	8	El Limón	f
135	8	El Pao Cojedes	f
136	8	El Socorro	f
137	8	La Aguadita	f
138	8	Las Vegas	f
139	8	Libertad de Cojedes	f
140	8	Mapuey	f
141	8	Piñedo	f
142	8	Samancito	f
143	8	San Carlos	t
144	8	Sucre	f
145	8	Tinaco	f
146	8	Tinaquillo	f
147	8	Vallecito	f
148	9	Tucupita	t
149	24	Caracas	t
150	24	El Junquito	f
151	10	Adícora	f
152	10	Boca de Aroa	f
153	10	Cabure	f
154	10	Capadare	f
155	10	Capatárida	f
156	10	Chichiriviche	f
157	10	Churuguara	f
158	10	Coro	t
159	10	Cumarebo	f
160	10	Dabajuro	f
161	10	Judibana	f
162	10	La Cruz de Taratara	f
163	10	La Vela de Coro	f
164	10	Los Taques	f
165	10	Maparari	f
166	10	Mene de Mauroa	f
167	10	Mirimire	f
168	10	Pedregal	f
169	10	Píritu Falcón	f
170	10	Pueblo Nuevo Falcón	f
171	10	Puerto Cumarebo	f
172	10	Punta Cardón	f
173	10	Punto Fijo	f
174	10	San Juan de Los Cayos	f
175	10	San Luis	f
176	10	Santa Ana Falcón	f
177	10	Santa Cruz De Bucaral	f
178	10	Tocopero	f
179	10	Tocuyo de La Costa	f
180	10	Tucacas	f
181	10	Yaracal	f
182	11	Altagracia de Orituco	f
183	11	Cabruta	f
184	11	Calabozo	f
185	11	Camaguán	f
196	11	Chaguaramas Guárico	f
197	11	El Socorro	f
198	11	El Sombrero	f
199	11	Las Mercedes de Los Llanos	f
200	11	Lezama	f
201	11	Onoto	f
202	11	Ortíz	f
203	11	San José de Guaribe	f
204	11	San Juan de Los Morros	t
205	11	San Rafael de Laya	f
206	11	Santa María de Ipire	f
207	11	Tucupido	f
208	11	Valle de La Pascua	f
209	11	Zaraza	f
210	12	Aguada Grande	f
211	12	Atarigua	f
212	12	Barquisimeto	t
213	12	Bobare	f
214	12	Cabudare	f
215	12	Carora	f
216	12	Cubiro	f
217	12	Cují	f
218	12	Duaca	f
219	12	El Manzano	f
220	12	El Tocuyo	f
221	12	Guaríco	f
222	12	Humocaro Alto	f
223	12	Humocaro Bajo	f
224	12	La Miel	f
225	12	Moroturo	f
226	12	Quíbor	f
227	12	Río Claro	f
228	12	Sanare	f
229	12	Santa Inés	f
230	12	Sarare	f
231	12	Siquisique	f
232	12	Tintorero	f
233	13	Apartaderos Mérida	f
234	13	Arapuey	f
235	13	Bailadores	f
236	13	Caja Seca	f
237	13	Canaguá	f
238	13	Chachopo	f
239	13	Chiguara	f
240	13	Ejido	f
241	13	El Vigía	f
242	13	La Azulita	f
243	13	La Playa	f
244	13	Lagunillas Mérida	f
245	13	Mérida	t
246	13	Mesa de Bolívar	f
247	13	Mucuchíes	f
248	13	Mucujepe	f
249	13	Mucuruba	f
250	13	Nueva Bolivia	f
251	13	Palmarito	f
252	13	Pueblo Llano	f
253	13	Santa Cruz de Mora	f
254	13	Santa Elena de Arenales	f
255	13	Santo Domingo	f
256	13	Tabáy	f
257	13	Timotes	f
258	13	Torondoy	f
259	13	Tovar	f
260	13	Tucani	f
261	13	Zea	f
262	14	Araguita	f
263	14	Carrizal	f
264	14	Caucagua	f
265	14	Chaguaramas Miranda	f
266	14	Charallave	f
267	14	Chirimena	f
268	14	Chuspa	f
269	14	Cúa	f
270	14	Cupira	f
271	14	Curiepe	f
272	14	El Guapo	f
273	14	El Jarillo	f
274	14	Filas de Mariche	f
275	14	Guarenas	f
276	14	Guatire	f
277	14	Higuerote	f
278	14	Los Anaucos	f
279	14	Los Teques	t
280	14	Ocumare del Tuy	f
281	14	Panaquire	f
282	14	Paracotos	f
283	14	Río Chico	f
284	14	San Antonio de Los Altos	f
285	14	San Diego de Los Altos	f
286	14	San Fernando del Guapo	f
287	14	San Francisco de Yare	f
288	14	San José de Los Altos	f
289	14	San José de Río Chico	f
290	14	San Pedro de Los Altos	f
291	14	Santa Lucía	f
292	14	Santa Teresa	f
293	14	Tacarigua de La Laguna	f
294	14	Tacarigua de Mamporal	f
295	14	Tácata	f
296	14	Turumo	f
297	15	Aguasay	f
298	15	Aragua de Maturín	f
299	15	Barrancas del Orinoco	f
300	15	Caicara de Maturín	f
301	15	Caripe	f
302	15	Caripito	f
303	15	Chaguaramal	f
305	15	Chaguaramas Monagas	f
307	15	El Furrial	f
308	15	El Tejero	f
309	15	Jusepín	f
310	15	La Toscana	f
311	15	Maturín	t
312	15	Miraflores	f
313	15	Punta de Mata	f
314	15	Quiriquire	f
315	15	San Antonio de Maturín	f
316	15	San Vicente Monagas	f
317	15	Santa Bárbara	f
318	15	Temblador	f
319	15	Teresen	f
320	15	Uracoa	f
321	16	Altagracia	f
322	16	Boca de Pozo	f
323	16	Boca de Río	f
324	16	El Espinal	f
325	16	El Valle del Espíritu Santo	f
326	16	El Yaque	f
327	16	Juangriego	f
328	16	La Asunción	t
329	16	La Guardia	f
330	16	Pampatar	f
331	16	Porlamar	f
332	16	Puerto Fermín	f
333	16	Punta de Piedras	f
334	16	San Francisco de Macanao	f
335	16	San Juan Bautista	f
336	16	San Pedro de Coche	f
337	16	Santa Ana de Nueva Esparta	f
338	16	Villa Rosa	f
339	17	Acarigua	f
340	17	Agua Blanca	f
341	17	Araure	f
342	17	Biscucuy	f
343	17	Boconoito	f
344	17	Campo Elías	f
345	17	Chabasquén	f
346	17	Guanare	t
347	17	Guanarito	f
348	17	La Aparición	f
349	17	La Misión	f
350	17	Mesa de Cavacas	f
351	17	Ospino	f
352	17	Papelón	f
353	17	Payara	f
354	17	Pimpinela	f
355	17	Píritu de Portuguesa	f
356	17	San Rafael de Onoto	f
357	17	Santa Rosalía	f
358	17	Turén	f
359	18	Altos de Sucre	f
360	18	Araya	f
361	18	Cariaco	f
362	18	Carúpano	f
363	18	Casanay	f
364	18	Cumaná	t
365	18	Cumanacoa	f
366	18	El Morro Puerto Santo	f
367	18	El Pilar	f
368	18	El Poblado	f
369	18	Guaca	f
370	18	Guiria	f
371	18	Irapa	f
372	18	Manicuare	f
373	18	Mariguitar	f
374	18	Río Caribe	f
375	18	San Antonio del Golfo	f
376	18	San José de Aerocuar	f
377	18	San Vicente de Sucre	f
378	18	Santa Fe de Sucre	f
379	18	Tunapuy	f
380	18	Yaguaraparo	f
381	18	Yoco	f
382	19	Abejales	f
383	19	Borota	f
384	19	Bramon	f
385	19	Capacho	f
386	19	Colón	f
387	19	Coloncito	f
388	19	Cordero	f
389	19	El Cobre	f
390	19	El Pinal	f
391	19	Independencia	f
392	19	La Fría	f
393	19	La Grita	f
394	19	La Pedrera	f
395	19	La Tendida	f
396	19	Las Delicias	f
397	19	Las Hernández	f
398	19	Lobatera	f
399	19	Michelena	f
400	19	Palmira	f
401	19	Pregonero	f
402	19	Queniquea	f
403	19	Rubio	f
404	19	San Antonio del Tachira	f
405	19	San Cristobal	t
406	19	San José de Bolívar	f
407	19	San Josecito	f
408	19	San Pedro del Río	f
409	19	Santa Ana Táchira	f
410	19	Seboruco	f
411	19	Táriba	f
412	19	Umuquena	f
413	19	Ureña	f
414	20	Batatal	f
415	20	Betijoque	f
416	20	Boconó	f
417	20	Carache	f
418	20	Chejende	f
419	20	Cuicas	f
420	20	El Dividive	f
421	20	El Jaguito	f
422	20	Escuque	f
423	20	Isnotú	f
424	20	Jajó	f
425	20	La Ceiba	f
426	20	La Concepción de Trujllo	f
427	20	La Mesa de Esnujaque	f
428	20	La Puerta	f
429	20	La Quebrada	f
430	20	Mendoza Fría	f
431	20	Meseta de Chimpire	f
432	20	Monay	f
433	20	Motatán	f
434	20	Pampán	f
435	20	Pampanito	f
436	20	Sabana de Mendoza	f
437	20	San Lázaro	f
438	20	Santa Ana de Trujillo	f
439	20	Tostós	f
440	20	Trujillo	t
441	20	Valera	f
442	21	Carayaca	f
443	21	Litoral	f
444	25	Archipiélago Los Roques	f
445	22	Aroa	f
446	22	Boraure	f
447	22	Campo Elías de Yaracuy	f
448	22	Chivacoa	f
449	22	Cocorote	f
450	22	Farriar	f
451	22	Guama	f
452	22	Marín	f
453	22	Nirgua	f
454	22	Sabana de Parra	f
455	22	Salom	f
456	22	San Felipe	t
457	22	San Pablo de Yaracuy	f
458	22	Urachiche	f
459	22	Yaritagua	f
460	22	Yumare	f
461	23	Bachaquero	f
462	23	Bobures	f
463	23	Cabimas	f
464	23	Campo Concepción	f
465	23	Campo Mara	f
466	23	Campo Rojo	f
467	23	Carrasquero	f
468	23	Casigua	f
469	23	Chiquinquirá	f
470	23	Ciudad Ojeda	f
471	23	El Batey	f
472	23	El Carmelo	f
473	23	El Chivo	f
474	23	El Guayabo	f
475	23	El Mene	f
476	23	El Venado	f
477	23	Encontrados	f
478	23	Gibraltar	f
479	23	Isla de Toas	f
480	23	La Concepción del Zulia	f
481	23	La Paz	f
482	23	La Sierrita	f
483	23	Lagunillas del Zulia	f
484	23	Las Piedras de Perijá	f
485	23	Los Cortijos	f
486	23	Machiques	f
487	23	Maracaibo	t
488	23	Mene Grande	f
489	23	Palmarejo	f
490	23	Paraguaipoa	f
491	23	Potrerito	f
492	23	Pueblo Nuevo del Zulia	f
493	23	Puertos de Altagracia	f
494	23	Punta Gorda	f
495	23	Sabaneta de Palma	f
496	23	San Francisco	f
497	23	San José de Perijá	f
498	23	San Rafael del Moján	f
499	23	San Timoteo	f
500	23	Santa Bárbara Del Zulia	f
501	23	Santa Cruz de Mara	f
502	23	Santa Cruz del Zulia	f
503	23	Santa Rita	f
504	23	Sinamaica	f
505	23	Tamare	f
506	23	Tía Juana	f
507	23	Villa del Rosario	f
508	21	La Guaira	t
509	21	Catia La Mar	f
510	21	Macuto	f
511	21	Naiguatá	f
512	25	Archipiélago Los Monjes	f
513	25	Isla La Tortuga y Cayos adyacentes	f
514	25	Isla La Sola	f
515	25	Islas Los Testigos	f
516	25	Islas Los Frailes	f
517	25	Isla La Orchila	f
518	25	Archipiélago Las Aves	f
519	25	Isla de Aves	f
520	25	Isla La Blanquilla	f
521	25	Isla de Patos	f
522	25	Islas Los Hermanos	f
\.


--
-- TOC entry 2253 (class 0 OID 17353)
-- Dependencies: 187
-- Data for Name: empresa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY empresa (cod_rif, rnc, nombre, codcedula, correo, telefono, telefono2, codregion, codestado, codmunicipio, codparroquia, codciudad, dirrecion, fecha_ing, soli, aprob, confirm, visto) FROM stdin;
J129956789	987456321456975	maxi donuts	v14500747	donayts@gmail.com	04123336654	0412333654	\N	13	190	557	246	av sucre edif boliar piso 5 apato 9	2017-08-19 12:04:36.089473	\N	\N	\N	t
\.


--
-- TOC entry 2254 (class 0 OID 17360)
-- Dependencies: 188
-- Data for Name: estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estado (codestado, nombre, "iso_3166-2", codregion) FROM stdin;
1	Amazonas	VE-X	\N
2	Anzoátegui	VE-B	\N
3	Apure	VE-C	\N
4	Aragua	VE-D	\N
5	Barinas	VE-E	\N
6	Bolívar	VE-F	\N
7	Carabobo	VE-G	\N
8	Cojedes	VE-H	\N
9	Delta Amacuro	VE-Y	\N
10	Falcón	VE-I	\N
11	Guárico	VE-J	\N
12	Lara	VE-K	\N
13	Mérida	VE-L	\N
14	Miranda	VE-M	\N
15	Monagas	VE-N	\N
16	Nueva Esparta	VE-O	\N
17	Portuguesa	VE-P	\N
18	Sucre	VE-R	\N
19	Táchira	VE-S	\N
20	Trujillo	VE-T	\N
21	Vargas	VE-W	\N
22	Yaracuy	VE-U	\N
23	Zulia	VE-V	\N
24	Distrito Capital	VE-A	\N
25	Dependencias Federales	VE-Z	\N
\.


--
-- TOC entry 2284 (class 0 OID 0)
-- Dependencies: 190
-- Name: estado_ped_cod_estado_ped_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('estado_ped_cod_estado_ped_seq', 1, false);


--
-- TOC entry 2257 (class 0 OID 17371)
-- Dependencies: 191
-- Data for Name: estatus; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estatus (id, cod_estatus, cod_pedido, cod_tipo_estatus, cod_usuario, observaciones, fecha_estatus) FROM stdin;
72	\N	PED6545282	1	US001	\N	2017-09-11 23:03:58.382338
73	\N	PED6545282	2	US001	\N	2017-09-11 23:05:22.777359
74	\N	PED6545282	4	US001	\N	2017-09-11 23:07:54.177477
\.


--
-- TOC entry 2258 (class 0 OID 17378)
-- Dependencies: 192
-- Data for Name: municipio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY municipio (codmunicipio, codestado, nombre) FROM stdin;
1	1	Alto Orinoco
2	1	Atabapo
3	1	Atures
4	1	Autana
5	1	Manapiare
6	1	Maroa
7	1	Río Negro
8	2	Anaco
9	2	Aragua
10	2	Manuel Ezequiel Bruzual
11	2	Diego Bautista Urbaneja
12	2	Fernando Peñalver
13	2	Francisco Del Carmen Carvajal
14	2	General Sir Arthur McGregor
15	2	Guanta
16	2	Independencia
17	2	José Gregorio Monagas
18	2	Juan Antonio Sotillo
19	2	Juan Manuel Cajigal
20	2	Libertad
21	2	Francisco de Miranda
22	2	Pedro María Freites
23	2	Píritu
24	2	San José de Guanipa
25	2	San Juan de Capistrano
26	2	Santa Ana
27	2	Simón Bolívar
28	2	Simón Rodríguez
29	3	Achaguas
30	3	Biruaca
31	3	Muñóz
32	3	Páez
33	3	Pedro Camejo
34	3	Rómulo Gallegos
35	3	San Fernando
36	4	Atanasio Girardot
37	4	Bolívar
38	4	Camatagua
39	4	Francisco Linares Alcántara
40	4	José Ángel Lamas
41	4	José Félix Ribas
42	4	José Rafael Revenga
43	4	Libertador
44	4	Mario Briceño Iragorry
45	4	Ocumare de la Costa de Oro
46	4	San Casimiro
47	4	San Sebastián
48	4	Santiago Mariño
49	4	Santos Michelena
50	4	Sucre
51	4	Tovar
52	4	Urdaneta
53	4	Zamora
54	5	Alberto Arvelo Torrealba
55	5	Andrés Eloy Blanco
56	5	Antonio José de Sucre
57	5	Arismendi
58	5	Barinas
59	5	Bolívar
60	5	Cruz Paredes
61	5	Ezequiel Zamora
62	5	Obispos
63	5	Pedraza
64	5	Rojas
65	5	Sosa
66	6	Caroní
67	6	Cedeño
68	6	El Callao
69	6	Gran Sabana
70	6	Heres
71	6	Piar
72	6	Angostura (Raúl Leoni)
73	6	Roscio
74	6	Sifontes
75	6	Sucre
76	6	Padre Pedro Chien
77	7	Bejuma
78	7	Carlos Arvelo
79	7	Diego Ibarra
80	7	Guacara
81	7	Juan José Mora
82	7	Libertador
83	7	Los Guayos
84	7	Miranda
85	7	Montalbán
86	7	Naguanagua
87	7	Puerto Cabello
88	7	San Diego
89	7	San Joaquín
90	7	Valencia
91	8	Anzoátegui
92	8	Tinaquillo
93	8	Girardot
94	8	Lima Blanco
95	8	Pao de San Juan Bautista
96	8	Ricaurte
97	8	Rómulo Gallegos
98	8	San Carlos
99	8	Tinaco
100	9	Antonio Díaz
101	9	Casacoima
102	9	Pedernales
103	9	Tucupita
104	10	Acosta
105	10	Bolívar
106	10	Buchivacoa
107	10	Cacique Manaure
108	10	Carirubana
109	10	Colina
110	10	Dabajuro
111	10	Democracia
112	10	Falcón
113	10	Federación
114	10	Jacura
115	10	José Laurencio Silva
116	10	Los Taques
117	10	Mauroa
118	10	Miranda
119	10	Monseñor Iturriza
120	10	Palmasola
121	10	Petit
122	10	Píritu
123	10	San Francisco
124	10	Sucre
125	10	Tocópero
126	10	Unión
127	10	Urumaco
128	10	Zamora
129	11	Camaguán
130	11	Chaguaramas
131	11	El Socorro
132	11	José Félix Ribas
133	11	José Tadeo Monagas
134	11	Juan Germán Roscio
135	11	Julián Mellado
136	11	Las Mercedes
137	11	Leonardo Infante
138	11	Pedro Zaraza
139	11	Ortíz
140	11	San Gerónimo de Guayabal
141	11	San José de Guaribe
142	11	Santa María de Ipire
143	11	Sebastián Francisco de Miranda
144	12	Andrés Eloy Blanco
145	12	Crespo
146	12	Iribarren
147	12	Jiménez
148	12	Morán
149	12	Palavecino
150	12	Simón Planas
151	12	Torres
152	12	Urdaneta
179	13	Alberto Adriani
180	13	Andrés Bello
181	13	Antonio Pinto Salinas
182	13	Aricagua
183	13	Arzobispo Chacón
184	13	Campo Elías
185	13	Caracciolo Parra Olmedo
186	13	Cardenal Quintero
187	13	Guaraque
188	13	Julio César Salas
189	13	Justo Briceño
190	13	Libertador
191	13	Miranda
192	13	Obispo Ramos de Lora
193	13	Padre Noguera
194	13	Pueblo Llano
195	13	Rangel
196	13	Rivas Dávila
197	13	Santos Marquina
198	13	Sucre
199	13	Tovar
200	13	Tulio Febres Cordero
201	13	Zea
223	14	Acevedo
224	14	Andrés Bello
225	14	Baruta
226	14	Brión
227	14	Buroz
228	14	Carrizal
229	14	Chacao
230	14	Cristóbal Rojas
231	14	El Hatillo
232	14	Guaicaipuro
233	14	Independencia
234	14	Lander
235	14	Los Salias
236	14	Páez
237	14	Paz Castillo
238	14	Pedro Gual
239	14	Plaza
240	14	Simón Bolívar
241	14	Sucre
242	14	Urdaneta
243	14	Zamora
258	15	Acosta
259	15	Aguasay
260	15	Bolívar
261	15	Caripe
262	15	Cedeño
263	15	Ezequiel Zamora
264	15	Libertador
265	15	Maturín
266	15	Piar
267	15	Punceres
268	15	Santa Bárbara
269	15	Sotillo
270	15	Uracoa
271	16	Antolín del Campo
272	16	Arismendi
273	16	García
274	16	Gómez
275	16	Maneiro
276	16	Marcano
277	16	Mariño
278	16	Península de Macanao
279	16	Tubores
280	16	Villalba
281	16	Díaz
282	17	Agua Blanca
283	17	Araure
284	17	Esteller
285	17	Guanare
286	17	Guanarito
287	17	Monseñor José Vicente de Unda
288	17	Ospino
289	17	Páez
290	17	Papelón
291	17	San Genaro de Boconoíto
292	17	San Rafael de Onoto
293	17	Santa Rosalía
294	17	Sucre
295	17	Turén
296	18	Andrés Eloy Blanco
297	18	Andrés Mata
298	18	Arismendi
299	18	Benítez
300	18	Bermúdez
301	18	Bolívar
302	18	Cajigal
303	18	Cruz Salmerón Acosta
304	18	Libertador
305	18	Mariño
306	18	Mejía
307	18	Montes
308	18	Ribero
309	18	Sucre
310	18	Valdéz
341	19	Andrés Bello
342	19	Antonio Rómulo Costa
343	19	Ayacucho
344	19	Bolívar
345	19	Cárdenas
346	19	Córdoba
347	19	Fernández Feo
348	19	Francisco de Miranda
349	19	García de Hevia
350	19	Guásimos
351	19	Independencia
352	19	Jáuregui
353	19	José María Vargas
354	19	Junín
355	19	Libertad
356	19	Libertador
357	19	Lobatera
358	19	Michelena
359	19	Panamericano
360	19	Pedro María Ureña
361	19	Rafael Urdaneta
362	19	Samuel Darío Maldonado
363	19	San Cristóbal
364	19	Seboruco
365	19	Simón Rodríguez
366	19	Sucre
367	19	Torbes
368	19	Uribante
369	19	San Judas Tadeo
370	20	Andrés Bello
371	20	Boconó
372	20	Bolívar
373	20	Candelaria
374	20	Carache
375	20	Escuque
376	20	José Felipe Márquez Cañizalez
377	20	Juan Vicente Campos Elías
378	20	La Ceiba
379	20	Miranda
380	20	Monte Carmelo
381	20	Motatán
382	20	Pampán
383	20	Pampanito
384	20	Rafael Rangel
385	20	San Rafael de Carvajal
386	20	Sucre
387	20	Trujillo
388	20	Urdaneta
389	20	Valera
390	21	Vargas
391	22	Arístides Bastidas
392	22	Bolívar
407	22	Bruzual
408	22	Cocorote
409	22	Independencia
410	22	José Antonio Páez
411	22	La Trinidad
412	22	Manuel Monge
413	22	Nirgua
414	22	Peña
415	22	San Felipe
416	22	Sucre
417	22	Urachiche
418	22	José Joaquín Veroes
441	23	Almirante Padilla
442	23	Baralt
443	23	Cabimas
444	23	Catatumbo
445	23	Colón
446	23	Francisco Javier Pulgar
447	23	Páez
448	23	Jesús Enrique Losada
449	23	Jesús María Semprún
450	23	La Cañada de Urdaneta
451	23	Lagunillas
452	23	Machiques de Perijá
453	23	Mara
454	23	Maracaibo
455	23	Miranda
456	23	Rosario de Perijá
457	23	San Francisco
458	23	Santa Rita
459	23	Simón Bolívar
460	23	Sucre
461	23	Valmore Rodríguez
462	24	Libertador
\.


--
-- TOC entry 2259 (class 0 OID 17381)
-- Dependencies: 193
-- Data for Name: parroquia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY parroquia (codparroquia, codmunicipio, nombre) FROM stdin;
1	1	Alto Orinoco
2	1	Huachamacare Acanaña
3	1	Marawaka Toky Shamanaña
4	1	Mavaka Mavaka
5	1	Sierra Parima Parimabé
6	2	Ucata Laja Lisa
7	2	Yapacana Macuruco
8	2	Caname Guarinuma
9	3	Fernando Girón Tovar
10	3	Luis Alberto Gómez
11	3	Pahueña Limón de Parhueña
12	3	Platanillal Platanillal
13	4	Samariapo
14	4	Sipapo
15	4	Munduapo
16	4	Guayapo
17	5	Alto Ventuari
18	5	Medio Ventuari
19	5	Bajo Ventuari
20	6	Victorino
21	6	Comunidad
22	7	Casiquiare
23	7	Cocuy
24	7	San Carlos de Río Negro
25	7	Solano
26	8	Anaco
27	8	San Joaquín
28	9	Cachipo
29	9	Aragua de Barcelona
30	11	Lechería
31	11	El Morro
32	12	Puerto Píritu
33	12	San Miguel
34	12	Sucre
35	13	Valle de Guanape
36	13	Santa Bárbara
37	14	El Chaparro
38	14	Tomás Alfaro
39	14	Calatrava
40	15	Guanta
41	15	Chorrerón
42	16	Mamo
43	16	Soledad
44	17	Mapire
45	17	Piar
46	17	Santa Clara
47	17	San Diego de Cabrutica
48	17	Uverito
49	17	Zuata
50	18	Puerto La Cruz
51	18	Pozuelos
52	19	Onoto
53	19	San Pablo
54	20	San Mateo
55	20	El Carito
56	20	Santa Inés
57	20	La Romereña
58	21	Atapirire
59	21	Boca del Pao
60	21	El Pao
61	21	Pariaguán
62	22	Cantaura
63	22	Libertador
64	22	Santa Rosa
65	22	Urica
66	23	Píritu
67	23	San Francisco
68	24	San José de Guanipa
69	25	Boca de Uchire
70	25	Boca de Chávez
71	26	Pueblo Nuevo
72	26	Santa Ana
73	27	Bergantín
74	27	Caigua
75	27	El Carmen
76	27	El Pilar
77	27	Naricual
78	27	San Crsitóbal
79	28	Edmundo Barrios
80	28	Miguel Otero Silva
81	29	Achaguas
82	29	Apurito
83	29	El Yagual
84	29	Guachara
85	29	Mucuritas
86	29	Queseras del medio
87	30	Biruaca
88	31	Bruzual
89	31	Mantecal
90	31	Quintero
91	31	Rincón Hondo
92	31	San Vicente
93	32	Guasdualito
94	32	Aramendi
95	32	El Amparo
96	32	San Camilo
97	32	Urdaneta
98	33	San Juan de Payara
99	33	Codazzi
100	33	Cunaviche
101	34	Elorza
102	34	La Trinidad
103	35	San Fernando
104	35	El Recreo
105	35	Peñalver
106	35	San Rafael de Atamaica
107	36	Pedro José Ovalles
108	36	Joaquín Crespo
109	36	José Casanova Godoy
110	36	Madre María de San José
111	36	Andrés Eloy Blanco
112	36	Los Tacarigua
113	36	Las Delicias
114	36	Choroní
115	37	Bolívar
116	38	Camatagua
117	38	Carmen de Cura
118	39	Santa Rita
119	39	Francisco de Miranda
120	39	Moseñor Feliciano González
121	40	Santa Cruz
122	41	José Félix Ribas
123	41	Castor Nieves Ríos
124	41	Las Guacamayas
125	41	Pao de Zárate
126	41	Zuata
127	42	José Rafael Revenga
128	43	Palo Negro
129	43	San Martín de Porres
130	44	El Limón
131	44	Caña de Azúcar
132	45	Ocumare de la Costa
133	46	San Casimiro
134	46	Güiripa
135	46	Ollas de Caramacate
136	46	Valle Morín
137	47	San Sebastían
138	48	Turmero
139	48	Arevalo Aponte
140	48	Chuao
141	48	Samán de Güere
142	48	Alfredo Pacheco Miranda
143	49	Santos Michelena
144	49	Tiara
145	50	Cagua
146	50	Bella Vista
147	51	Tovar
148	52	Urdaneta
149	52	Las Peñitas
150	52	San Francisco de Cara
151	52	Taguay
152	53	Zamora
153	53	Magdaleno
154	53	San Francisco de Asís
155	53	Valles de Tucutunemo
156	53	Augusto Mijares
157	54	Sabaneta
158	54	Juan Antonio Rodríguez Domínguez
159	55	El Cantón
160	55	Santa Cruz de Guacas
161	55	Puerto Vivas
162	56	Ticoporo
163	56	Nicolás Pulido
164	56	Andrés Bello
165	57	Arismendi
166	57	Guadarrama
167	57	La Unión
168	57	San Antonio
169	58	Barinas
170	58	Alberto Arvelo Larriva
171	58	San Silvestre
172	58	Santa Inés
173	58	Santa Lucía
174	58	Torumos
175	58	El Carmen
176	58	Rómulo Betancourt
177	58	Corazón de Jesús
178	58	Ramón Ignacio Méndez
179	58	Alto Barinas
180	58	Manuel Palacio Fajardo
181	58	Juan Antonio Rodríguez Domínguez
182	58	Dominga Ortiz de Páez
183	59	Barinitas
184	59	Altamira de Cáceres
185	59	Calderas
186	60	Barrancas
187	60	El Socorro
188	60	Mazparrito
189	61	Santa Bárbara
190	61	Pedro Briceño Méndez
191	61	Ramón Ignacio Méndez
192	61	José Ignacio del Pumar
193	62	Obispos
194	62	Guasimitos
195	62	El Real
196	62	La Luz
197	63	Ciudad Bolívia
198	63	José Ignacio Briceño
199	63	José Félix Ribas
200	63	Páez
201	64	Libertad
202	64	Dolores
203	64	Santa Rosa
204	64	Palacio Fajardo
205	65	Ciudad de Nutrias
206	65	El Regalo
207	65	Puerto Nutrias
208	65	Santa Catalina
209	66	Cachamay
210	66	Chirica
211	66	Dalla Costa
212	66	Once de Abril
213	66	Simón Bolívar
214	66	Unare
215	66	Universidad
216	66	Vista al Sol
217	66	Pozo Verde
218	66	Yocoima
219	66	5 de Julio
220	67	Cedeño
221	67	Altagracia
222	67	Ascensión Farreras
223	67	Guaniamo
224	67	La Urbana
225	67	Pijiguaos
226	68	El Callao
227	69	Gran Sabana
228	69	Ikabarú
229	70	Catedral
230	70	Zea
231	70	Orinoco
232	70	José Antonio Páez
233	70	Marhuanta
234	70	Agua Salada
235	70	Vista Hermosa
236	70	La Sabanita
237	70	Panapana
238	71	Andrés Eloy Blanco
239	71	Pedro Cova
240	72	Raúl Leoni
241	72	Barceloneta
242	72	Santa Bárbara
243	72	San Francisco
244	73	Roscio
245	73	Salóm
246	74	Sifontes
247	74	Dalla Costa
248	74	San Isidro
249	75	Sucre
250	75	Aripao
251	75	Guarataro
252	75	Las Majadas
253	75	Moitaco
254	76	Padre Pedro Chien
255	76	Río Grande
256	77	Bejuma
257	77	Canoabo
258	77	Simón Bolívar
259	78	Güigüe
260	78	Carabobo
261	78	Tacarigua
262	79	Mariara
263	79	Aguas Calientes
264	80	Ciudad Alianza
265	80	Guacara
266	80	Yagua
267	81	Morón
268	81	Yagua
269	82	Tocuyito
270	82	Independencia
271	83	Los Guayos
272	84	Miranda
273	85	Montalbán
274	86	Naguanagua
275	87	Bartolomé Salóm
276	87	Democracia
277	87	Fraternidad
278	87	Goaigoaza
279	87	Juan José Flores
280	87	Unión
281	87	Borburata
282	87	Patanemo
283	88	San Diego
284	89	San Joaquín
285	90	Candelaria
286	90	Catedral
287	90	El Socorro
288	90	Miguel Peña
289	90	Rafael Urdaneta
290	90	San Blas
291	90	San José
292	90	Santa Rosa
293	90	Negro Primero
294	91	Cojedes
295	91	Juan de Mata Suárez
296	92	Tinaquillo
297	93	El Baúl
298	93	Sucre
299	94	La Aguadita
300	94	Macapo
301	95	El Pao
302	96	El Amparo
303	96	Libertad de Cojedes
304	97	Rómulo Gallegos
305	98	San Carlos de Austria
306	98	Juan Ángel Bravo
307	98	Manuel Manrique
308	99	General en Jefe José Laurencio Silva
309	100	Curiapo
310	100	Almirante Luis Brión
311	100	Francisco Aniceto Lugo
312	100	Manuel Renaud
313	100	Padre Barral
314	100	Santos de Abelgas
315	101	Imataca
316	101	Cinco de Julio
317	101	Juan Bautista Arismendi
318	101	Manuel Piar
319	101	Rómulo Gallegos
320	102	Pedernales
321	102	Luis Beltrán Prieto Figueroa
322	103	San José (Delta Amacuro)
323	103	José Vidal Marcano
324	103	Juan Millán
325	103	Leonardo Ruíz Pineda
326	103	Mariscal Antonio José de Sucre
327	103	Monseñor Argimiro García
328	103	San Rafael (Delta Amacuro)
329	103	Virgen del Valle
330	10	Clarines
331	10	Guanape
332	10	Sabana de Uchire
333	104	Capadare
334	104	La Pastora
335	104	Libertador
336	104	San Juan de los Cayos
337	105	Aracua
338	105	La Peña
339	105	San Luis
340	106	Bariro
341	106	Borojó
342	106	Capatárida
343	106	Guajiro
344	106	Seque
345	106	Zazárida
346	106	Valle de Eroa
347	107	Cacique Manaure
348	108	Norte
349	108	Carirubana
350	108	Santa Ana
351	108	Urbana Punta Cardón
352	109	La Vela de Coro
353	109	Acurigua
354	109	Guaibacoa
355	109	Las Calderas
356	109	Macoruca
357	110	Dabajuro
358	111	Agua Clara
359	111	Avaria
360	111	Pedregal
361	111	Piedra Grande
362	111	Purureche
363	112	Adaure
364	112	Adícora
365	112	Baraived
366	112	Buena Vista
367	112	Jadacaquiva
368	112	El Vínculo
369	112	El Hato
370	112	Moruy
371	112	Pueblo Nuevo
372	113	Agua Larga
373	113	El Paují
374	113	Independencia
375	113	Mapararí
376	114	Agua Linda
377	114	Araurima
378	114	Jacura
379	115	Tucacas
380	115	Boca de Aroa
381	116	Los Taques
382	116	Judibana
383	117	Mene de Mauroa
384	117	San Félix
385	117	Casigua
386	118	Guzmán Guillermo
387	118	Mitare
388	118	Río Seco
389	118	Sabaneta
390	118	San Antonio
391	118	San Gabriel
392	118	Santa Ana
393	119	Boca del Tocuyo
394	119	Chichiriviche
395	119	Tocuyo de la Costa
396	120	Palmasola
397	121	Cabure
398	121	Colina
399	121	Curimagua
400	122	San José de la Costa
401	122	Píritu
402	123	San Francisco
403	124	Sucre
404	124	Pecaya
405	125	Tocópero
406	126	El Charal
407	126	Las Vegas del Tuy
408	126	Santa Cruz de Bucaral
409	127	Bruzual
410	127	Urumaco
411	128	Puerto Cumarebo
412	128	La Ciénaga
413	128	La Soledad
414	128	Pueblo Cumarebo
415	128	Zazárida
416	113	Churuguara
417	129	Camaguán
418	129	Puerto Miranda
419	129	Uverito
420	130	Chaguaramas
421	131	El Socorro
422	132	Tucupido
423	132	San Rafael de Laya
424	133	Altagracia de Orituco
425	133	San Rafael de Orituco
426	133	San Francisco Javier de Lezama
427	133	Paso Real de Macaira
428	133	Carlos Soublette
429	133	San Francisco de Macaira
430	133	Libertad de Orituco
431	134	Cantaclaro
432	134	San Juan de los Morros
433	134	Parapara
434	135	El Sombrero
435	135	Sosa
436	136	Las Mercedes
437	136	Cabruta
438	136	Santa Rita de Manapire
439	137	Valle de la Pascua
440	137	Espino
441	138	San José de Unare
442	138	Zaraza
443	139	San José de Tiznados
444	139	San Francisco de Tiznados
445	139	San Lorenzo de Tiznados
446	139	Ortiz
447	140	Guayabal
448	140	Cazorla
449	141	San José de Guaribe
450	141	Uveral
451	142	Santa María de Ipire
452	142	Altamira
453	143	El Calvario
454	143	El Rastro
455	143	Guardatinajas
456	143	Capital Urbana Calabozo
457	144	Quebrada Honda de Guache
458	144	Pío Tamayo
459	144	Yacambú
460	145	Fréitez
461	145	José María Blanco
462	146	Catedral
463	146	Concepción
464	146	El Cují
465	146	Juan de Villegas
466	146	Santa Rosa
467	146	Tamaca
468	146	Unión
469	146	Aguedo Felipe Alvarado
470	146	Buena Vista
471	146	Juárez
472	147	Juan Bautista Rodríguez
473	147	Cuara
474	147	Diego de Lozada
475	147	Paraíso de San José
476	147	San Miguel
477	147	Tintorero
478	147	José Bernardo Dorante
479	147	Coronel Mariano Peraza 
480	148	Bolívar
481	148	Anzoátegui
482	148	Guarico
483	148	Hilario Luna y Luna
484	148	Humocaro Alto
485	148	Humocaro Bajo
486	148	La Candelaria
487	148	Morán
488	149	Cabudare
489	149	José Gregorio Bastidas
490	149	Agua Viva
491	150	Sarare
492	150	Buría
493	150	Gustavo Vegas León
494	151	Trinidad Samuel
495	151	Antonio Díaz
496	151	Camacaro
497	151	Castañeda
498	151	Cecilio Zubillaga
499	151	Chiquinquirá
500	151	El Blanco
501	151	Espinoza de los Monteros
502	151	Lara
503	151	Las Mercedes
504	151	Manuel Morillo
505	151	Montaña Verde
506	151	Montes de Oca
507	151	Torres
508	151	Heriberto Arroyo
509	151	Reyes Vargas
510	151	Altagracia
511	152	Siquisique
512	152	Moroturo
513	152	San Miguel
514	152	Xaguas
515	179	Presidente Betancourt
516	179	Presidente Páez
517	179	Presidente Rómulo Gallegos
518	179	Gabriel Picón González
519	179	Héctor Amable Mora
520	179	José Nucete Sardi
521	179	Pulido Méndez
522	180	La Azulita
523	181	Santa Cruz de Mora
524	181	Mesa Bolívar
525	181	Mesa de Las Palmas
526	182	Aricagua
527	182	San Antonio
528	183	Canagua
529	183	Capurí
530	183	Chacantá
531	183	El Molino
532	183	Guaimaral
533	183	Mucutuy
534	183	Mucuchachí
535	184	Fernández Peña
536	184	Matriz
537	184	Montalbán
538	184	Acequias
539	184	Jají
540	184	La Mesa
541	184	San José del Sur
542	185	Tucaní
543	185	Florencio Ramírez
544	186	Santo Domingo
545	186	Las Piedras
546	187	Guaraque
547	187	Mesa de Quintero
548	187	Río Negro
549	188	Arapuey
550	188	Palmira
551	189	San Cristóbal de Torondoy
552	189	Torondoy
553	190	Antonio Spinetti Dini
554	190	Arias
555	190	Caracciolo Parra Pérez
556	190	Domingo Peña
557	190	El Llano
558	190	Gonzalo Picón Febres
559	190	Jacinto Plaza
560	190	Juan Rodríguez Suárez
561	190	Lasso de la Vega
562	190	Mariano Picón Salas
563	190	Milla
564	190	Osuna Rodríguez
565	190	Sagrario
566	190	El Morro
567	190	Los Nevados
568	191	Andrés Eloy Blanco
569	191	La Venta
570	191	Piñango
571	191	Timotes
572	192	Eloy Paredes
573	192	San Rafael de Alcázar
574	192	Santa Elena de Arenales
575	193	Santa María de Caparo
576	194	Pueblo Llano
577	195	Cacute
578	195	La Toma
579	195	Mucuchíes
580	195	Mucurubá
581	195	San Rafael
582	196	Gerónimo Maldonado
583	196	Bailadores
584	197	Tabay
585	198	Chiguará
586	198	Estánquez
587	198	Lagunillas
588	198	La Trampa
589	198	Pueblo Nuevo del Sur
590	198	San Juan
591	199	El Amparo
592	199	El Llano
593	199	San Francisco
594	199	Tovar
595	200	Independencia
596	200	María de la Concepción Palacios Blanco
597	200	Nueva Bolivia
598	200	Santa Apolonia
599	201	Caño El Tigre
600	201	Zea
601	223	Aragüita
602	223	Arévalo González
603	223	Capaya
604	223	Caucagua
605	223	Panaquire
606	223	Ribas
607	223	El Café
608	223	Marizapa
609	224	Cumbo
610	224	San José de Barlovento
611	225	El Cafetal
612	225	Las Minas
613	225	Nuestra Señora del Rosario
614	226	Higuerote
615	226	Curiepe
616	226	Tacarigua de Brión
617	227	Mamporal
618	228	Carrizal
619	229	Chacao
620	230	Charallave
621	230	Las Brisas
622	231	El Hatillo
623	232	Altagracia de la Montaña
624	232	Cecilio Acosta
625	232	Los Teques
626	232	El Jarillo
627	232	San Pedro
628	232	Tácata
629	232	Paracotos
630	233	Cartanal
631	233	Santa Teresa del Tuy
632	234	La Democracia
633	234	Ocumare del Tuy
634	234	Santa Bárbara
635	235	San Antonio de los Altos
636	236	Río Chico
637	236	El Guapo
638	236	Tacarigua de la Laguna
639	236	Paparo
640	236	San Fernando del Guapo
641	237	Santa Lucía del Tuy
642	238	Cúpira
643	238	Machurucuto
644	239	Guarenas
645	240	San Antonio de Yare
646	240	San Francisco de Yare
647	241	Leoncio Martínez
648	241	Petare
649	241	Caucagüita
650	241	Filas de Mariche
651	241	La Dolorita
652	242	Cúa
653	242	Nueva Cúa
654	243	Guatire
655	243	Bolívar
656	258	San Antonio de Maturín
657	258	San Francisco de Maturín
658	259	Aguasay
659	260	Caripito
660	261	El Guácharo
661	261	La Guanota
662	261	Sabana de Piedra
663	261	San Agustín
664	261	Teresen
665	261	Caripe
666	262	Areo
667	262	Capital Cedeño
668	262	San Félix de Cantalicio
669	262	Viento Fresco
670	263	El Tejero
671	263	Punta de Mata
672	264	Chaguaramas
673	264	Las Alhuacas
674	264	Tabasca
675	264	Temblador
676	265	Alto de los Godos
677	265	Boquerón
678	265	Las Cocuizas
679	265	La Cruz
680	265	San Simón
681	265	El Corozo
682	265	El Furrial
683	265	Jusepín
684	265	La Pica
685	265	San Vicente
686	266	Aparicio
687	266	Aragua de Maturín
688	266	Chaguamal
689	266	El Pinto
690	266	Guanaguana
691	266	La Toscana
692	266	Taguaya
693	267	Cachipo
694	267	Quiriquire
695	268	Santa Bárbara
696	269	Barrancas
697	269	Los Barrancos de Fajardo
698	270	Uracoa
699	271	Antolín del Campo
700	272	Arismendi
701	273	García
702	273	Francisco Fajardo
703	274	Bolívar
704	274	Guevara
705	274	Matasiete
706	274	Santa Ana
707	274	Sucre
708	275	Aguirre
709	275	Maneiro
710	276	Adrián
711	276	Juan Griego
712	276	Yaguaraparo
713	277	Porlamar
714	278	San Francisco de Macanao
715	278	Boca de Río
716	279	Tubores
717	279	Los Baleales
718	280	Vicente Fuentes
719	280	Villalba
720	281	San Juan Bautista
721	281	Zabala
722	283	Capital Araure
723	283	Río Acarigua
724	284	Capital Esteller
725	284	Uveral
726	285	Guanare
727	285	Córdoba
728	285	San José de la Montaña
729	285	San Juan de Guanaguanare
730	285	Virgen de la Coromoto
731	286	Guanarito
732	286	Trinidad de la Capilla
733	286	Divina Pastora
734	287	Monseñor José Vicente de Unda
735	287	Peña Blanca
736	288	Capital Ospino
737	288	Aparición
738	288	La Estación
739	289	Páez
740	289	Payara
741	289	Pimpinela
742	289	Ramón Peraza
743	290	Papelón
744	290	Caño Delgadito
745	291	San Genaro de Boconoito
746	291	Antolín Tovar
747	292	San Rafael de Onoto
748	292	Santa Fe
749	292	Thermo Morles
750	293	Santa Rosalía
751	293	Florida
752	294	Sucre
753	294	Concepción
754	294	San Rafael de Palo Alzado
755	294	Uvencio Antonio Velásquez
756	294	San José de Saguaz
757	294	Villa Rosa
758	295	Turén
759	295	Canelones
760	295	Santa Cruz
761	295	San Isidro Labrador
762	296	Mariño
763	296	Rómulo Gallegos
764	297	San José de Aerocuar
765	297	Tavera Acosta
766	298	Río Caribe
767	298	Antonio José de Sucre
768	298	El Morro de Puerto Santo
769	298	Puerto Santo
770	298	San Juan de las Galdonas
771	299	El Pilar
772	299	El Rincón
773	299	General Francisco Antonio Váquez
774	299	Guaraúnos
775	299	Tunapuicito
776	299	Unión
777	300	Santa Catalina
778	300	Santa Rosa
779	300	Santa Teresa
780	300	Bolívar
781	300	Maracapana
782	302	Libertad
783	302	El Paujil
784	302	Yaguaraparo
785	303	Cruz Salmerón Acosta
786	303	Chacopata
787	303	Manicuare
788	304	Tunapuy
789	304	Campo Elías
790	305	Irapa
791	305	Campo Claro
792	305	Maraval
793	305	San Antonio de Irapa
794	305	Soro
795	306	Mejía
796	307	Cumanacoa
797	307	Arenas
798	307	Aricagua
799	307	Cogollar
800	307	San Fernando
801	307	San Lorenzo
802	308	Villa Frontado (Muelle de Cariaco)
803	308	Catuaro
804	308	Rendón
805	308	San Cruz
806	308	Santa María
807	309	Altagracia
808	309	Santa Inés
809	309	Valentín Valiente
810	309	Ayacucho
811	309	San Juan
812	309	Raúl Leoni
813	309	Gran Mariscal
814	310	Cristóbal Colón
815	310	Bideau
816	310	Punta de Piedras
817	310	Güiria
818	341	Andrés Bello
819	342	Antonio Rómulo Costa
820	343	Ayacucho
821	343	Rivas Berti
822	343	San Pedro del Río
823	344	Bolívar
824	344	Palotal
825	344	General Juan Vicente Gómez
826	344	Isaías Medina Angarita
827	345	Cárdenas
828	345	Amenodoro Ángel Lamus
829	345	La Florida
830	346	Córdoba
831	347	Fernández Feo
832	347	Alberto Adriani
833	347	Santo Domingo
834	348	Francisco de Miranda
835	349	García de Hevia
836	349	Boca de Grita
837	349	José Antonio Páez
838	350	Guásimos
839	351	Independencia
840	351	Juan Germán Roscio
841	351	Román Cárdenas
842	352	Jáuregui
843	352	Emilio Constantino Guerrero
844	352	Monseñor Miguel Antonio Salas
845	353	José María Vargas
846	354	Junín
847	354	La Petrólea
848	354	Quinimarí
849	354	Bramón
850	355	Libertad
851	355	Cipriano Castro
852	355	Manuel Felipe Rugeles
853	356	Libertador
854	356	Doradas
855	356	Emeterio Ochoa
856	356	San Joaquín de Navay
857	357	Lobatera
858	357	Constitución
859	358	Michelena
860	359	Panamericano
861	359	La Palmita
862	360	Pedro María Ureña
863	360	Nueva Arcadia
864	361	Delicias
865	361	Pecaya
866	362	Samuel Darío Maldonado
867	362	Boconó
868	362	Hernández
869	363	La Concordia
870	363	San Juan Bautista
871	363	Pedro María Morantes
872	363	San Sebastián
873	363	Dr. Francisco Romero Lobo
874	364	Seboruco
875	365	Simón Rodríguez
876	366	Sucre
877	366	Eleazar López Contreras
878	366	San Pablo
879	367	Torbes
880	368	Uribante
881	368	Cárdenas
882	368	Juan Pablo Peñalosa
883	368	Potosí
884	369	San Judas Tadeo
885	370	Araguaney
886	370	El Jaguito
887	370	La Esperanza
888	370	Santa Isabel
889	371	Boconó
890	371	El Carmen
891	371	Mosquey
892	371	Ayacucho
893	371	Burbusay
894	371	General Ribas
895	371	Guaramacal
896	371	Vega de Guaramacal
897	371	Monseñor Jáuregui
898	371	Rafael Rangel
899	371	San Miguel
900	371	San José
901	372	Sabana Grande
902	372	Cheregüé
903	372	Granados
904	373	Arnoldo Gabaldón
905	373	Bolivia
906	373	Carrillo
907	373	Cegarra
908	373	Chejendé
909	373	Manuel Salvador Ulloa
910	373	San José
911	374	Carache
912	374	La Concepción
913	374	Cuicas
914	374	Panamericana
915	374	Santa Cruz
916	375	Escuque
917	375	La Unión
918	375	Santa Rita
919	375	Sabana Libre
920	376	El Socorro
921	376	Los Caprichos
922	376	Antonio José de Sucre
923	377	Campo Elías
924	377	Arnoldo Gabaldón
925	378	Santa Apolonia
926	378	El Progreso
927	378	La Ceiba
928	378	Tres de Febrero
929	379	El Dividive
930	379	Agua Santa
931	379	Agua Caliente
932	379	El Cenizo
933	379	Valerita
934	380	Monte Carmelo
935	380	Buena Vista
936	380	Santa María del Horcón
937	381	Motatán
938	381	El Baño
939	381	Jalisco
940	382	Pampán
941	382	Flor de Patria
942	382	La Paz
943	382	Santa Ana
944	383	Pampanito
945	383	La Concepción
946	383	Pampanito II
947	384	Betijoque
948	384	José Gregorio Hernández
949	384	La Pueblita
950	384	Los Cedros
951	385	Carvajal
952	385	Campo Alegre
953	385	Antonio Nicolás Briceño
954	385	José Leonardo Suárez
955	386	Sabana de Mendoza
956	386	Junín
957	386	Valmore Rodríguez
958	386	El Paraíso
959	387	Andrés Linares
960	387	Chiquinquirá
961	387	Cristóbal Mendoza
962	387	Cruz Carrillo
963	387	Matriz
964	387	Monseñor Carrillo
965	387	Tres Esquinas
966	388	Cabimbú
967	388	Jajó
968	388	La Mesa de Esnujaque
969	388	Santiago
970	388	Tuñame
971	388	La Quebrada
972	389	Juan Ignacio Montilla
973	389	La Beatriz
974	389	La Puerta
975	389	Mendoza del Valle de Momboy
976	389	Mercedes Díaz
977	389	San Luis
978	390	Caraballeda
979	390	Carayaca
980	390	Carlos Soublette
981	390	Caruao Chuspa
982	390	Catia La Mar
983	390	El Junko
984	390	La Guaira
985	390	Macuto
986	390	Maiquetía
987	390	Naiguatá
988	390	Urimare
989	391	Arístides Bastidas
990	392	Bolívar
991	407	Chivacoa
992	407	Campo Elías
993	408	Cocorote
994	409	Independencia
995	410	José Antonio Páez
996	411	La Trinidad
997	412	Manuel Monge
998	413	Salóm
999	413	Temerla
1000	413	Nirgua
1001	414	San Andrés
1002	414	Yaritagua
1003	415	San Javier
1004	415	Albarico
1005	415	San Felipe
1006	416	Sucre
1007	417	Urachiche
1008	418	El Guayabo
1009	418	Farriar
1010	441	Isla de Toas
1011	441	Monagas
1012	442	San Timoteo
1013	442	General Urdaneta
1014	442	Libertador
1015	442	Marcelino Briceño
1016	442	Pueblo Nuevo
1017	442	Manuel Guanipa Matos
1018	443	Ambrosio
1019	443	Carmen Herrera
1020	443	La Rosa
1021	443	Germán Ríos Linares
1022	443	San Benito
1023	443	Rómulo Betancourt
1024	443	Jorge Hernández
1025	443	Punta Gorda
1026	443	Arístides Calvani
1027	444	Encontrados
1028	444	Udón Pérez
1029	445	Moralito
1030	445	San Carlos del Zulia
1031	445	Santa Cruz del Zulia
1032	445	Santa Bárbara
1033	445	Urribarrí
1034	446	Carlos Quevedo
1035	446	Francisco Javier Pulgar
1036	446	Simón Rodríguez
1037	446	Guamo-Gavilanes
1038	448	La Concepción
1039	448	San José
1040	448	Mariano Parra León
1041	448	José Ramón Yépez
1042	449	Jesús María Semprún
1043	449	Barí
1044	450	Concepción
1045	450	Andrés Bello
1046	450	Chiquinquirá
1047	450	El Carmelo
1048	450	Potreritos
1049	451	Libertad
1050	451	Alonso de Ojeda
1051	451	Venezuela
1052	451	Eleazar López Contreras
1053	451	Campo Lara
1054	452	Bartolomé de las Casas
1055	452	Libertad
1056	452	Río Negro
1057	452	San José de Perijá
1058	453	San Rafael
1059	453	La Sierrita
1060	453	Las Parcelas
1061	453	Luis de Vicente
1062	453	Monseñor Marcos Sergio Godoy
1063	453	Ricaurte
1064	453	Tamare
1065	454	Antonio Borjas Romero
1066	454	Bolívar
1067	454	Cacique Mara
1068	454	Carracciolo Parra Pérez
1069	454	Cecilio Acosta
1070	454	Cristo de Aranza
1071	454	Coquivacoa
1072	454	Chiquinquirá
1073	454	Francisco Eugenio Bustamante
1074	454	Idelfonzo Vásquez
1075	454	Juana de Ávila
1076	454	Luis Hurtado Higuera
1077	454	Manuel Dagnino
1078	454	Olegario Villalobos
1079	454	Raúl Leoni
1080	454	Santa Lucía
1081	454	Venancio Pulgar
1082	454	San Isidro
1083	455	Altagracia
1084	455	Faría
1085	455	Ana María Campos
1086	455	San Antonio
1087	455	San José
1088	456	Donaldo García
1089	456	El Rosario
1090	456	Sixto Zambrano
1091	457	San Francisco
1092	457	El Bajo
1093	457	Domitila Flores
1094	457	Francisco Ochoa
1095	457	Los Cortijos
1096	457	Marcial Hernández
1097	458	Santa Rita
1098	458	El Mene
1099	458	Pedro Lucas Urribarrí
1100	458	José Cenobio Urribarrí
1101	459	Rafael Maria Baralt
1102	459	Manuel Manrique
1103	459	Rafael Urdaneta
1104	460	Bobures
1105	460	Gibraltar
1106	460	Heras
1107	460	Monseñor Arturo Álvarez
1108	460	Rómulo Gallegos
1109	460	El Batey
1110	461	Rafael Urdaneta
1111	461	La Victoria
1112	461	Raúl Cuenca
1113	447	Sinamaica
1114	447	Alta Guajira
1115	447	Elías Sánchez Rubio
1116	447	Guajira
1117	462	Altagracia
1118	462	Antímano
1119	462	Caricuao
1120	462	Catedral
1121	462	Coche
1122	462	El Junquito
1123	462	El Paraíso
1124	462	El Recreo
1125	462	El Valle
1126	462	La Candelaria
1127	462	La Pastora
1128	462	La Vega
1129	462	Macarao
1130	462	San Agustín
1131	462	San Bernardino
1132	462	San José
1133	462	San Juan
1134	462	San Pedro
1135	462	Santa Rosalía
1136	462	Santa Teresa
1137	462	Sucre (Catia)
1138	462	23 de enero
\.


--
-- TOC entry 2260 (class 0 OID 17384)
-- Dependencies: 194
-- Data for Name: pedido; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pedido (codpedido, descripcion, fecha_registro, visto_produccion, fecha_produccion, cod_usuario_produccion, visto_compras, fecha_compras, cod_usuario_compras, cod_usuario_registro, estatus_actual) FROM stdin;
PED6545282	{"producto":[{"cod_tipo_rubro":"2","cod_producto":"2","cantidad":"850"}]}	2017-09-11 23:03:58.372337	t	\N	\N	f	\N	\N	\N	4
\.


--
-- TOC entry 2285 (class 0 OID 0)
-- Dependencies: 195
-- Name: pedido_estatus_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('pedido_estatus_id_seq', 74, true);


--
-- TOC entry 2262 (class 0 OID 17395)
-- Dependencies: 196
-- Data for Name: region; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY region (cod_region, nombre) FROM stdin;
\.


--
-- TOC entry 2263 (class 0 OID 17398)
-- Dependencies: 197
-- Data for Name: repre_legal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY repre_legal (cedula, nombre, apellido, cod_tipcargo, tlfcelular, correo_repre) FROM stdin;
v14500747	omar	ramirrz	2	04122223647	omarg@gmail.com
\.


--
-- TOC entry 2264 (class 0 OID 17401)
-- Dependencies: 198
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rol (id, cod_rol, descripcion) FROM stdin;
3	RL03	COMPRAS
2	RL02	PRODUCCIÓN
1	RL01	UNIDAD PRODUCCION
\.


--
-- TOC entry 2265 (class 0 OID 17407)
-- Dependencies: 199
-- Data for Name: rubro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rubro (cod_rubro, cod_tipo, nombre) FROM stdin;
1	2	PIÑA
2	2	LECHOSA
4	1	TOMATE
3	2	MELON
5	1	CEBOLLA
\.


--
-- TOC entry 2266 (class 0 OID 17410)
-- Dependencies: 200
-- Data for Name: rubro_empresa; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rubro_empresa  FROM stdin;
\.


--
-- TOC entry 2255 (class 0 OID 17363)
-- Dependencies: 189
-- Data for Name: tipo_estatus; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo_estatus (cod_tipo_estatus, descripcion, siglas, cod_rol, seleccion, nombre_seleccion) FROM stdin;
4	ESPERANDO APROBACION (COMPRAS)	EA(C)	RL03	f	\N
2	PEDIDO ACEPTADO(PRODUCCION)	AP(P)	RL02	t	ENVIAR A COMPRAS
3	PEDIDO RECHAZADO	RE(P)	RL02	t	RECHAZAR PEDIDO
6	PEDIDO RECHAZADO (COMPRAS)	RE(C)	RL03	t	RECHAZAR PEDIDO
5	PEDIDO ACEPTADO (COMPRAS)	AP(C)	RL03	t	ACEPTAR PEDIDO
7	PEDIDO DEVUELTO POR PRODUCCION\n	PD(P)	RL02	t	DEVOLVER PEDIDO
1	ESPERANDO APROBACIÓN (PRODUCCIÓN)\n	EA(P)	RL01	t	ENVIAR A PRODUCCION
\.


--
-- TOC entry 2267 (class 0 OID 17413)
-- Dependencies: 201
-- Data for Name: tipo_rubro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo_rubro (cod_tipo, nombre) FROM stdin;
2	FRUTAS
1	VEGETALES
4	EMBUTIDOS
3	QUESO
\.


--
-- TOC entry 2272 (class 0 OID 17554)
-- Dependencies: 206
-- Data for Name: unidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY unidad (id, codusuario, tipo_unidad, rif, codestado, codmunicipio, codparroquia, codciudad, avenida, casa, sector, updated_at, created_at) FROM stdin;
19	US043	UNI001	J4564567	10	113	416	162	AV SAN BLAS	CASA N°5	CERCA LA PLAZA	20:08:25	20:08:25
\.


--
-- TOC entry 2286 (class 0 OID 0)
-- Dependencies: 205
-- Name: unidad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('unidad_id_seq', 19, true);


--
-- TOC entry 2270 (class 0 OID 17545)
-- Dependencies: 204
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario (id, codusuario, nombre, email, password, rol, created_at, updated_at) FROM stdin;
43	US043	SABANETA	SABANETA@GMAIL.COM	$2y$10$sAfAsif/sUKhVxEb4YK07.upQcp79ARgGGwTAbj4oLN1fX2Hj4syy	RL01	2017-10-28 20:08:25	2017-10-28 20:08:25
\.


--
-- TOC entry 2287 (class 0 OID 0)
-- Dependencies: 203
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_id_seq', 43, true);


--
-- TOC entry 2268 (class 0 OID 17419)
-- Dependencies: 202
-- Data for Name: ws_respuesta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ws_respuesta (codrespuesta, mensaje) FROM stdin;
COD_001	LOS DATOS FUERON GUARDADOS SATISFACTORIAMENTE
COD_000	RESPUESTA SATICFACTORIA
CODE_001	NO HAY DATOS GUARDADOS
COD_002	NO HAY REGISTROS EN LA BASE DE DATOS
CODE_003	ERROR DE CONEXION EN EL SERVICIO
CODE_002	LOS PARAMETROS INGRESADOS NO SON CORRECTOS
\.


--
-- TOC entry 2092 (class 2606 OID 17425)
-- Name: cargo cargo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cargo
    ADD CONSTRAINT cargo_pkey PRIMARY KEY (codtipcargo);


--
-- TOC entry 2094 (class 2606 OID 17427)
-- Name: ciudad ciudad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT ciudad_pkey PRIMARY KEY (codciudad);


--
-- TOC entry 2096 (class 2606 OID 17429)
-- Name: empresa empresa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_pkey PRIMARY KEY (cod_rif);


--
-- TOC entry 2100 (class 2606 OID 17431)
-- Name: tipo_estatus estado_ped_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_estatus
    ADD CONSTRAINT estado_ped_pkey PRIMARY KEY (cod_tipo_estatus);


--
-- TOC entry 2098 (class 2606 OID 17433)
-- Name: estado estado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estado
    ADD CONSTRAINT estado_pkey PRIMARY KEY (codestado);


--
-- TOC entry 2102 (class 2606 OID 17435)
-- Name: municipio municipio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT municipio_pkey PRIMARY KEY (codmunicipio);


--
-- TOC entry 2104 (class 2606 OID 17437)
-- Name: parroquia parroquia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parroquia
    ADD CONSTRAINT parroquia_pkey PRIMARY KEY (codparroquia);


--
-- TOC entry 2106 (class 2606 OID 17439)
-- Name: pedido pedido_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pedido
    ADD CONSTRAINT pedido_pkey PRIMARY KEY (codpedido);


--
-- TOC entry 2108 (class 2606 OID 17441)
-- Name: region region_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY region
    ADD CONSTRAINT region_pkey PRIMARY KEY (cod_region);


--
-- TOC entry 2110 (class 2606 OID 17443)
-- Name: repre_legal repre_legal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY repre_legal
    ADD CONSTRAINT repre_legal_pkey PRIMARY KEY (cedula);


--
-- TOC entry 2112 (class 2606 OID 17445)
-- Name: rol rol_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (cod_rol);


--
-- TOC entry 2114 (class 2606 OID 17447)
-- Name: rubro rubro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rubro
    ADD CONSTRAINT rubro_pkey PRIMARY KEY (cod_rubro);


--
-- TOC entry 2116 (class 2606 OID 17449)
-- Name: tipo_rubro tipo_rubro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tipo_rubro
    ADD CONSTRAINT tipo_rubro_pkey PRIMARY KEY (cod_tipo);


--
-- TOC entry 2122 (class 2606 OID 17562)
-- Name: unidad unidad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY unidad
    ADD CONSTRAINT unidad_pkey PRIMARY KEY (id);


--
-- TOC entry 2120 (class 2606 OID 17564)
-- Name: usuario usuario_codusuario_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_codusuario_key UNIQUE (codusuario);


--
-- TOC entry 2118 (class 2606 OID 17451)
-- Name: ws_respuesta ws_respuesta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ws_respuesta
    ADD CONSTRAINT ws_respuesta_pkey PRIMARY KEY (codrespuesta);


--
-- TOC entry 2123 (class 2606 OID 17452)
-- Name: ciudad ciudad_codestado_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT ciudad_codestado_fkey FOREIGN KEY (codestado) REFERENCES estado(codestado);


--
-- TOC entry 2132 (class 2606 OID 17457)
-- Name: rubro clave foranea; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rubro
    ADD CONSTRAINT "clave foranea" FOREIGN KEY (cod_tipo) REFERENCES tipo_rubro(cod_tipo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2124 (class 2606 OID 17462)
-- Name: empresa empresa_codcedula_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_codcedula_fkey FOREIGN KEY (codcedula) REFERENCES repre_legal(cedula);


--
-- TOC entry 2125 (class 2606 OID 17467)
-- Name: empresa empresa_codciudad_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_codciudad_fkey FOREIGN KEY (codciudad) REFERENCES ciudad(codciudad);


--
-- TOC entry 2126 (class 2606 OID 17472)
-- Name: empresa empresa_codestado_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_codestado_fkey FOREIGN KEY (codestado) REFERENCES estado(codestado);


--
-- TOC entry 2127 (class 2606 OID 17477)
-- Name: empresa empresa_codmunicipio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_codmunicipio_fkey FOREIGN KEY (codmunicipio) REFERENCES municipio(codmunicipio);


--
-- TOC entry 2128 (class 2606 OID 17482)
-- Name: empresa empresa_codparroquia_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY empresa
    ADD CONSTRAINT empresa_codparroquia_fkey FOREIGN KEY (codparroquia) REFERENCES parroquia(codparroquia);


--
-- TOC entry 2130 (class 2606 OID 17487)
-- Name: municipio municipio_codestado_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT municipio_codestado_fkey FOREIGN KEY (codestado) REFERENCES estado(codestado);


--
-- TOC entry 2131 (class 2606 OID 17492)
-- Name: parroquia parroquia_codmunicipio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY parroquia
    ADD CONSTRAINT parroquia_codmunicipio_fkey FOREIGN KEY (codmunicipio) REFERENCES municipio(codmunicipio);


--
-- TOC entry 2129 (class 2606 OID 17497)
-- Name: estatus pedido_estatus_cod_tipo_estatus_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estatus
    ADD CONSTRAINT pedido_estatus_cod_tipo_estatus_fkey FOREIGN KEY (cod_tipo_estatus) REFERENCES tipo_estatus(cod_tipo_estatus);


--
-- TOC entry 2133 (class 2606 OID 17566)
-- Name: unidad unidad_codusuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY unidad
    ADD CONSTRAINT unidad_codusuario_fkey FOREIGN KEY (codusuario) REFERENCES usuario(codusuario);


-- Completed on 2018-01-30 20:34:59

--
-- PostgreSQL database dump complete
--
