@echo off
echo *****************************
echo.
echo 今天是 %date%
echo 时间是 %time%
echo.
echo.
echo *****************************

echo "%date:~0,4%%date:~5,2%%date:~8,2%_%time:~0,2%%time:~3,2%%time:~6,2%"

set year=%date:~0,4%

set mouth=%date:~5,2%

set date=%date:~8,2%

set hour=%time:~0,2%

set minute=%time:~3,2%

set second=%time:~6,2%

set filename="notes%year%%mouth%%date%.sql"

echo %filename%

d:

cd Program Files\MySQL\MySQL Server 5.5\bin

mysqldump.exe notes -uroot -p123456 > E:\back-end\PHP\PHPRoot\MyLab\notes\SQL\%filename%

echo notes数据库备份至DE:\back-end\PHP\PHPRoot\MyLab\notes\SQL\%filename%

pause & exit 