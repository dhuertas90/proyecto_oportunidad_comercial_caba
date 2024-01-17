--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.19
-- Dumped by pg_dump version 9.5.19

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: dim_lugar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dim_lugar (
    lugar_pk bigint NOT NULL,
    version integer,
    date_from timestamp without time zone,
    date_to timestamp without time zone,
    zona_id smallint,
    nombre character varying(50),
    poblacion integer
);


ALTER TABLE public.dim_lugar OWNER TO postgres;

--
-- Name: dim_lugar_lugar_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dim_lugar_lugar_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dim_lugar_lugar_pk_seq OWNER TO postgres;

--
-- Name: dim_lugar_lugar_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dim_lugar_lugar_pk_seq OWNED BY public.dim_lugar.lugar_pk;


--
-- Name: dim_rubro; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dim_rubro (
    rubro_pk bigint NOT NULL,
    version integer,
    date_from timestamp without time zone,
    date_to timestamp without time zone,
    rubro character varying(25)
);


ALTER TABLE public.dim_rubro OWNER TO postgres;

--
-- Name: dim_rubro_rubro_pk_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dim_rubro_rubro_pk_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dim_rubro_rubro_pk_seq OWNER TO postgres;

--
-- Name: dim_rubro_rubro_pk_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dim_rubro_rubro_pk_seq OWNED BY public.dim_rubro.rubro_pk;


--
-- Name: dim_tiempo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dim_tiempo (
    mes_ini smallint,
    mes_fin smallint,
    cuatrimestre smallint,
    anio smallint,
    periodo character varying(12),
    periodo_id integer
);


ALTER TABLE public.dim_tiempo OWNER TO postgres;

--
-- Name: h_movimiento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.h_movimiento (
    nivel_riesgo bigint,
    aperturas bigint,
    cierres bigint,
    lugar_pk integer,
    rubro_pk integer,
    poblacion integer,
    periodo_id character varying(12)
);


ALTER TABLE public.h_movimiento OWNER TO postgres;

--
-- Name: lugar_pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dim_lugar ALTER COLUMN lugar_pk SET DEFAULT nextval('public.dim_lugar_lugar_pk_seq'::regclass);


--
-- Name: rubro_pk; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dim_rubro ALTER COLUMN rubro_pk SET DEFAULT nextval('public.dim_rubro_rubro_pk_seq'::regclass);


--
-- Name: idx_dim_lugar_lookup; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_dim_lugar_lookup ON public.dim_lugar USING btree (zona_id, nombre);


--
-- Name: idx_dim_lugar_tk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_dim_lugar_tk ON public.dim_lugar USING btree (lugar_pk);


--
-- Name: idx_dim_rubro_lookup; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_dim_rubro_lookup ON public.dim_rubro USING btree (rubro);


--
-- Name: idx_dim_rubro_tk; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_dim_rubro_tk ON public.dim_rubro USING btree (rubro_pk);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

