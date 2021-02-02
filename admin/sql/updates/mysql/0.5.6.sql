ALTER TABLE `#__pt_task_country`
    ADD `logic_id` TINYINT UNSIGNED NOT NULL DEFAULT 0;

UPDATE `#__pt_task_country`
SET logic_id = 1
WHERE task_id = 4
   OR task_id = 9
   OR task_id = 19
   OR task_id = 21
   OR task_id = 22
   OR task_id = 25
   OR task_id = 27
   OR task_id = 32
   OR task_id = 33
   OR task_id = 35
   OR task_id = 36
   OR task_id = 37
   OR task_id = 40;
