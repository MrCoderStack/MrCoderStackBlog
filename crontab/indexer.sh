killall -9 searchd 
/usr/local/coreseek/bin/indexer -c /etc/sphinx.conf --all --rotate && 
/usr/local/coreseek/bin/searchd -c /etc/sphinx.conf
time=`date "+%Y-%m-%d %H:%M:%S "`
echo "${time} sphinx restart success" >> /usr/share/nginx/html/crontab/sphinx.log
