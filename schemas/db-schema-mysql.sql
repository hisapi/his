CREATE TABLE IF NOT EXISTS user_server (
  `id_user` varchar(40) NOT NULL DEFAULT 'undefined',
  `name` varchar(50) NOT NULL DEFAULT 'undefined',
  last_ping varchar(20) NOT NULL DEFAULT 'undefined',
  force_restart varchar(2) NOT NULL DEFAULT '0',
  str_log varchar(50) NOT NULL DEFAULT 'undefined',
  ip_address varchar(25) NOT NULL DEFAULT 'undefined',
  id_sk varchar(50) NOT NULL DEFAULT 'undefined',
  int_routable varchar(1) NOT NULL DEFAULT '0',
  is_busy varchar(1) NOT NULL DEFAULT '0',
  is_try varchar(3) NOT NULL DEFAULT '0',
  int_online varchar(1) NOT NULL DEFAULT '1',
  software_version varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_user`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS job_new(
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(100) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_user,id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS job_id_user  (
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(100) NOT NULL DEFAULT 'undefined',
  id_status varchar(50) NOT NULL DEFAULT 'undefined',
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  dt_created varchar(50) NOT NULL DEFAULT 'undefined',
  dt_modified  varchar(50) NOT NULL DEFAULT 'undefined',
  dt_done varchar(50) NOT NULL DEFAULT 'undefined',
  str_rqdata varchar(50) NOT NULL DEFAULT 'undefined',
  str_response varchar(50) NOT NULL DEFAULT 'undefined',
  str_output varchar(50) NOT NULL DEFAULT 'undefined',
  str_ad varchar(50) NOT NULL DEFAULT 'undefined',
  int_try varchar(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (id_user,id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS match_custom (
  id_expr varchar(50) NOT NULL DEFAULT 'undefined',
  idx_key varchar(40) NOT NULL DEFAULT 'undefined',
  str_txt varchar(40) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_expr,idx_key)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS match_entry (
  id_expr varchar(50) NOT NULL DEFAULT 'undefined',
  idx_id varchar(50) NOT NULL DEFAULT 'undefined',
  id_entry_type varchar(50) NOT NULL DEFAULT 'undefined',
  id_entry_subtype varchar(50) NOT NULL DEFAULT 'undefined',
  int_order varchar(11) NOT NULL,
  PRIMARY KEY (id_expr,idx_id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS me_setting (
  id_me varchar(120) NOT NULL DEFAULT 'undefined',
  `name` varchar(255) NOT NULL DEFAULT 'undefined',
  str_value varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (id_me,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS ph_child;
CREATE TABLE IF NOT EXISTS ph_child (
  id_child_job varchar(100) NOT NULL DEFAULT 'undefined',
  id_parent_job varchar(100) NOT NULL DEFAULT 'undefined',
  placeholder varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_child_job,id_parent_job)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS ph_parent (
  id_parent_job varchar(100) NOT NULL DEFAULT 'undefined',
  id_child_job varchar(100) NOT NULL DEFAULT 'undefined',
  placeholder varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_parent_job,id_child_job)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS hfp_vcs (
  id_hf_parameter varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  id_constraint_type varchar(50) NOT NULL DEFAULT 'undefined',
  str_constraint_text varchar(300) NOT NULL DEFAULT '',
  PRIMARY KEY (id_hf_parameter,id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS hf_file (
  id_hf varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'undefined',
  id varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'undefined',
  str_file varchar(600) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'undefined',
  str_targetfile varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_hf,id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS hf_kill (
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  str_name varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_hf,id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS hf_node_filter (
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  str_filter varchar(255) NOT NULL,
  PRIMARY KEY (id_hf,id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS hf_parameter (
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  keyword varchar(200) NOT NULL DEFAULT '',
  parameter_name varchar(200) NOT NULL DEFAULT '',
  str_default_value varchar(50) NOT NULL DEFAULT '',
  int_preserve_encode varchar(2) NOT NULL DEFAULT '0',
  int_mandatory varchar(1) NOT NULL DEFAULT '0',
  int_immutable varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id_hf,id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS hf_tag (
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  str_tag varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (id_hf,id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS hf_id_user (
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  `name` varchar(300) NOT NULL DEFAULT 'undefined',
  str_expression varchar(50) NOT NULL DEFAULT 'undefined',
  id_condition varchar(50) NOT NULL DEFAULT 'undefined',
  str_cache_out_xml varchar(50) NOT NULL DEFAULT 'undefined',
  str_cache_out_cxml varchar(50) NOT NULL DEFAULT 'undefined',
  str_cache_approved varchar(50) NOT NULL DEFAULT 'undefined',
  str_cache_latest varchar(50) NOT NULL DEFAULT 'undefined',
  str_cache_ad varchar(50) NOT NULL DEFAULT 'undefined',
  id_mime_type varchar(50) NOT NULL DEFAULT 'undefined',
  int_ws varchar(2) NOT NULL DEFAULT '0',
  int_wait varchar(1) NOT NULL DEFAULT '0',
  int_cleanup varchar(1) NOT NULL DEFAULT '1',
  int_maxruntime varchar(8) NOT NULL DEFAULT '0',
  int_mtf varchar(8) NOT NULL DEFAULT '1',
  int_retry_count varchar(8) NOT NULL DEFAULT '0',
  str_fastresponse varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_user,id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS strings (
  id varchar(50) NOT NULL DEFAULT 'undefined',
  val varchar(600) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS user_id_user (
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  user_name varchar(250) NOT NULL DEFAULT '',
  email varchar(100) NOT NULL,
  pw varchar(50) NOT NULL DEFAULT '',
  secret varchar(50) NOT NULL DEFAULT 'undefined',
  lang varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_user)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS user_user_name (
  user_name varchar(250) NOT NULL DEFAULT '',
  email varchar(100) NOT NULL,
  pw varchar(50) NOT NULL DEFAULT '',
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  secret varchar(50) NOT NULL DEFAULT 'undefined',
  lang varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (user_name)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS hf_resource;
CREATE TABLE IF NOT EXISTS hf_resource (
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  str_location varchar(50) NOT NULL DEFAULT 'undefined',
  str_filename varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_hf,id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS user_inherit;
CREATE TABLE IF NOT EXISTS user_inherit (
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_user,id_hf)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS hfr_system_kind;
CREATE TABLE IF NOT EXISTS hfr_system_kind (
  id_resource varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  id_sk varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_resource,id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS hf_system_kind;
CREATE TABLE IF NOT EXISTS hf_system_kind (
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  id_sk varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_hf,id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS user_system_kind;
CREATE TABLE IF NOT EXISTS user_system_kind (
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  name varchar(50) NOT NULL DEFAULT 'undefined',
  detection_text varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_user,id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS hf_inherit;
CREATE TABLE IF NOT EXISTS hf_inherit (
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  id varchar(50) NOT NULL DEFAULT 'undefined',
  id_inherit varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_hf,id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS sys_setting;
CREATE TABLE IF NOT EXISTS sys_setting (
  category varchar(50) NOT NULL DEFAULT 'undefined',
  param varchar(50) NOT NULL DEFAULT 'undefined',
  val varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (category,param)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS user_server_service;
CREATE TABLE IF NOT EXISTS user_server_service (
  id_user_server varchar(50) NOT NULL DEFAULT 'undefined',
  service_name varchar(50) NOT NULL DEFAULT 'undefined',
  service_enabled varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (id_user_server,service_name)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS hfp_hf;
CREATE TABLE IF NOT EXISTS hfp_hf (
  parameter_name varchar(100) NOT NULL DEFAULT 'undefined',
  id_hf varchar(50) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (parameter_name,id_hf)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS assign_hf;
CREATE TABLE IF NOT EXISTS assign_hf (
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  hf_server varchar(100) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_user,hf_server)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS assign_server;
CREATE TABLE IF NOT EXISTS assign_server (
  id_user varchar(50) NOT NULL DEFAULT 'undefined',
  server_hf varchar(100) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_user,server_hf)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS job_flag;
CREATE TABLE IF NOT EXISTS job_flag (
  id_job varchar(100) NOT NULL DEFAULT 'undefined',
  flag varchar(50) NOT NULL DEFAULT 'undefined',
  status varchar(100) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (id_job,flag)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
