start transaction;
delete from project;
delete from task;

delete from task_estimation;
delete from estimation;

delete from staff;
delete from staff_task;

delete from task_dependency;
delete from dependency;

delete from user_project;
delete from account;
delete from project_estimation;
commit;