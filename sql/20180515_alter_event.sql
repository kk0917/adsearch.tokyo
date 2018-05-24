-- 画像情報を格納するカラムを追加する ここから

/* UP */
ALTER TABLE EVENT ADD COLUMN main_image_info json DEFAULT NULL AFTER main_image_path;
ALTER TABLE EVENT ADD COLUMN list_image_info json DEFAULT NULL AFTER list_image_path;

/* DOWN */
/*
ALTER TABLE EVENT ADD COLUMN main_image_info json DEFAULT NULL AFTER main_image_path;
ALTER TABLE EVENT ADD COLUMN list_image_info json DEFAULT NULL AFTER list_image_path;
*/

-- 画像情報を格納するカラムを追加する ここまで