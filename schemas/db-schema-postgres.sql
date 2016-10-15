SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET search_path = public, pg_catalog;
SET default_tablespace = '';
SET default_with_oids = false;
CREATE TABLE job_new (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(100) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.job_new OWNER TO USERNAME;
CREATE TABLE job_id_user (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(100) DEFAULT 'undefined'::character varying NOT NULL,
    id_status character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    dt_created character varying(50) DEFAULT ''::character varying NOT NULL,
    dt_modified  character varying(50) DEFAULT ''::character varying NOT NULL,
    dt_done character varying(50) DEFAULT ''::character varying NOT NULL,
    str_rqdata character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_response character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_output character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_ad character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    int_try character varying(7) DEFAULT '0'::character varying NOT NULL
);
ALTER TABLE public.job_id_user OWNER TO USERNAME;
CREATE TABLE match_custom (
    id_expr character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    idx_key character varying(40) DEFAULT 'undefined'::character varying NOT NULL,
    str_txt character varying(40) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.match_custom OWNER TO USERNAME;
CREATE TABLE match_entry (
    id_expr character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    idx_id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_entry_type character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_entry_subtype character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    int_order character varying(11) DEFAULT ''::character varying NOT NULL
);
ALTER TABLE public.match_entry OWNER TO USERNAME;
CREATE TABLE me_setting (
    id_me character varying(120) DEFAULT 'undefined'::character varying NOT NULL,
    name character varying(255) DEFAULT 'undefined'::character varying NOT NULL,
    str_value character varying(500) DEFAULT ''::character varying NOT NULL
);
ALTER TABLE public.me_setting OWNER TO USERNAME;
CREATE TABLE ph_child (
    id_child_job character varying(100) DEFAULT 'undefined'::character varying NOT NULL,
    id_parent_job character varying(100) DEFAULT 'undefined'::character varying NOT NULL,
    placeholder character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.ph_child OWNER TO USERNAME;
CREATE TABLE ph_parent (
    id_parent_job character varying(100) DEFAULT 'undefined'::character varying NOT NULL,
    id_child_job character varying(100) DEFAULT 'undefined'::character varying NOT NULL,
    placeholder character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.ph_parent OWNER TO USERNAME;
CREATE TABLE hfp_vcs (
    id_hf_parameter character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_constraint_type character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_constraint_text character varying(300) DEFAULT ''::character varying NOT NULL
);
ALTER TABLE public.hfp_vcs OWNER TO USERNAME;
CREATE TABLE hf_file (
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_file character varying(600) DEFAULT 'undefined'::character varying NOT NULL,
    str_targetfile character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.hf_file OWNER TO USERNAME;
CREATE TABLE hf_kill (
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_name character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.hf_kill OWNER TO USERNAME;
CREATE TABLE hf_node_filter (
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_filter character varying(255) DEFAULT ''::character varying NOT NULL
);
ALTER TABLE public.hf_node_filter OWNER TO USERNAME;
CREATE TABLE hf_parameter (
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    keyword character varying(200) DEFAULT ''::character varying NOT NULL,
    parameter_name character varying(200) DEFAULT ''::character varying NOT NULL,
    str_default_value character varying(50) DEFAULT ''::character varying NOT NULL,
    int_preserve_encode character varying(2) DEFAULT '0'::character varying NOT NULL,
    int_mandatory character varying(1) DEFAULT '0'::character varying NOT NULL,
    int_immutable character varying(1) DEFAULT '0'::character varying NOT NULL
);
ALTER TABLE public.hf_parameter OWNER TO USERNAME;
CREATE TABLE hf_tag (
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_tag character varying(50) DEFAULT ''::character varying NOT NULL
);
ALTER TABLE public.hf_tag OWNER TO USERNAME;
CREATE TABLE hf_id_user (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    name character varying(300) DEFAULT 'undefined'::character varying NOT NULL,
    str_expression character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_condition character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_cache_out_xml character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_cache_out_cxml character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_cache_approved character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_cache_latest character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_cache_ad character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_mime_type character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    int_ws character varying(2) DEFAULT '0'::character varying NOT NULL,
    int_wait character varying(1) DEFAULT '0'::character varying NOT NULL,
    int_cleanup character varying(1) DEFAULT '1'::character varying NOT NULL,
    int_maxruntime character varying(8) DEFAULT '0'::character varying NOT NULL,
    int_mtf character varying(8) DEFAULT '1'::character varying NOT NULL,
    int_retry_count character varying(8) DEFAULT '0'::character varying NOT NULL,
    str_fastresponse character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.hf_id_user OWNER TO USERNAME;
CREATE TABLE strings (
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    val character varying(600) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.strings OWNER TO USERNAME;
CREATE TABLE user_server (
    id_user character varying(40) DEFAULT 'undefined'::character varying NOT NULL,
    name character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    last_ping character varying(20) DEFAULT 'undefined'::character varying NOT NULL,
    force_restart character varying(2) DEFAULT '0'::character varying NOT NULL,
    str_log character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    ip_address character varying(25) DEFAULT 'undefined'::character varying NOT NULL,
    id_sk character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    int_routable character varying(1) DEFAULT '0'::character varying NOT NULL,
    is_busy character varying(1) DEFAULT '0'::character varying NOT NULL,
    int_online character varying(1) DEFAULT '1'::character varying NOT NULL,
    software_version character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.user_server OWNER TO USERNAME;
CREATE TABLE user_id_user (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    user_name character varying(250) DEFAULT ''::character varying NOT NULL,
    email character varying(100) DEFAULT ''::character varying NOT NULL,
    pw character varying(50) DEFAULT ''::character varying NOT NULL,
    secret character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    lang character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.user_id_user OWNER TO USERNAME;
CREATE TABLE user_user_name (
    user_name character varying(250) DEFAULT ''::character varying NOT NULL,
    email character varying(100) DEFAULT ''::character varying NOT NULL,
    pw character varying(50) DEFAULT ''::character varying NOT NULL,
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    secret character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    lang character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.user_user_name OWNER TO USERNAME;
ALTER TABLE ONLY job_new ADD CONSTRAINT job_new_pkey PRIMARY KEY (id_user, id);
ALTER TABLE ONLY job_id_user ADD CONSTRAINT job_id_user_pkey PRIMARY KEY (id_user, id);
ALTER TABLE ONLY match_custom ADD CONSTRAINT match_custom_pkey PRIMARY KEY (id_expr, idx_key);
ALTER TABLE ONLY match_entry ADD CONSTRAINT match_entry_pkey PRIMARY KEY (id_expr, idx_id);
ALTER TABLE ONLY me_setting ADD CONSTRAINT me_setting_pkey PRIMARY KEY (id_me, name);
ALTER TABLE ONLY ph_child ADD CONSTRAINT ph_child_pkey PRIMARY KEY (id_child_job, id_parent_job);
ALTER TABLE ONLY ph_parent ADD CONSTRAINT ph_parent_pkey PRIMARY KEY (id_parent_job, id_child_job);
ALTER TABLE ONLY hfp_vcs ADD CONSTRAINT hfp_vcs_pkey PRIMARY KEY (id_hf_parameter, id);
ALTER TABLE ONLY hf_file ADD CONSTRAINT hf_file_pkey PRIMARY KEY (id_hf, id);
ALTER TABLE ONLY hf_kill ADD CONSTRAINT hf_kill_pkey PRIMARY KEY (id_hf, id);
ALTER TABLE ONLY hf_node_filter ADD CONSTRAINT hf_node_filter_pkey PRIMARY KEY (id_hf, id);
ALTER TABLE ONLY hf_parameter ADD CONSTRAINT hf_parameter_pkey PRIMARY KEY (id_hf, id);
ALTER TABLE ONLY hf_tag ADD CONSTRAINT hf_tag_pkey PRIMARY KEY (id_hf, id);
ALTER TABLE ONLY hf_id_user ADD CONSTRAINT hf_id_user_pkey PRIMARY KEY (id_user, id);
ALTER TABLE ONLY strings ADD CONSTRAINT strings_pkey PRIMARY KEY (id);
ALTER TABLE ONLY user_server ADD CONSTRAINT user_server_pkey PRIMARY KEY (id_user, name);
ALTER TABLE ONLY user_id_user ADD CONSTRAINT user_id_user_pkey PRIMARY KEY (id_user);
ALTER TABLE ONLY user_user_name ADD CONSTRAINT user_user_name_pkey PRIMARY KEY (user_name);


CREATE TABLE hf_resource (
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_location character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    str_filename character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.hf_resource OWNER TO USERNAME;
ALTER TABLE ONLY hf_resource ADD CONSTRAINT hf_resource_pkey PRIMARY KEY (id_hf, id);

CREATE TABLE user_inherit (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.user_inherit OWNER TO USERNAME;
ALTER TABLE ONLY user_inherit ADD CONSTRAINT user_inherit_pkey PRIMARY KEY (id_user, id_hf);

CREATE TABLE hf_system_kind (
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_sk character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.hf_system_kind OWNER TO USERNAME;
ALTER TABLE ONLY hf_system_kind ADD CONSTRAINT hf_system_kind_pkey PRIMARY KEY (id_hf, id);

CREATE TABLE hfr_system_kind (
    id_resource character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_sk character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.hfr_system_kind OWNER TO USERNAME;
ALTER TABLE ONLY hfr_system_kind ADD CONSTRAINT hfr_system_kind_pkey PRIMARY KEY (id_resource, id);

CREATE TABLE user_system_kind (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    name character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    detection_text character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.user_system_kind OWNER TO USERNAME;
ALTER TABLE ONLY user_system_kind ADD CONSTRAINT user_system_kind_pkey PRIMARY KEY (id_user, id);

CREATE TABLE hf_inherit (
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_inherit character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.hf_inherit OWNER TO USERNAME;
ALTER TABLE ONLY hf_inherit ADD CONSTRAINT hf_inherit_pkey PRIMARY KEY (id_hf, id);


CREATE TABLE sys_setting (
    category character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    param character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    val character varying(50) DEFAULT ''::character varying NOT NULL
);
ALTER TABLE public.sys_setting OWNER TO USERNAME;
ALTER TABLE ONLY sys_setting ADD CONSTRAINT sys_setting_pkey PRIMARY KEY (category, param);

CREATE TABLE user_server_service (
    id_user_server character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    service_name character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    service_enabled character varying(1) DEFAULT '0'::character varying NOT NULL
);
ALTER TABLE public.user_server_service OWNER TO USERNAME;
ALTER TABLE ONLY user_server_service ADD CONSTRAINT user_server_service_pkey PRIMARY KEY (id_user_server, service_name);

CREATE TABLE hfp_hf (
    parameter_name character varying(100) DEFAULT 'undefined'::character varying NOT NULL,
    id_hf character varying(50) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.hfp_hf OWNER TO USERNAME;
ALTER TABLE ONLY hfp_hf ADD CONSTRAINT hfp_hf_pkey PRIMARY KEY (parameter_name, id_hf);

CREATE TABLE assign_hf (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    hf_server character varying(100) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.assign_hf OWNER TO USERNAME;
ALTER TABLE ONLY assign_hf ADD CONSTRAINT assign_hf_pkey PRIMARY KEY (id_user, hf_server);

CREATE TABLE assign_server (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    server_hf character varying(100) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.assign_server OWNER TO USERNAME;
ALTER TABLE ONLY assign_server ADD CONSTRAINT assign_server_pkey PRIMARY KEY (id_user, server_hf);

CREATE TABLE job_flag (
    id_job character varying(100) DEFAULT 'undefined'::character varying NOT NULL,
    flag character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    status character varying(100) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.job_flag OWNER TO USERNAME;
ALTER TABLE ONLY job_flag ADD CONSTRAINT job_flag_pkey PRIMARY KEY (id_job, flag);

CREATE TABLE job_status (
    id_user character varying(50) DEFAULT 'undefined'::character varying NOT NULL,
    id_status_job character varying(100) DEFAULT 'undefined'::character varying NOT NULL
);
ALTER TABLE public.job_status OWNER TO USERNAME;
ALTER TABLE ONLY job_status ADD CONSTRAINT job_status_pkey PRIMARY KEY (id_user, id_status_job);


