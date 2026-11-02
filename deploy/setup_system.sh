#!/usr/bin/env bash
# Script bantuan setup system untuk Skensa Jaya (memerlukan sudo)
# Jalankan dengan: sudo bash deploy/setup_system.sh

set -e

DB_PASS="${DB_PASSWORD:-$(openssl rand -hex 16)}"
echo "=== 1. Membuat Database skensa_jaya & User skensa ==="
sed "s/CHANGE_ME_STRONG_DB_PASSWORD/${DB_PASS}/g" deploy/sql/create_database.sql | mariadb

echo "=== 2. Mengupdate .env ke Database skensa_jaya ==="
sed -i 's/^DB_DATABASE=.*/DB_DATABASE=skensa_jaya/' .env
sed -i 's/^DB_USERNAME=.*/DB_USERNAME=skensa/' .env
sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=${DB_PASS}/" .env
sed -i 's/^DB_PREFIX=.*/DB_PREFIX=/' .env

echo "=== 3. Mengkonfigurasi Nginx Server Block school.skensa ==="
cp deploy/nginx/school.skensa.conf /etc/nginx/sites-available/school.skensa
ln -sf /etc/nginx/sites-available/school.skensa /etc/nginx/sites-enabled/school.skensa
nginx -t
systemctl reload nginx

echo "=== 4. Menambahkan domain local school.skensa ke /etc/hosts ==="
if ! grep -q "school.skensa" /etc/hosts; then
    echo "127.0.0.1 school.skensa" >> /etc/hosts
    echo "Domain school.skensa berhasil ditambahkan ke /etc/hosts"
else
    echo "Domain school.skensa sudah terdaftar di /etc/hosts"
fi

echo "=== 5. Mengatur Permission Storage & Cache Laravel ==="
chown -R yudz:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "=== 6. Menjalankan Migrasi & Seeder ==="
sudo -u yudz php artisan migrate:fresh --seed

echo "=== Setup System Selesai ==="
echo "Web sekarang dapat diakses secara lokal di: http://school.skensa"
