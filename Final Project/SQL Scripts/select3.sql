SELECT DISTINCT	indications.indication_mesh_name as 'indication', herbs.herb_scientific_name as 'herb', nccih_info.nccih_text as 'text',
  nccih_info.nccih_link as 'link',
	CONCAT(sources.source_title, ' - ', sources.source_year) as 'Source',
	instances.instance_text as 'Instance'
  FROM herbs
  LEFT JOIN nccih_info ON herbs.herb_id = nccih_info.herb_id
  LEFT JOIN indications ON nccih_info.indication_mesh_id = indications.indication_mesh_id
  LEFT JOIN instances ON indications.indication_mesh_id = instances.indication_mesh_id
  LEFT JOIN common_names ON herbs.herb_id = common_names.herb_id
  LEFT JOIN sources ON instances.source_id = sources.source_id
  WHERE replace(herbs.herb_scientific_name, ' ', '') = 'AloeVera'
  UNION
  SELECT DISTINCT indications.indication_mesh_name as 'indication', herbs.herb_scientific_name as 'herb', nccih_info.nccih_text as 'text',
    nccih_info.nccih_link as 'link',
  	CONCAT(sources.source_title, ' - ', sources.source_year) as 'Source',
  	instances.instance_text as 'Instance'
  FROM herbs
  LEFT JOIN common_names ON herbs.herb_id = common_names.herb_id
  LEFT JOIN instances ON common_names.common_id = instances.common_id
  LEFT JOIN indications ON instances.indication_mesh_id = indications.indication_mesh_id
  LEFT JOIN nccih_info ON instances.indication_mesh_id = nccih_info.indication_mesh_id
  LEFT JOIN sources ON instances.source_id = sources.source_id
  WHERE replace(herbs.herb_scientific_name, ' ', '') = 'AloeVera'
