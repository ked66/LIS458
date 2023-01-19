create table lis458olfa22_dillonk2_project.sources_authors (
	source_id int not null,
    author_id int not null,
    source_author_note varchar(255),
    constraint foreign key (source_id) references lis458olfa22_dillonk2_project.sources(source_id),
    constraint foreign key (author_id) references lis458olfa22_dillonk2_project.authors(author_id)
);