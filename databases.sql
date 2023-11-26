CREATE DATABASE facilposPrueba;

CREATE TABLE IF NOT EXISTS public.genders
(
    id bigint NOT NULL,
    name character varying(255) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT genders_pkey PRIMARY KEY (id),
    CONSTRAINT genders_name_unique UNIQUE (name)
);

CREATE TABLE IF NOT EXISTS public.movies
(
    id bigint NOT NULL,
    name character varying(255) COLLATE pg_catalog."default" NOT NULL,
    lenguage character varying(255) COLLATE pg_catalog."default",
    title character varying(255) COLLATE pg_catalog."default",
    summary text COLLATE pg_catalog."default",
    poster character varying(255) COLLATE pg_catalog."default",
    CONSTRAINT movies_pkey PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS public.movies_genders
(
    id bigint NOT NULL,
    movie_id bigint NOT NULL,
    gender_id bigint NOT NULL,
    CONSTRAINT movies_genders_pkey PRIMARY KEY (id),
    CONSTRAINT movies_genders_movie_id_gender_id_unique UNIQUE (movie_id, gender_id),
    CONSTRAINT movies_genders_gender_id_foreign FOREIGN KEY (gender_id)
        REFERENCES public.genders (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE,
    CONSTRAINT movies_genders_movie_id_foreign FOREIGN KEY (movie_id)
        REFERENCES public.movies (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE CASCADE
);
