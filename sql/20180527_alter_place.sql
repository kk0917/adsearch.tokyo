-- #0006 admin master place ここから

/* UP */
ALTER TABLE place CHANGE COLUMN zip_code zip_code1 int(3) DEFAULT NULL;
ALTER TABLE place ADD COLUMN zip_code2 int(4) DEFAULT NULL AFTER zip_code1;
ALTER TABLE place ADD COLUMN main_image_info json DEFAULT NULL AFTER main_image_path;
ALTER TABLE place ADD COLUMN sub_image_info json DEFAULT NULL AFTER sub_image_path;

/* DOWN */
/*
ALTER TABLE place CHANGE COLUMN zip_code1 zip_code varchar(255) DEFAULT NULL;
ALTER TABLE place DROP COLUMN zip_code2;
INSERT INTO `place` (`id`, `name`, `zip_code`, `prefecture`, `address1`, `address2`, `address3`, `address4`, `access_information`, `phone`, `business_days`, `closing_days`, `url`, `main_image_path`, `sub_image_path`, `comment`, `is_deleted`, `created_at`, `created_manager_id`, `updated_at`, `updated_manager_id`)
VALUES
	(2, 'place2', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-05-18 00:00:00', 1, NULL, NULL),
	(3, 'place3', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-05-18 00:00:00', 1, NULL, NULL),
	(4, 'place4', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2018-05-18 00:00:00', 1, NULL, NULL);
ALTER TABLE place DROP COLUMN main_image_info;
ALTER TABLE place DROP COLUMN sub_image_info;
*/

-- #0006 admin master place ここまで
