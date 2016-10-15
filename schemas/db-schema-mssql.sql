SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hf_node_filter](
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_filter] [varchar](255) NOT NULL DEFAULT (''),
 CONSTRAINT [primary pkey_hf_node_filter] PRIMARY KEY CLUSTERED 
(
	[id_hf] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hf_parameter](
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[keyword] [varchar](200) NOT NULL DEFAULT (''),
	[parameter_name] [varchar](200) NOT NULL DEFAULT (''),
	[str_default_value] [varchar](50) NOT NULL DEFAULT (''),
	[int_preserve_encode] [varchar](2) NOT NULL DEFAULT ('0'),
	[int_mandatory] [varchar](1) NOT NULL DEFAULT ('0'),
	[int_immutable] [varchar](1) NOT NULL DEFAULT ('0'),
 CONSTRAINT [primary pkey_hf_parameter] PRIMARY KEY CLUSTERED 
(
	[id_hf] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hf_tag](
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_tag] [varchar](50) NOT NULL DEFAULT (''),
 CONSTRAINT [primary pkey_hf_tag] PRIMARY KEY CLUSTERED 
(
	[id_hf] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON
SET QUOTED_IDENTIFIER ON
SET ANSI_PADDING ON
CREATE TABLE [dbo].[strings](
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[val] [varchar](600) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_strings] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[job_id_user](
	[id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](100) NOT NULL DEFAULT ('undefined'),
	[id_status] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[dt_created] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[dt_modified] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[dt_done] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_rqdata] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_response] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_output] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_ad] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[int_try] [varchar](7) NOT NULL DEFAULT ('0'),
 CONSTRAINT [primary pkey_job_id_user] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[match_custom](
	[id_expr] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[idx_key] [varchar](40) NOT NULL DEFAULT ('undefined'),
	[str_txt] [varchar](40) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_match_custom] PRIMARY KEY CLUSTERED 
(
	[id_expr] ASC,
	[idx_key] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[match_entry](
	[id_expr] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[idx_id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_entry_type] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_entry_subtype] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[int_order] [varchar](11) NOT NULL DEFAULT (''),
 CONSTRAINT [primary pkey_match_entry] PRIMARY KEY CLUSTERED 
(
	[id_expr] ASC,
	[idx_id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[me_setting](
	[id_me] [varchar](120) NOT NULL DEFAULT ('undefined'),
	[name] [varchar](255) NOT NULL DEFAULT ('undefined'),
	[str_value] [varchar](500) NOT NULL DEFAULT (''),
 CONSTRAINT [primary pkey_me_setting] PRIMARY KEY CLUSTERED 
(
	[id_me] ASC,
	[name] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[ph_child](
	[id_child_job] [varchar](100) NOT NULL DEFAULT ('undefined'),
	[id_parent_job] [varchar](100) NOT NULL DEFAULT ('undefined'),
	[placeholder] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_ph_child] PRIMARY KEY CLUSTERED 
(
	[id_child_job] ASC,
	[id_parent_job] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[ph_parent](
	[id_parent_job] [varchar](100) NOT NULL DEFAULT ('undefined'),
	[id_child_job] [varchar](100) NOT NULL DEFAULT ('undefined'),
	[placeholder] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_ph_parent] PRIMARY KEY CLUSTERED 
(
	[id_parent_job] ASC,
	[id_child_job] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[job_new](
	[id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](100) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_job_new] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hf_kill](
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_name] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_hf_kill] PRIMARY KEY CLUSTERED 
(
	[id_hf] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hfp_vcs](
	[id_hf_parameter] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_constraint_type] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_constraint_text] [varchar](300) NOT NULL DEFAULT (''),
 CONSTRAINT [primary pkey_hfp_vcs] PRIMARY KEY CLUSTERED 
(
	[id_hf_parameter] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hf_file](
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_file] [varchar](600) NOT NULL DEFAULT ('undefined'),
	[str_targetfile] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_hf_file] PRIMARY KEY CLUSTERED 
(
	[id_hf] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hf_id_user](
	[id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[name] [varchar](300) NOT NULL DEFAULT ('undefined'),
	[str_expression] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_condition] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_cache_out_xml] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_cache_out_cxml] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_cache_approved] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_cache_latest] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_cache_ad] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_mime_type] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[int_ws] [varchar](2) NOT NULL DEFAULT ('0'),
	[int_wait] [varchar](1) NOT NULL DEFAULT ('0'),
	[int_cleanup] [varchar](1) NOT NULL DEFAULT ('1'),
	[int_maxruntime] [varchar](8) NOT NULL DEFAULT ('0'),
	[int_mtf] [varchar](8) NOT NULL DEFAULT ('1'),
	[int_retry_count] [varchar](8) NOT NULL DEFAULT ('0'),
	[str_fastresponse] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_hf_id_user] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[user_id_user](
	[id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[user_name] [varchar](250) NOT NULL DEFAULT (''),
	[email] [varchar](100) NOT NULL DEFAULT (''),
	[pw] [varchar](50) NOT NULL DEFAULT (''),
	[secret] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[lang] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_user_id_user] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[user_server](
	[id_user] [varchar](40) NOT NULL DEFAULT ('undefined'),
	[name] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[last_ping] [varchar](20) NOT NULL DEFAULT ('undefined'),
	[force_restart] [varchar](2) NOT NULL DEFAULT ('0'),
	[str_log] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[ip_address] [varchar](25) NOT NULL DEFAULT ('undefined'),
	[id_sk] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[int_routable] [varchar](1) NOT NULL DEFAULT ('0'),
	[is_busy] [varchar](1) NOT NULL DEFAULT ('0'),
	[int_online] [varchar](1) NOT NULL DEFAULT ('1'),
	[software_version] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_user_server] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC,
	[name] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[user_user_name](
	[user_name] [varchar](250) NOT NULL DEFAULT (''),
	[email] [varchar](100) NOT NULL DEFAULT (''),
	[pw] [varchar](50) NOT NULL DEFAULT (''),
	[id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[secret] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[lang] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_user_user_name] PRIMARY KEY CLUSTERED 
(
	[user_name] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;




SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hf_resource](
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_location] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[str_filename] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_hf_resource] PRIMARY KEY CLUSTERED 
(
	[id_hf] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[user_inherit](
	[id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_user_inherit] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC,
	[id_hf] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hf_system_kind](
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_sk] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_hf_system_kind] PRIMARY KEY CLUSTERED 
(
	[id_hf] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hfr_system_kind](
	[id_resource] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_sk] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_hfr_system_kind] PRIMARY KEY CLUSTERED 
