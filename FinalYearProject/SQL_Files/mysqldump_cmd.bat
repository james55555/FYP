echo Enter mysql password...
echo off
cd C:\wamp\bin\mysql\mysql5.6.12\bin\
cls
::Set the date for filename append
for /F "usebackq tokens=1,2 delims==" %%i in (`wmic os get LocalDateTime /VALUE 2^>NUL`) do if '.%%i.'=='.LocalDateTime.' set ldt=%%j
set ldt=%ldt:~6,2%-%ldt:~4,2%-%ldt:~0,4%

mysqldump -u root -p fyp > C:\wamp\www\FinalYearProject\SQL_Files\db_%ldt%.sql
echo New file: database_dump_%ldt%.sql
echo Changing Directory
cd C:\wamp\www\FinalYearProject\SQL_Files\
echo New directory: SQL_Files
pause