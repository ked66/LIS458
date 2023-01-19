SELECT indications.indication_mesh_name as 'Indication',
	CONCAT (authors.author_name, ' (', authors.author_birth, '-', authors.author_death, ')') as 'Author',
	CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source',
	CONCAT(instances.instance_text, ' (', instances.instance_pgnumber, ')') as 'Instance'
	FROM indications
	LEFT JOIN instances on indications.indication_mesh_id = instances.indication_mesh_id
	LEFT JOIN sources on instances.source_id = sources.source_id
	LEFT JOIN sources_authors ON sources.source_id = sources_authors.source_id
	LEFT JOIN authors on sources_authors.author_id = authors.author_id
	WHERE indication.indication_mesh_id = ‘D001007’
	ORDER BY Indication
