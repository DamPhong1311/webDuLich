# Hướng dẫn chạy dự án

2. Cài đặt dependencies PHP:

    ```bash
    composer install
    ```

3. Tạo file môi trường:

    ```bash
    cp .env.example .env
    ```

4. Tạo APP_KEY:

    ```bash
    php artisan key:generate
    ```

5. Cấu hình file `.env`:

    ```
    APP_URL=http://localhost:8000
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ten_db
    DB_USERNAME=ten_user
    DB_PASSWORD=mat_khau
    ```

6. Chạy migrate và seed (nếu có):

    ```bash
    php artisan migrate --seed
    ```

7. Cài đặt và build frontend:

    ```bash
    npm install
    npm run dev
    ```

8. Tạo symbolic link cho storage:

    ```bash
    php artisan storage:link
    ```

9. Phân quyền (Linux/macOS):

    ```bash
    chmod -R 775 storage bootstrap/cache
    ```

10. Chạy server:

```bash
php artisan serve
```

Truy cập: http://127.0.0.1:8000

11. chạy npm i leaflet leaflet.markercluster

12. chạy npm run dev
    nhớ chạy song song với php artisan serve

Cập nhật: {datetime.now().strftime("%d/%m/%Y")}
