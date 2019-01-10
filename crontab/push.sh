time=`date "+%Y-%m-%d %H:%M:%S "`
echo "${time}" `curl http://www.vm-blog.com/admin-api/push` >> push.log


