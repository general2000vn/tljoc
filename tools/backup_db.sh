#!/bin/bash

SERVER_PREFIX='tljoc.eOffice'
LOG_FILE=/data_disk/backup/$SERVER_PREFIX.daily.backup.log
BACKUP_DIR=/data_disk/backup/databases

MYSQLDUMP="$(which mysqldump)"
TAR="$(which tar)"

APP_PATH=/data_disk/html/e-office
APP_DB='e.office'
APP_USER='tldas'
APP_PASS='tldas@123'

TimeStamp=`date +%Y%m%d-%H%M%S`

#echo $TimeStamp

#echo $SERVER_PREFIX.app.$TimeStamp.tar.gz

function compressfiles(){
	echo >> $LOG_FILE
	
	echo Compressing APP DB... >> $LOG_FILE
	$MYSQLDUMP --add-drop-table --complete-insert --extended-insert --quote-names -u $APP_USER -h localhost -p$APP_PASS $APP_DB 2>>$LOG_FILE | gzip > $BACKUP_DIR/$SERVER_PREFIX.db.$TimeStamp.sql.gz 2>>$LOG_FILE

}


function removefiles(){
	echo  >> $LOG_FILE
	echo Removing previously generated temporary files >> $LOG_FILE
	rm $BACKUP_DIR/*.* 2>>$LOG_FILE
}

echo  >> $LOG_FILE
echo ===================$TimeStamp=========================== >> $LOG_FILE
echo Server: $SERVER_PREFIX >> $LOG_FILE
echo 


removefiles

compressfiles

echo  Done. >> $LOG_FILE


