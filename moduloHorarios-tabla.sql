-- Name: salones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE salones (
    id integer NOT NULL,
    salon character varying,
    cod_edi integer NOT NULL,
    tipo text
);


ALTER TABLE salones OWNER TO postgres;

--
-- Name: salones_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE salones_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE salones_id_seq OWNER TO postgres;

--
-- Name: salones_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE salones_id_seq OWNED BY salones.id;


--
-- Name: horario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE horario (
    id_enlace character varying NOT NULL,
    periodo integer NOT NULL,
    thora character varying,
    chora character varying,
    seccion integer NOT NULL,
    materia character varying,
    profesor integer NOT NULL,
    carrera integer NOT NULL,
    salon integer,
    hora integer,
    id_bloque integer,
    id integer DEFAULT nextval('salones_id_seq'::regclass)
);


ALTER TABLE horario OWNER TO postgres;

--
-- Name: malla; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE malla (
    id text NOT NULL,
    fecha date NOT NULL
);

--
-- Name: edificio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE edificio (
    id integer NOT NULL,
    edificio character varying,
    id_sede integer NOT NULL
);


ALTER TABLE edificio OWNER TO postgres;

--
-- Name: edificio_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE edificio_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE edificio_id_seq OWNER TO postgres;

--
-- Name: edificio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE edificio_id_seq OWNED BY edificio.id;


