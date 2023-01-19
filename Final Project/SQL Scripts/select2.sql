SELECT CONCAT(sources.source_title, ' (', sources.source_year, '), ', sources.source_pub_place, '. Written in ', sources.source_language) as 'Source',
		sources.source_id
      FROM sources
      WHERE LOWER(sources.source_title) LIKE CONCAT('%', LOWER('medicine'), '%')
      AND replace(sources.source_pub_place, ' ', '') = 'Persia'
      AND replace(sources.source_language, ' ', '') = 'Arabic'