(
	[id_hf] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[user_system_kind](
	[id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[name] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[detection_text] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_user_system_kind] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hf_inherit](
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_inherit] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_hf_inherit] PRIMARY KEY CLUSTERED 
(
	[id_hf] ASC,
	[id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[sys_setting](
	[category] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[param] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[val] [varchar](50) NOT NULL DEFAULT (''),
 CONSTRAINT [primary pkey_sys_setting] PRIMARY KEY CLUSTERED 
(
	[category] ASC,
	[param] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[user_server_service](
	[id_user_server] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[service_name] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[service_enabled] [varchar](1) NOT NULL DEFAULT ('0'),
 CONSTRAINT [primary pkey_user_server_service] PRIMARY KEY CLUSTERED 
(
	[id_user_server] ASC,
	[service_name] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[hfp_hf](
	[parameter_name] [varchar](100) NOT NULL DEFAULT ('undefined'),
	[id_hf] [varchar](50) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_hfp_hf] PRIMARY KEY CLUSTERED 
(
	[parameter_name] ASC,
	[id_hf] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[assign_hf](
	[id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[hf_server] [varchar](100) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_assign_hf] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC,
	[hf_server] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;

SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[assign_server](
	[id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[server_hf] [varchar](100) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_assign_server] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC,
	[server_hf] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;


SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[job_flag](
	[id_job] [varchar](100) NOT NULL DEFAULT ('undefined'),
	[flag] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[status] [varchar](100) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_job_flag] PRIMARY KEY CLUSTERED 
(
	[id_job] ASC,
	[flag] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;




SET ANSI_NULLS ON;
SET QUOTED_IDENTIFIER ON;
SET ANSI_PADDING ON;
CREATE TABLE [dbo].[job_status](
	[id_user] [varchar](50) NOT NULL DEFAULT ('undefined'),
	[id_status_job] [varchar](100) NOT NULL DEFAULT ('undefined'),
 CONSTRAINT [primary pkey_job_status] PRIMARY KEY CLUSTERED 
(
	[id_user] ASC,
	[id_status_job] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY];
SET ANSI_PADDING OFF;
