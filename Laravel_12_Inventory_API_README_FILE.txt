📦 Laravel 12 Inventory API/v1

A RESTful Laravel 12 backend for managing products with CRUD operations and user authentication using **Laravel Sanctum**. Supports basic role-based access control (admin vs staff).

---

## 🚀 Features

- Laravel 12 + Sanctum authentication
- Register/login endpoints
- Product CRUD API
- Role-based access (`admin` can create/delete, `staff` can only view)
- SKU generation
- Validation and structured API/v1 responses

---

## 🛠️ Requirements

- PHP >= 8.2
- Composer
- MySQL or any supported DB
- Laravel CLI

Steps to integrate the project
1. Unzip the file
2. Create a DB called Crud on your local host
3. Migrate the db(php artisan migrate)
4. Insert dummy data created into the db (php artisan migrate:fresh --seed)
5. Login details for the following users
    admin => email: admin@example.com, password: password
    staff => email: staff@example.com, password: password 

Endpoint using Postman
BASE_URL = http://127.0.0.1:8000
🔐 Authentication
📌 Register
POST BASE_URL/api/register

Body (JSON):
{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "password",
  "role": "admin"
}

📌 Login
POST BASE_URL/api/login

Body (JSON):

json
{
  "email": "jane@example.com",
  "password": "password"
}

Response:

json
{
  "token": "eyJ0eXAiOiJKV1QiLCJhb..."
}


📦 Product Management (Requires Auth token)
✅ List all Products
GET BASE_URL/api/v1/product

json response
[
    {
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "aspernatur",
            "sku": "SKU042",
            "quantity": "195",
            "status": "A",
            "cost_price": 58138,
            "selling_price": 122827,
            "created_by": 1,
            "updated_by": null,
            "created_at": "2025-06-24T07:46:12.000000Z",
            "updated_at": "2025-06-24T07:46:12.000000Z"
        },
        {
            "id": 2,
            "name": "pariatur",
            "sku": "SKU918",
            "quantity": "32",
            "status": "A",
            "cost_price": 91444,
            "selling_price": 94946,
            "created_by": 1,
            "updated_by": null,
            "created_at": "2025-06-24T07:46:12.000000Z",
            "updated_at": "2025-06-24T07:46:12.000000Z"
        },
        {
            "id": 3,
            "name": "nobis",
            "sku": "SKU461",
            "quantity": "386",
            "status": "A",
            "cost_price": 93546,
            "selling_price": 117596,
            "created_by": 1,
            "updated_by": null,
            "created_at": "2025-06-24T07:46:12.000000Z",
            "updated_at": "2025-06-24T07:46:12.000000Z"
        },
        {
            "id": 4,
            "name": "exercitationem",
            "sku": "SKU282",
            "quantity": "126",
            "status": "A",
            "cost_price": 17747,
            "selling_price": 139627,
            "created_by": 1,
            "updated_by": null,
            "created_at": "2025-06-24T07:46:12.000000Z",
            "updated_at": "2025-06-24T07:46:12.000000Z"
        },
        {
            "id": 5,
            "name": "maiores",
            "sku": "SKU542",
            "quantity": "457",
            "status": "A",
            "cost_price": 80989,
            "selling_price": 14974,
            "created_by": 1,
            "updated_by": null,
            "created_at": "2025-06-24T07:46:12.000000Z",
            "updated_at": "2025-06-24T07:46:12.000000Z"
        },
        {
            "id": 6,
            "name": "quisquam",
            "sku": "SKU488",
            "quantity": "12",
            "status": "A",
            "cost_price": 71068,
            "selling_price": 75548,
            "created_by": 1,
            "updated_by": null,
            "created_at": "2025-06-24T07:46:12.000000Z",
            "updated_at": "2025-06-24T07:46:12.000000Z"
        },
        {
            "id": 7,
            "name": "aut",
            "sku": "SKU075",
            "quantity": "180",
            "status": "A",
            "cost_price": 37521,
            "selling_price": 122547,
            "created_by": 1,
            "updated_by": null,
            "created_at": "2025-06-24T07:46:12.000000Z",
            "updated_at": "2025-06-24T07:46:12.000000Z"
        },
        {
            "id": 8,
            "name": "dolorem",
            "sku": "SKU391",
            "quantity": "140",
            "status": "A",
            "cost_price": 84919,
            "selling_price": 143098,
            "created_by": 1,
            "updated_by": null,
            "created_at": "2025-06-24T07:46:12.000000Z",
            "updated_at": "2025-06-24T07:46:12.000000Z"
        },
        {
            "id": 9,
            "name": "animi",
            "sku": "SKU406",
            "quantity": "163",
            "status": "A",
            "cost_price": 27001,
            "selling_price": 98612,
            "created_by": 1,
            "updated_by": null,
            "created_at": "2025-06-24T07:46:12.000000Z",
            "updated_at": "2025-06-24T07:46:12.000000Z"
        },
        {
            "id": 10,
            "name": "magnam",
            "sku": "SKU965",
            "quantity": "243",
            "status": "A",
            "cost_price": 98702,
            "selling_price": 120372,
            "created_by": 1,
            "updated_by": null,
            "created_at": "2025-06-24T07:46:12.000000Z",
            "updated_at": "2025-06-24T07:46:12.000000Z"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/v1/v1/products?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http://127.0.0.1:8000/api/v1/v1/products?page=2",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/v1/products?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/v1/products?page=2",
            "label": "2",
            "active": false
        },
        {
            "url": "http://127.0.0.1:8000/api/v1/v1/products?page=2",
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": "http://127.0.0.1:8000/api/v1/v1/products?page=2",
    "path": "http://127.0.0.1:8000/api/v1/v1/products",
    "per_page": 10,
    "prev_page_url": null,
    "to": 10,
    "total": 20
}
]


