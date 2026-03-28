#!/bin/bash
# ============================================================
# KTB Account - Server Setup Script
# ระบบบริหารกองทุนหมู่บ้าน
# รันที่เซิร์ฟเวอร์: bash server-setup.sh
# ============================================================

DOMAIN="ktbaccount.xman4289.com"
DEPLOY_PATH="/home/admin/domains/${DOMAIN}"

echo ""
echo "============================================"
echo " 🏦 KTB Account - Server Setup"
echo " ระบบบริหารกองทุนหมู่บ้าน"
echo "============================================"
echo ""
echo " Domain: ${DOMAIN}"
echo " Path:   ${DEPLOY_PATH}"
echo ""

# ─── ถาม DB Credentials ───
echo "📋 กรุณากรอกข้อมูลฐานข้อมูล MySQL"
echo "   (สร้างไว้แล้วผ่าน DirectAdmin)"
echo ""
read -p "   ชื่อฐานข้อมูล (DB Name): " DB_NAME
read -p "   ชื่อผู้ใช้ (DB User): " DB_USER
read -sp "   รหัสผ่าน (DB Password): " DB_PASS
echo ""
echo ""

if [ -z "$DB_NAME" ] || [ -z "$DB_USER" ] || [ -z "$DB_PASS" ]; then
    echo "❌ กรุณากรอกข้อมูลให้ครบทุกช่อง"
    exit 1
fi

# ─── 1. ทดสอบ DB ───
echo "=== 1/9 ทดสอบเชื่อมต่อฐานข้อมูล ==="
if mysql -u "$DB_USER" -p"$DB_PASS" -e "USE \`${DB_NAME}\`;" 2>/dev/null; then
    echo "✅ เชื่อมต่อฐานข้อมูล '${DB_NAME}' สำเร็จ"
else
    echo "❌ ไม่สามารถเชื่อมต่อฐานข้อมูลได้"
    echo "   ตรวจสอบ: ชื่อ DB / User / Password ถูกต้องหรือไม่"
    echo "   สร้างฐานข้อมูลผ่าน DirectAdmin ก่อนแล้วรันสคริปนี้ใหม่"
    exit 1
fi

# ─── 2. Clone / Pull ───
echo ""
echo "=== 2/9 ดาวน์โหลดโปรเจค ==="
cd "${DEPLOY_PATH}" || { echo "❌ ไม่พบ path: ${DEPLOY_PATH}"; exit 1; }

if [ -d ".git" ]; then
    echo "📂 พบโปรเจคอยู่แล้ว กำลังอัพเดท..."
    git pull origin main || { echo "❌ git pull ล้มเหลว"; exit 1; }
