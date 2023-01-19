create table lis458olfa22_dillonk2_project.sources (
	source_id int not null auto_increment,
	source_title varchar(255),
    source_pub_place varchar(80),
    source_edition varchar(20),
    source_language varchar(40),
    source_year varchar(40),
    constraint primary key(source_id)
);