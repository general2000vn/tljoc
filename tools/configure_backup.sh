apt-get update
apt install samba
samba -V

cp /data_disk/apps/tljoc/smb.conf /etc/samba/
testparm /etc/samba/smb.conf
systemctl restart smbd

adduser bk
usermod -aG www-data bk
smbpasswd -a bk

mkdir /data_disk/backup
mkdir /data_disk/backup/databases
chown -R bk:www-data /data_disk/backup
chmod -R 775 /data_disk/backup


cp /data_disk/apps/tljoc/tools/backup_db.sh /data_disk/backup/backup_db.sh
(crontab -l 2>/dev/null; echo "30 17 * * * /data_disk/backup/backup_db.sh") | crontab -