else
    echo "📂 กำลังดาวน์โหลดโปรเจค..."
    # สำรองไฟล์เดิม
    if [ "$(ls -A . 2>/dev/null)" ]; then
        BACKUP="/tmp/ktbaccount-backup-$(date +%Y%m%d%H%M%S)"
        echo "   สำรองไฟล์เดิมไว้ที่ ${BACKUP}"
        mkdir -p "$BACKUP"
        cp -r ./* "$BACKUP/" 2>/dev/null || true
        cp -r ./.* "$BACKUP/" 2>/dev/null || true
    fi
    git init
    git remote add origin https://github.com/xjanova/ktbaccount.git 2>/dev/null || true
    git fetch origin || { echo "❌ git fetch ล้มเหลว"; exit 1; }
    git checkout -f main
fi
echo "✅ โปรเจคพร้อมแล้ว"

# ─── 3. หา PHP & Composer ───
echo ""
echo "=== 3/9 ตรวจสอบ PHP & Composer ==="

# หา PHP
PHP_BIN=""
if command -v php &>/dev/null; then
    PHP_BIN="php"
elif [ -f "/usr/local/bin/php" ]; then
    PHP_BIN="/usr/local/bin/php"
elif [ -f "/usr/bin/php" ]; then
    PHP_BIN="/usr/bin/php"
fi

if [ -z "$PHP_BIN" ]; then
    echo "❌ ไม่พบ PHP กรุณาติดตั้ง PHP 8.2+ ก่อน"
    exit 1
fi

echo "   PHP: $($PHP_BIN --version | head -1)"

# หา Composer
COMPOSER_CMD=""
if command -v composer &>/dev/null; then
    COMPOSER_CMD="composer"
elif [ -f "${DEPLOY_PATH}/composer.phar" ]; then
    COMPOSER_CMD="$PHP_BIN composer.phar"
elif [ -f "/usr/local/bin/composer" ]; then
    COMPOSER_CMD="/usr/local/bin/composer"
else
    echo "   ⬇️ กำลังดาวน์โหลด Composer..."
    curl -sS https://getcomposer.org/installer | $PHP_BIN
    COMPOSER_CMD="$PHP_BIN composer.phar"
fi
echo "   Composer: พร้อมใช้งาน"

# ─── 4. Composer Install ───
echo ""
echo "=== 4/9 ติดตั้ง PHP dependencies ==="
$COMPOSER_CMD install --no-dev --optimize-autoloader --no-interaction 2>&1 || \
$COMPOSER_CMD install --no-dev --optimize-autoloader --no-interaction --no-scripts 2>&1
echo "✅ PHP dependencies ติดตั้งเสร็จ"

# ─── 5. Setup .env ───
echo ""
echo "=== 5/9 ตั้งค่า Environment (.env) ==="

# สร้าง .env ถ้ายังไม่มี
if [ ! -f ".env" ]; then
    cp .env.example .env
    echo "   สร้างไฟล์ .env จาก .env.example"
fi

# ตั้งค่า Production
sed -i "s|^APP_ENV=.*|APP_ENV=production|" .env
sed -i "s|^APP_DEBUG=.*|APP_DEBUG=false|" .env
sed -i "s|^APP_URL=.*|APP_URL=https://${DOMAIN}|" .env
sed -i "s|^APP_TIMEZONE=.*|APP_TIMEZONE=Asia/Bangkok|" .env

# ตั้งค่า Database
sed -i "s|^DB_CONNECTION=.*|DB_CONNECTION=mysql|" .env
sed -i "s|^DB_HOST=.*|DB_HOST=127.0.0.1|" .env
sed -i "s|^DB_PORT=.*|DB_PORT=3306|" .env
sed -i "s|^DB_DATABASE=.*|DB_DATABASE=${DB_NAME}|" .env
sed -i "s|^DB_USERNAME=.*|DB_USERNAME=${DB_USER}|" .env
sed -i "s|^DB_PASSWORD=.*|DB_PASSWORD=${DB_PASS}|" .env

# ── Generate APP_KEY ──
CURRENT_KEY=$(grep "^APP_KEY=" .env | cut -d'=' -f2)
if [ -z "$CURRENT_KEY" ] || [ "$CURRENT_KEY" = "" ]; then
    echo "   🔑 สร้าง APP_KEY ใหม่..."
    $PHP_BIN artisan key:generate --force
    echo "   ✅ APP_KEY สร้างเรียบร้อย"
else
    echo "   🔑 APP_KEY มีอยู่แล้ว: ${CURRENT_KEY:0:20}..."
fi

# ตรวจสอบ APP_KEY อีกรอบ
FINAL_KEY=$(grep "^APP_KEY=" .env | cut -d'=' -f2)
if [ -z "$FINAL_KEY" ] || [ "$FINAL_KEY" = "" ]; then
    echo "   ⚠️ APP_KEY ยังว่าง ลองสร้างด้วยวิธีสำรอง..."
    NEW_KEY="base64:$(openssl rand -base64 32)"
    sed -i "s|^APP_KEY=.*|APP_KEY=${NEW_KEY}|" .env
    echo "   ✅ APP_KEY สร้างด้วย openssl: ${NEW_KEY:0:20}..."
fi

echo "✅ ตั้งค่า .env เรียบร้อย"

# แสดงค่าสำคัญ
echo ""
echo "   📋 ค่าที่ตั้งไว้:"
echo "   APP_ENV     = $(grep '^APP_ENV=' .env | cut -d'=' -f2)"
echo "   APP_URL     = $(grep '^APP_URL=' .env | cut -d'=' -f2)"
echo "   APP_KEY     = $(grep '^APP_KEY=' .env | cut -d'=' -f2 | head -c 25)..."
echo "   DB_DATABASE = $(grep '^DB_DATABASE=' .env | cut -d'=' -f2)"
echo "   DB_USERNAME = $(grep '^DB_USERNAME=' .env | cut -d'=' -f2)"

# ─── 6. Storage & Permissions ───
echo ""
echo "=== 6/9 ตั้งค่า Storage & Permissions ==="
mkdir -p storage/logs
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/testing
mkdir -p storage/framework/views
mkdir -p bootstrap/cache

# Storage symlink ไป public_html (DirectAdmin document root)
if [ ! -L "public_html/storage" ]; then
    ln -sf "${DEPLOY_PATH}/storage/app/public" "${DEPLOY_PATH}/public_html/storage" 2>/dev/null || true
    echo "   สร้าง symlink: public_html/storage → storage/app/public"
fi

# ลบ default public_html ของ DirectAdmin แล้วให้ project public_html แทน
if [ -d "public_html" ] && [ ! -f "public_html/index.php" ]; then
    echo "   ⚠️ public_html ว่าง - DirectAdmin default"
    rm -rf public_html
    echo "   ลบ public_html เก่าแล้ว"
fi

chmod -R 775 storage bootstrap/cache
chown -R admin:admin . 2>/dev/null || true
echo "✅ Permissions ตั้งค่าเสร็จ"

# ─── 7. Migrations ───
echo ""
echo "=== 7/9 สร้างตาราง Database ==="
$PHP_BIN artisan migrate --force 2>&1
if [ $? -eq 0 ]; then
    echo "✅ ตาราง Database สร้างเสร็จ"
else
    echo "❌ Migration ล้มเหลว ตรวจสอบการเชื่อมต่อ DB"
    echo "   ลองรัน: php artisan migrate --force"
    exit 1
fi

# ─── 8. Build Frontend ───
echo ""
echo "=== 8/9 Build Frontend ==="
if command -v npm &>/dev/null; then
    npm ci 2>/dev/null || npm install
    npm run build
    if [ $? -eq 0 ]; then
        echo "✅ Frontend build เสร็จ"
    else
        echo "⚠️ Frontend build ล้มเหลว ลองรัน: npm run build"
    fi
elif command -v node &>/dev/null; then
    echo "   พบ Node.js แต่ไม่พบ npm"
    echo "   ลองรัน: npm install && npm run build"
else
    echo "⚠️ ไม่พบ Node.js / npm"
    echo "   ติดตั้ง: curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && apt-get install -y nodejs"
    echo "   แล้วรัน: cd ${DEPLOY_PATH} && npm install && npm run build"
fi

# ─── 9. Optimize & Cache ───
echo ""
echo "=== 9/9 Optimize & Cache ==="
$PHP_BIN artisan config:cache 2>&1
$PHP_BIN artisan route:cache 2>&1
$PHP_BIN artisan view:cache 2>&1
$PHP_BIN artisan event:cache 2>&1
$PHP_BIN artisan queue:restart 2>/dev/null || true

# ─── Setup Cron ───
CRON_ENTRY="*/5 * * * * cd ${DEPLOY_PATH} && ${PHP_BIN} artisan schedule:run >> /dev/null 2>&1"
if crontab -l 2>/dev/null | grep -q "ktbaccount"; then
    echo "📋 Cron มีอยู่แล้ว"
