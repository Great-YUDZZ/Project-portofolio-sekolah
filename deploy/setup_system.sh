#!/usr/bin/env bash
# Script bantuan setup system untuk Skensa Jaya (memerlukan sudo)
# Jalankan dengan: sudo bash deploy/setup_system.sh

set -e

echo "=== 1. Membuat Database skensa_jaya & User skensa ==="
mariadb < deploy/sql/create_database.sql

echo "=== 2. Mengkonfigurasi Nginx Server Block school.skensa ==="
cp deploy/nginx/school.skensa.conf /etc/nginx/sites-available/school.skensa
ln -sf /etc/nginx/sites-available/school.skensa /etc/nginx/sites-enabled/school.skensa
nginx -t
systemctl reload nginx

echo "=== 3. Menambahkan domain local school.skensa ke /etc/hosts ==="
if ! grep -q "school.skensa" /etc/hosts; then
    echo "127.0.0.1 school.skensa" >> /etc/hosts
    echo "Domain school.skensa berhasil ditambahkan ke /etc/hosts"
else
    echo "Domain school.skensa sudah terdaftar di /etc/hosts"
fi

echo "=== 4. Mengatur Permission Storage & Cache Laravel ==="
chown -R yudz:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

echo "=== Setup System Selesai ==="
echo "Web sekarang dapat diakses secara lokal di: http://school.skensa"
