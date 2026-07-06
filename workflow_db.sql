--
-- PostgreSQL database dump
--

\restrict zarzj7Snsbe0u1NeQED7QhEBaRJUXZQVAdwas45TloOoDzLbffAAbpjZYHn53aQ

-- Dumped from database version 16.11
-- Dumped by pg_dump version 16.11

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
-- Name: forms; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.forms (
    id integer NOT NULL,
    form_name character varying(100),
    created_by integer,
    manager_id integer,
    status_id integer,
    remarks text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.forms OWNER TO postgres;

--
-- Name: forms_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.forms_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.forms_id_seq OWNER TO postgres;

--
-- Name: forms_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.forms_id_seq OWNED BY public.forms.id;


--
-- Name: leave_form; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.leave_form (
    id integer NOT NULL,
    form_id integer,
    leave_from date,
    leave_to date,
    reason text
);


ALTER TABLE public.leave_form OWNER TO postgres;

--
-- Name: leave_form_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.leave_form_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.leave_form_id_seq OWNER TO postgres;

--
-- Name: leave_form_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.leave_form_id_seq OWNED BY public.leave_form.id;


--
-- Name: menus; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.menus (
    id integer NOT NULL,
    menu_name character varying(100),
    menu_key character varying(100),
    display_order integer,
    is_active boolean DEFAULT true
);


ALTER TABLE public.menus OWNER TO postgres;

--
-- Name: menus_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.menus_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.menus_id_seq OWNER TO postgres;

--
-- Name: menus_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.menus_id_seq OWNED BY public.menus.id;


--
-- Name: role_menu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role_menu (
    id integer NOT NULL,
    role_id integer,
    menu_id integer
);


ALTER TABLE public.role_menu OWNER TO postgres;

--
-- Name: role_menu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.role_menu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.role_menu_id_seq OWNER TO postgres;

--
-- Name: role_menu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.role_menu_id_seq OWNED BY public.role_menu.id;


--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id integer NOT NULL,
    role_name character varying(50) NOT NULL
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.roles_id_seq OWNER TO postgres;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: status; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.status (
    id integer NOT NULL,
    status_name character varying(50),
    sequence_no integer
);


ALTER TABLE public.status OWNER TO postgres;

--
-- Name: status_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.status_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.status_id_seq OWNER TO postgres;

--
-- Name: status_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.status_id_seq OWNED BY public.status.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255) NOT NULL,
    full_name character varying(100),
    role_id integer,
    manager_id integer,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: workflow_history; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.workflow_history (
    id integer NOT NULL,
    form_id integer,
    action_by integer,
    old_status integer,
    new_status integer,
    remarks text,
    action_date timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.workflow_history OWNER TO postgres;

--
-- Name: workflow_history_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.workflow_history_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.workflow_history_id_seq OWNER TO postgres;

--
-- Name: workflow_history_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.workflow_history_id_seq OWNED BY public.workflow_history.id;


--
-- Name: forms id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.forms ALTER COLUMN id SET DEFAULT nextval('public.forms_id_seq'::regclass);


--
-- Name: leave_form id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leave_form ALTER COLUMN id SET DEFAULT nextval('public.leave_form_id_seq'::regclass);


--
-- Name: menus id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menus ALTER COLUMN id SET DEFAULT nextval('public.menus_id_seq'::regclass);


--
-- Name: role_menu id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_menu ALTER COLUMN id SET DEFAULT nextval('public.role_menu_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: status id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.status ALTER COLUMN id SET DEFAULT nextval('public.status_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: workflow_history id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow_history ALTER COLUMN id SET DEFAULT nextval('public.workflow_history_id_seq'::regclass);


--
-- Data for Name: forms; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.forms (id, form_name, created_by, manager_id, status_id, remarks, created_at, updated_at) FROM stdin;
2	Leave	3	\N	2	\N	2026-07-02 20:49:11.829915	2026-07-05 13:59:28.37244
6	Leave	3	\N	2	\N	2026-07-02 22:06:10.915971	2026-07-05 14:35:01.628642
8	Leave	1	3	5	inSufficient Reason	2026-07-05 14:35:41.343442	2026-07-05 14:41:57.597034
5	Leave	1	3	4	Approved by Admin	2026-07-02 22:04:46.619829	2026-07-06 17:22:04.499604
1	Leave	3	\N	2	\N	2026-07-02 20:46:36.769716	2026-07-06 17:27:56.296336
9	Leave	1	3	4	Approved by Admin	2026-07-05 14:54:56.364743	2026-07-06 17:33:11.148907
10	Leave	1	3	4	Approved by Admin	2026-07-06 17:32:23.915254	2026-07-06 17:33:15.475204
11	Leave	1	3	3	Approved by Manager	2026-07-06 17:49:18.370117	2026-07-06 17:52:48.66795
\.


--
-- Data for Name: leave_form; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.leave_form (id, form_id, leave_from, leave_to, reason) FROM stdin;
1	1	\N	\N	\N
2	2	2026-07-01	2026-07-02	Leave for Medical
3	5	2026-07-09	2026-08-01	Medical
4	6	2026-07-02	2026-07-23	Medical Leave
5	8	2026-07-05	2026-07-16	Vacation
6	9	2026-07-06	2026-07-24	Medical 
7	10	2026-07-06	2026-07-08	Heavy Rain
8	11	2026-07-15	2026-07-17	Heavy Rain Fall
\.


--
-- Data for Name: menus; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.menus (id, menu_name, menu_key, display_order, is_active) FROM stdin;
1	My Forms	my_forms	1	t
2	Team Approval	team_approval	2	t
3	Pending Approval	admin_approval	3	t
\.


--
-- Data for Name: role_menu; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.role_menu (id, role_id, menu_id) FROM stdin;
1	1	1
2	2	1
3	2	2
4	3	3
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles (id, role_name) FROM stdin;
1	Employee
2	Manager
3	Admin
\.


--
-- Data for Name: status; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.status (id, status_name, sequence_no) FROM stdin;
1	Draft	1
2	Manager Pending	2
3	Admin Pending	3
4	Approved	4
5	Rejected	5
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, username, password, full_name, role_id, manager_id, created_at) FROM stdin;
1	employee	123	Rahul	1	3	2026-07-01 20:02:56.950277
2	employee2	123	Aman	1	3	2026-07-01 20:02:56.950277
3	manager	123	Vikas	2	\N	2026-07-01 20:02:56.950277
4	admin	123	Administrator	3	\N	2026-07-01 20:02:56.950277
\.


--
-- Data for Name: workflow_history; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.workflow_history (id, form_id, action_by, old_status, new_status, remarks, action_date) FROM stdin;
1	5	4	3	4	Approved by Admin	2026-07-06 17:22:04.611603
2	10	3	2	3	Approved by Manager	2026-07-06 17:32:53.313229
3	9	4	3	4	Approved by Admin	2026-07-06 17:33:11.170135
4	10	4	3	4	Approved by Admin	2026-07-06 17:33:15.492959
5	11	1	1	2	Submitted by Employee	2026-07-06 17:49:34.503342
6	11	3	2	3	Approved by Manager	2026-07-06 17:52:48.686837
\.


--
-- Name: forms_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.forms_id_seq', 11, true);


--
-- Name: leave_form_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.leave_form_id_seq', 8, true);


--
-- Name: menus_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.menus_id_seq', 3, true);


--
-- Name: role_menu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.role_menu_id_seq', 4, true);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_id_seq', 3, true);