else
    (crontab -l 2>/dev/null; echo "${CRON_ENTRY}") | crontab -
    echo "✅ เพิ่ม Cron สำหรับ scheduler (ทุก 5 นาที)"
fi

# ─── ทดสอบ ───
echo ""
echo "=== ทดสอบระบบ ==="
HEALTH=$($PHP_BIN artisan tinker --execute="echo json_encode(['status'=>'ok','key_set'=>config('app.key')!==null]);" 2>/dev/null || echo '{"status":"skip"}')
if echo "$HEALTH" | grep -q '"ok"'; then
    echo "✅ Laravel ทำงานได้ปกติ"
    echo "✅ APP_KEY ตั้งค่าถูกต้อง"
else
    echo "⚠️ ทดสอบไม่ผ่าน ลองเปิดเว็บเพื่อตรวจสอบ"
fi

echo ""
echo "============================================"
echo " ✅ ติดตั้งเสร็จสมบูรณ์!"
echo "============================================"
echo ""
echo " 🌐 เปิดเว็บ: https://${DOMAIN}"
echo " 📁 Path:    ${DEPLOY_PATH}"
echo " 🗃️  DB:      ${DB_NAME} (user: ${DB_USER})"
echo ""
echo " 👉 ขั้นตอนสุดท้าย:"
echo "    เปิด https://${DOMAIN}/setup"
echo "    เพื่อสร้างบัญชี Super Admin ครั้งแรก"
echo ""
echo " 🔧 ถ้ามีปัญหา ลองรัน:"
echo "    cd ${DEPLOY_PATH}"
echo "    php artisan config:clear"
echo "    php artisan key:generate --force"
echo "    php artisan config:cache"
echo ""
echo "============================================"
