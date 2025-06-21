📦 Laravel 12 Inventory API

A RESTful Laravel 12 backend for managing products with CRUD operations and user authentication using **Laravel Sanctum**. Supports basic role-based access control (admin vs staff).

---

## 🚀 Features

- Laravel 12 + Sanctum authentication
- Register/login endpoints
- Product CRUD API
- Role-based access (`admin` can create/delete, `staff` can only view)
- SKU generation
- Validation and structured API responses

---

## 🛠️ Requirements

- PHP >= 8.2
- Composer
- MySQL or any supported DB
- Laravel CLI


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
GET BASE_URL/api/product

json response
[
    {
        "id": 1,
        "name": "Rounded Neck R shirt",
        "sku": "ROUNDED-NECK-T-SHIRT-YAC1S",
        "quantity": "10",
        "status": "A",
        "cost_price": 92,
        "selling_price": 99,
        "last_used_at": null,
        "expires_at": null,
        "created_at": "2025-06-21T03:00:08.000000Z",
        "updated_at": "2025-06-21T03:03:36.000000Z"
    },
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
    },
    {
        "id": 3,
        "name": "Rounded Neck TOP shirt",
        "sku": "ROUNDED-NECK-TOP-SHIRT-MDJVM",
        "quantity": "10",
        "status": "A",
        "cost_price": 92,
        "selling_price": 99,
        "last_used_at": null,
        "expires_at": null,
        "created_at": "2025-06-21T03:38:55.000000Z",
        "updated_at": "2025-06-21T03:38:55.000000Z"
    }
]


✅ List Products by id
GET BASE_URL/api/viewproduct/{product_id}

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
POST BASE_URL/api/createproduct

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
POST BASE_URL/api/updateproduct/{product_id}

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

➕ Delete Product
POST BASE_URL/api/deleteproduct/{product_id}

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


➕ Set Product Status to Available
POST BASE_URL/api/availproduct/{product_id}

➕ Set Product Status to Unavailable
POST BASE_URL/api/unavailproduct/{product_id}

➕ Get User Details
POST BASE_URL/api/get_user

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
POST BASE_URL/api/logout





