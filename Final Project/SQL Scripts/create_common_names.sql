CREATE TABLE lis458olfa22_dillonk2_project.common_names (
	common_id int NOT NULL AUTO_INCREMENT,
    common_name varchar(80),
    herb_id int,
    constraint primary key(common_id),
    constraint foreign key (herb_id) references lis458olfa22_dillonk2_project.herbs(herb_id)
);