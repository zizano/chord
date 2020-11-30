<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AppUser extends Model
{
    public static function makeReport()
    {
        $query = "SELECT `app_users`.`id` as user_id, concat(app_users.name, ' ', app_users.surname) AS full_name, `houses`.`id` as house_id,
	(CASE `houses`.`propertytype`
 		WHEN 1 THEN 'FLAT'
 		WHEN 2 THEN 'small house'
 		WHEN 3 THEN 'big house'
 		WHEN 4 THEN 'Villa'
 		ELSE '-'
	END) AS property_type,
	`post_codes`.`postcode`,
	CONCAT_WS(',', addr.district, addr.locality, addr.street, addr.site, addr.site_number, addr.site_description, addr.site_subdescription) as full_address,

	(SELECT COUNT(*) FROM `likes` WHERE `a` =  app_users.id AND `like` = 1) AS likes_given_count,
	(SELECT GROUP_CONCAT(id SEPARATOR ', ') FROM `likes` WHERE `a` =  app_users.id AND `like` = 1) AS likes_given,
	(SELECT COUNT(*) FROM `likes` WHERE `b` =  app_users.id AND `like` = 1) AS likes_received_count,
	(SELECT COUNT(DISTINCT `b`) FROM `likes` WHERE `a` = `app_users`.`id` AND `like` = 1 AND `b` IN (SELECT DISTINCT `a` FROM likes WHERE `b` = `app_users`.`id` AND `like` = 1)) AS matches_count,
	(SELECT GROUP_CONCAT(DISTINCT `b`) FROM `likes` WHERE `a` = `app_users`.`id` AND `like` = 1 AND `b` IN (SELECT DISTINCT `a` FROM likes WHERE `b` = `app_users`.`id` AND `like` = 1) ) AS matches,
	(SELECT COUNT(*) FROM (
    SELECT DISTINCT `to` AS user_id  FROM `chats` WHERE `from` = `app_users`.`id`
		UNION
		SELECT DISTINCT `from` AS user_id  FROM `chats` WHERE`to` = `app_users`.`id`
		) AS distinc_chats
	) AS chats_count,
	(SELECT COUNT(DISTINCT `to`) FROM `chats` AS chats_started WHERE `from` = `app_users`.`id` AND (SELECT COUNT(*) FROM `chats` WHERE `from` = chats_started.to AND `to` = `app_users`.`id`) = 0) AS chats_no_answer,
	(SELECT COUNT(*) FROM `people` WHERE `user_id` = `app_users`.`id`) AS people_in_house,
	(SELECT COUNT(*) FROM `people` WHERE `user_id` = `app_users`.`id` AND age >= 45 AND sex = 'M') AS older_male_in_house
 FROM
 	`app_users`
 	 LEFT JOIN `houses` ON houses.`user_id` = app_users.id
 	 LEFT JOIN `post_codes` ON `post_codes`.`id` = `houses`.`postcode_id`
 	 LEFT JOIN `addresses` AS addr ON addr.`postcode_id` = houses.postcode_id";

        return DB::select($query);

    }
}
