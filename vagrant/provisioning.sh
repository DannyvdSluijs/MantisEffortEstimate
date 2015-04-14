#!/usr/bin/env bash
echo "Running apt-get update" 
apt-get update > /dev/null

# Install Apache
echo "Installing Apache webserver" 
apt-get install -y apache2 > /dev/null

# Install PHP and other stuff
echo "Installing PHP and some plugins" 
apt-get install -y  php5 php5-mysql > /dev/null

# Install mysql
debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
apt-get -y install mysql-server

# Install Vim and Git
echo "Installing Vim and some other tools" 
apt-get install -y vim git > /dev/null

# Setting up mantis bugtracker
cd /var/www
rm index.html

git clone --recursive  https://github.com/mantisbt/mantisbt.git
cd mantisbt
git checkout release-1.2.19 -f
git submodule update --init --recursive

chown www-data.vagrant /var/www/mantisbt -R
chmod 777 /var/www/mantisbt/config

cd plugins
ln -s ../../EffortEstimate

cp /var/www/EffortEstimate/vagrant/vhost /etc/apache2/sites-available/mantisbt

a2dissite default
a2ensite mantisbt
service apache2 reload

echo "System installation completed!"
