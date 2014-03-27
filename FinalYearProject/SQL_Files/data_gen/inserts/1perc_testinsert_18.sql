DELETE FROM user_project;
DELETE FROM task_estimation;
DELETE FROM task_dependency;
DELETE FROM task;
DELETE FROM staff_task;
DELETE FROM staff;
DELETE FROM project_estimation;
DELETE FROM project;
DELETE FROM estimation;
DELETE FROM dependency;
DELETE FROM account;
 
INSERT INTO account (user_id,acc_create_ts,password,first_nm,last_nm,email_addr) VALUES ('Frederik','03.04.14 02:37:00','4rmneblFY3XJP2JSXphCQ5URtFNMpDTWWIQfb5Uoc6Vkzd33fOxHZdnESq5MSvcVXrtCzTtnMFKkkRe1KFWvnXkZfUJqLS3GiBNkyhWMTzUK4XP6Ndue0VSsR21o1ykG5LFE12QdWYkGewBnjVhRY7e4PqjuBUmgCQeHLIeAW6rk0fVx5AmyPnEEb4K0JP7FlhqNPVSn4A3M7dzGMPABdFyDx7qWt1','Lia','Williams',NULL);
 



 
INSERT INTO dependency (DEPENDENCY_ID,DEPENDENT_ON) VALUES (1,NULL);
 



 
INSERT INTO estimation (EST_ID,ACT_HR,PLN_HR,START_DT,ACT_END_DT,EST_END_DT) VALUES (1,331,37,'12.26.05 09:44:00','02.06.11 10:37:00','01.31.11 04:55:00');
 



 
INSERT INTO project (proj_nm,proj_descr) VALUES ('test project 1','This is a description 6230099');
 



 
INSERT INTO project_estimation (proj_id,est_id) VALUES (460,80839);
 



 
INSERT INTO staff (STAFF_FIRST_NM,STAFF_LAST_NM,STAFF_PHONE,STAFF_EMAIL) VALUES ('Carla','Wood','1-545-7499','KMcnally4@lycos.co.uk');
 



 
INSERT INTO staff_task (TSK_ID,STAFF_ID) VALUES (NULL,3);
 



 
INSERT INTO task (PROJ_ID,STATUS,TASK_NM,WEB_ADDR,TSK_DESCR) VALUES (460,'Not Started','Platinum','FMLpX',NULL);
 



 
INSERT INTO task_dependency (DEPENDENCY_ID,TSK_ID) VALUES (1,NULL);
 



 
INSERT INTO task_estimation (tsk_id,est_id) VALUES (NULL,1);
 



 
INSERT INTO user_project (user_id,proj_id) VALUES ('Ross4',460);
 