--
-- Name: status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.status_id_seq', 5, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 4, true);


--
-- Name: workflow_history_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.workflow_history_id_seq', 6, true);


--
-- Name: forms forms_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.forms
    ADD CONSTRAINT forms_pkey PRIMARY KEY (id);


--
-- Name: leave_form leave_form_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leave_form
    ADD CONSTRAINT leave_form_pkey PRIMARY KEY (id);


--
-- Name: menus menus_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.menus
    ADD CONSTRAINT menus_pkey PRIMARY KEY (id);


--
-- Name: role_menu role_menu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_menu
    ADD CONSTRAINT role_menu_pkey PRIMARY KEY (id);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: roles roles_role_name_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_role_name_key UNIQUE (role_name);


--
-- Name: status status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.status
    ADD CONSTRAINT status_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- Name: workflow_history workflow_history_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow_history
    ADD CONSTRAINT workflow_history_pkey PRIMARY KEY (id);


--
-- Name: forms forms_created_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.forms
    ADD CONSTRAINT forms_created_by_fkey FOREIGN KEY (created_by) REFERENCES public.users(id);


--
-- Name: forms forms_manager_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.forms
    ADD CONSTRAINT forms_manager_id_fkey FOREIGN KEY (manager_id) REFERENCES public.users(id);


--
-- Name: forms forms_status_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.forms
    ADD CONSTRAINT forms_status_id_fkey FOREIGN KEY (status_id) REFERENCES public.status(id);


--
-- Name: leave_form leave_form_form_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.leave_form
    ADD CONSTRAINT leave_form_form_id_fkey FOREIGN KEY (form_id) REFERENCES public.forms(id);


--
-- Name: role_menu role_menu_menu_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_menu
    ADD CONSTRAINT role_menu_menu_id_fkey FOREIGN KEY (menu_id) REFERENCES public.menus(id);


--
-- Name: role_menu role_menu_role_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_menu
    ADD CONSTRAINT role_menu_role_id_fkey FOREIGN KEY (role_id) REFERENCES public.roles(id);


--
-- Name: users users_manager_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_manager_id_fkey FOREIGN KEY (manager_id) REFERENCES public.users(id);


--
-- Name: users users_role_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_role_id_fkey FOREIGN KEY (role_id) REFERENCES public.roles(id);


--
-- Name: workflow_history workflow_history_action_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow_history
    ADD CONSTRAINT workflow_history_action_by_fkey FOREIGN KEY (action_by) REFERENCES public.users(id);


--
-- Name: workflow_history workflow_history_form_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow_history
    ADD CONSTRAINT workflow_history_form_id_fkey FOREIGN KEY (form_id) REFERENCES public.forms(id);


--
-- Name: workflow_history workflow_history_new_status_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow_history
    ADD CONSTRAINT workflow_history_new_status_fkey FOREIGN KEY (new_status) REFERENCES public.status(id);


--
-- Name: workflow_history workflow_history_old_status_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.workflow_history
    ADD CONSTRAINT workflow_history_old_status_fkey FOREIGN KEY (old_status) REFERENCES public.status(id);


--
-- PostgreSQL database dump complete
--

\unrestrict zarzj7Snsbe0u1NeQED7QhEBaRJUXZQVAdwas45TloOoDzLbffAAbpjZYHn53aQ

