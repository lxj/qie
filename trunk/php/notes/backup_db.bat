@echo off
echo *****************************
echo.
echo 今天是 %date%
echo 时间是 %time%
echo.
echo.
echo *****************************

echo "%date:~0,4%%date:~5,2%%date:~8,2%_%time:~0,2%%time:~3,2%%time:~6,2%"

set filename="notes%date:~0,4%%date:~5,2%%date:~8,2%_%time:~0,2%%time:~3,2%%time:~6,2%.sql"

echo %filename%

d:

cd Program Files\MySQL\MySQL Server 5.5\bin

mysqldump.exe notes -uroot -p123456 > E:\back-end\PHP\PHPRoot\MyLab\notes\SQL\%filename%

echo notes数据库备份至DE:\back-end\PHP\PHPRoot\MyLab\notes\SQL\%filename%

pause & exit 