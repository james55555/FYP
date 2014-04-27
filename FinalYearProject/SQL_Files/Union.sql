select * from account AC
join user_project UP
on AC.user_id = UP.user_id
join project P
on P.proj_id = UP.proj_id
join project_estimation PE
on P.proj_id = PE.proj_id
join ESTIMATION ES
on PE.est_id = ES.est_id
join TASK T
on T.proj_id = P.proj_id
join TASK_ESTIMATION TE
on T.TSK_ID=TE.TSK_ID
join ESTIMATION ES2
on ES2.est_id=TE.est_id
join TASK_DEPENDENCY TD
on T.TSK_ID = TD.TSK_ID
join DEPENDENCY DP
on TD.dependency_id=DP.dependency_id
join STAFF_TASK STSK
on STSK.TSK_ID= T.TSK_ID
join STAFF STFF
on STSK.STAFF_ID = STFF.staff_ID