✅ List Products by id
GET BASE_URL/api/v1/viewproduct/{product_id}

json

{
   "id": 2,
   "name": "Rounded Neck U shirt",
   "sku": "ROUNDED-NECK-U-SHIRT-YVNRI",
   "quantity": "10",
   "status": "A",
   "cost_price": 92,
   "selling_price": 99,
   "last_used_at": null,
   "expires_at": null,
   "created_at": "2025-06-21T03:00:43.000000Z",
   "updated_at": "2025-06-21T03:00:43.000000Z"
 }


➕ Create Product
POST BASE_URL/api/v1/createproduct

Body (JSON):

json

{
    "id": 3
    "name": "Rounded Neck TOP shirt",
    "sku": "ROUNDED-NECK-TOP-SHIRT-MDJVM",
    "quantity": "10",
    "status": "A",
    "cost_price": "92",
    "selling_price": "99",
}


➕ Update Product
POST BASE_URL/api/v1/updateproduct/{product_id}

Body (JSON):

{
    "name": "Rounded Neck TOP shirt",
    "sku": "ROUNDED-NECK-TOP-SHIRT-MDJVM",
    "quantity": "10",
    "status": "A",
    "cost_price": "92",
    "selling_price": "99",
 }

➕ Delete Product
POST BASE_URL/api/v1/deleteproduct/{product_id}

Body (JSON):

json

{
    "id": 3
    "name": "Rounded Neck TOP shirt",
    "sku": "ROUNDED-NECK-TOP-SHIRT-MDJVM",
    "quantity": "10",
    "status": "D",
    "cost_price": "92",
    "selling_price": "99",
}


➕ Set Product Status to Available
POST BASE_URL/api/v1/availproduct/{product_id}

➕ Set Product Status to Unavailable
POST BASE_URL/api/v1/unavailproduct/{product_id}

➕ Get User Details
POST BASE_URL/api/v1/get_user

json response

{
  "name": "Jane Doe",
  "email": "jane@example.com",
  "password": "password",
  "role": "admin"
  "created_at": "2025-06-21T02:08:28.000000Z",
  "updated_at": "2025-06-21T02:08:28.000000Z"
}

➕ Logout
POST BASE_URL/api/v1/logout

➕ Export xlsx file
POST BASE_URL/api/v1/export




