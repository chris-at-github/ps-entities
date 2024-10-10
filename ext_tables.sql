#
# Extend SysCategory
#
CREATE TABLE sys_category (
	tx_entity_page int(11) DEFAULT '0' NOT NULL
);

CREATE TABLE tx_entity_domain_model_entity (
	tx_extbase_type varchar(255) DEFAULT '' NOT NULL,
	title varchar(255) DEFAULT '' NOT NULL,
	subtitle text,
	slug varchar(1024) DEFAULT '' NOT NULL,
	master_category int(11) DEFAULT '0' NOT NULL,
	categories int(11) unsigned DEFAULT '0' NOT NULL,
	image int(11) unsigned NOT NULL default '0',
	media int(11) unsigned DEFAULT '0' NOT NULL,
	files int(11) unsigned DEFAULT '0' NOT NULL,
	meta_description text,
	short_description text,
	long_description text,
	teaser text,
	canonical_url varchar(255) DEFAULT '' NOT NULL,
	no_index smallint(5) unsigned DEFAULT '0' NOT NULL,
	no_follow smallint(5) unsigned DEFAULT '0' NOT NULL,
	sitemap_change_frequency varchar(10) DEFAULT '' NOT NULL,
	sitemap_priority decimal(2,1) DEFAULT '0.5' NOT NULL,
	seo_title varchar(255) DEFAULT '' NOT NULL,
	og_title varchar(255) DEFAULT '' NOT NULL,
	og_description text,
	og_image int(11) unsigned NOT NULL default '0',
	twitter_title varchar(255) DEFAULT '' NOT NULL,
	twitter_description text,
	twitter_image int(11) unsigned NOT NULL default '0',
	twitter_card varchar(50) DEFAULT '' NOT NULL,
	related int(11) unsigned DEFAULT '0' NOT NULL,
	parent int(11) unsigned DEFAULT '0',
    token varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE tx_entity_entity_entity_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local, uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
