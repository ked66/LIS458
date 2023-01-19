CREATE TABLE lis458olfa22_dillonk2_project.nccih_info (
	nccih_id int NOT NULL AUTO_INCREMENT,
    nccih_text text,
    nccih_link varchar(225),
    herb_id int,
    indication_mesh_id varchar(15),
    constraint primary key(nccih_id),
    constraint foreign key (herb_id) references lis458olfa22_dillonk2_project.herbs(herb_id),
    constraint foreign key (indication_mesh_id) references lis458olfa22_dillonk2_project.indications(indication_mesh_id)
);