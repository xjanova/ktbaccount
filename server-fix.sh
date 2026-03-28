#!/bin/bash
# ============================================================
# KTB Account - Server Fix Script
# แก้ปัญหา 403 Forbidden - ย้าย repo จาก public_html ไป domain root
# รัน: bash server-fix.sh
# ============================================================

DOMAIN="ktbaccount.xman4289.com"
DOMAIN_ROOT="/home/admin/domains/${DOMAIN}"
PUBLIC_HTML="${DOMAIN_ROOT}/public_html"

echo ""
echo "============================================"
echo " 🔧 KTB Account - Server Fix"
echo " แก้ปัญหา 403 Forbidden"
echo "============================================"
echo ""

# ตรวจสอบว่า repo clone ไว้ที่ public_html หรือไม่
if [ -f "${PUBLIC_HTML}/artisan" ]; then
    echo "📂 พบ Laravel project ใน public_html/ (ตำแหน่งผิด)"
    echo "   ต้องย้ายไปที่ domain root: ${DOMAIN_ROOT}/"
    echo ""

    # สำรอง
    echo "=== 1/5 สำรองข้อมูล ==="
    BACKUP="/tmp/ktbaccount-fix-backup-$(date +%Y%m%d%H%M%S)"
    mkdir -p "$BACKUP"
    cp "${PUBLIC_HTML}/.env" "$BACKUP/.env" 2>/dev/null || true
    echo "   ✅ สำรอง .env ไว้ที่ ${BACKUP}"

    # ย้ายไฟล์จาก public_html ไป domain root
    echo ""
    echo "=== 2/5 ย้ายไฟล์ไป domain root ==="
    cd "${DOMAIN_ROOT}"

    # ย้ายทุกอย่างยกเว้น public_html ตัวเอง
    shopt -s dotglob
    for item in "${PUBLIC_HTML}"/*; do
        basename=$(basename "$item")
        if [ "$basename" != "public_html" ]; then
            mv "$item" "${DOMAIN_ROOT}/" 2>/dev/null || cp -r "$item" "${DOMAIN_ROOT}/" 2>/dev/null
        fi
    done
    # ย้าย hidden files
    for item in "${PUBLIC_HTML}"/.*; do
        basename=$(basename "$item")
        if [ "$basename" != "." ] && [ "$basename" != ".." ] && [ "$basename" != ".git" ]; then
            mv "$item" "${DOMAIN_ROOT}/" 2>/dev/null || true
        fi
    done
    # ย้าย .git
    if [ -d "${PUBLIC_HTML}/.git" ]; then
        mv "${PUBLIC_HTML}/.git" "${DOMAIN_ROOT}/.git" 2>/dev/null || true
    fi
    shopt -u dotglob
    echo "   ✅ ย้ายไฟล์เสร็จ"

    # ลบ public_html เก่า
    echo ""
    echo "=== 3/5 จัดการ public_html ==="
    rm -rf "${PUBLIC_HTML}"

    # สร้าง public_html ใหม่จากที่อยู่ใน project
    if [ -d "${DOMAIN_ROOT}/public_html" ]; then
        echo "   ✅ public_html อยู่ในโปรเจคแล้ว"
    else
        echo "   ❌ ไม่พบ public_html ในโปรเจค"
        exit 1
    fi

    # คืนค่า .env
    if [ -f "$BACKUP/.env" ]; then
        cp "$BACKUP/.env" "${DOMAIN_ROOT}/.env"
        echo "   ✅ คืนค่า .env"
    fi

elif [ -f "${DOMAIN_ROOT}/artisan" ]; then
    echo "📂 Laravel project อยู่ที่ domain root แล้ว (ถูกต้อง)"

else
    echo "📂 ไม่พบ Laravel project - clone ใหม่..."
    cd "${DOMAIN_ROOT}"

    # ลบ public_html default ของ DirectAdmin
    if [ -d "public_html" ]; then
        rm -rf public_html
    fi

    git clone https://github.com/xjanova/ktbaccount.git .
    echo "   ✅ Clone เสร็จ"
fi

# ─── 4/5 ตรวจสอบโครงสร้าง ───
echo ""
echo "=== 4/5 ตรวจสอบโครงสร้าง ==="
cd "${DOMAIN_ROOT}"

if [ ! -f "artisan" ]; then
    echo "   ❌ ไม่พบ artisan - โครงสร้างผิด"
    exit 1
fi

if [ ! -f "public_html/index.php" ]; then
    echo "   ❌ ไม่พบ public_html/index.php"
    exit 1
fi

if [ ! -f "public_html/.htaccess" ]; then
    echo "   ❌ ไม่พบ public_html/.htaccess"
    exit 1
fi

echo "   ✅ artisan              อยู่ที่ ${DOMAIN_ROOT}/"
echo "   ✅ public_html/index.php อยู่ที่ ${PUBLIC_HTML}/"
echo "   ✅ public_html/.htaccess อยู่ที่ ${PUBLIC_HTML}/"
echo "   ✅ โครงสร้างถูกต้อง!"

# ─── 5/5 Fix permissions & rebuild ───
echo ""
echo "=== 5/5 แก้ permissions & rebuild ==="

# Permissions
mkdir -p storage/logs storage/framework/{cache/data,sessions,testing,views} bootstrap/cache
chmod -R 775 storage bootstrap/cache public_html
chown -R admin:admin . 2>/dev/null || true

# APP_KEY check
if grep -q "^APP_KEY=$" .env 2>/dev/null || ! grep -q "^APP_KEY=" .env 2>/dev/null; then
    echo "   🔑 สร้าง APP_KEY..."
    php artisan key:generate --force 2>/dev/null || {
        NEW_KEY="base64:$(openssl rand -base64 32)"
        sed -i "s|^APP_KEY=.*|APP_KEY=${NEW_KEY}|" .env
    }
fi

# Clear cache
php artisan config:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

echo "   ✅ เสร็จสมบูรณ์!"

echo ""
echo "============================================"
echo " ✅ แก้ไขเสร็จ!"
echo "============================================"
echo ""
echo " 🌐 เปิดเว็บ: https://${DOMAIN}"
echo ""
echo " โครงสร้างที่ถูกต้อง:"
echo "   ${DOMAIN_ROOT}/          ← Laravel project root"
echo "   ${DOMAIN_ROOT}/artisan"
echo "   ${DOMAIN_ROOT}/app/"
echo "   ${DOMAIN_ROOT}/vendor/"
echo "   ${DOMAIN_ROOT}/public_html/  ← Apache Document Root"
echo "   ${DOMAIN_ROOT}/public_html/index.php"
echo "   ${DOMAIN_ROOT}/public_html/.htaccess"
echo ""
echo " ถ้ายังเป็น 403 ลองรัน:"
echo "   bash server-setup.sh"
echo ""
echo "============================================"
