echo Enter mysql password...
echo off
cd C:\wamp\bin\mysql\mysql5.6.12\bin\
cls
mysqldump -u root -p fyp > C:\wamp\www\FinalYearProject\SQL_Files\dbDump.sql
echo Final Year Project sql dump created...
cd C:\wamp\www\FinalYearProject\SQL_Files\
pause