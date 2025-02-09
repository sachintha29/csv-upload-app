Orders CSV Import

This project allows you to import orders from a CSV file into the system. It validates the CSV file, processes the data, and stores the orders, customers, and order items in the database.

Installation

1. Clone the repository:

git clone https://github.com/sachintha29/csv-upload-app.git
cd csv-upload-app

2. Install dependencies:

composer install

3. Set up environment:

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password


Update .env with your database credentials.

4. Generate the application key:

php artisan key:generate


5. Run migrate tables

php artisan migrate 

6. Create storage Link

php artisan storage:link
Ensure storage and bootstrap/cache have correct permissions:

chmod -R 775 storage bootstrap/cache


Usage

API Endpoint


POST /api/upload-csv

Request
Upload a CSV file via POST:


curl --location --request POST 'http://localhost:8000/api/upload-csv' \
--header 'Accept: application/json' \
--form 'csv_file=@"/home/sachintha/Music/orders_data.csv"'


Response


{
    "message": "CSV imported successfully!",
    "file_path": "/storage/csv_files/nsWcEEZoGaftpb9F7hQURvMhR47Gm77m65NeSKCX.csv"
}

API Endpoint


Get /api/generate-pdf

Request

Generate Pdf report

curl --location --request GET 'localhost:8000/api/generate-pdf' \
--form 'csv_file=@"/home/sachintha/Music/orders_data.csv"'

Response

{
    "message": "PDF Report generated successfully!",
    "pdf_link": "http://localhost:8000/storage/reports/orders_1739092437.pdf"
}


