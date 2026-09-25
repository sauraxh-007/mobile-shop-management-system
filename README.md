# Mobile Shop & Repair Management System

## 📌 Project Overview

The **Mobile Shop & Repair Management System** is a unified business management application designed for a local mobile shop that provides both **mobile/product sales and repair services**.

The system replaces traditional paper-based registers and separate records with a centralized digital system. It manages product inventory, sales billing, repair jobs, customer information, and business reports through a single database.

The main purpose of the system is to make day-to-day shop operations more organized, accurate, traceable, and efficient.

---

## 🎯 Objectives

The major objectives of this project are:

* To develop a single system for managing both mobile sales and repair services.
* To maintain accurate and up-to-date inventory of phones, accessories, and spare parts.
* To provide a fast and reliable billing system.
* To support automatic calculation of discounts, taxes, and total amounts.
* To digitize the complete repair process from device intake to delivery.
* To maintain customer purchase and repair history.
* To provide role-based access for Admin, Sales Staff, and Technician.
* To generate useful reports related to sales, repairs, and inventory.

---

## 🏪 Problem Statement

Traditional mobile shops often manage sales, inventory, and repair activities using paper registers or separate systems.

This can create several problems such as:

* Difficulty in maintaining accurate stock records.
* Manual errors during billing.
* Difficulty tracking repair status.
* Lack of centralized customer history.
* Difficulty monitoring spare-part usage.
* Time-consuming preparation of business reports.
* Lack of proper role-based access to business information.

This project addresses these problems by providing a centralized management system connected to a common database.

---

## 💡 Proposed Solution

The proposed system combines the major operations of a mobile shop into one application.

The system provides separate modules for:

1. **Inventory Management**
2. **Sales & Billing**
3. **Repair Management**
4. **Customer Management**
5. **Reports**
6. **User Authentication & Role Management**

All modules work with a shared database so that information can be updated and accessed consistently throughout the system.

For example, when a product is sold, its stock quantity is automatically reduced. Similarly, when a spare part is used during a repair, the corresponding inventory quantity is updated.

---

# ✨ Key Features

## 1. Inventory Management

The inventory module allows authorized users to add, update, and remove products from the system.

The system can maintain information such as:

* Item name
* Brand
* Model
* IMEI/Serial Number
* Cost price
* Selling price
* Quantity
* Supplier

The system also provides updated stock information and can identify low-stock items.

---

## 2. Sales & Billing

The billing module is used by Sales Staff to generate bills for customer purchases.

It supports:

* Product selection
* Quantity selection
* Discount calculation
* Tax calculation
* Payment mode selection
* Invoice generation
* Automatic stock deduction

The generated invoice contains important billing information such as subtotal, tax, discount, and final payable amount.

---

## 3. Repair Management

The repair module manages the complete repair lifecycle of a customer's device.

A repair ticket contains information such as:

* Customer details
* Device model
* IMEI number
* Problem description
* Estimated cost
* Assigned technician
* Repair status
* Parts used

The repair status can progress through stages such as:

**Received → Diagnosed → In Repair → Ready → Delivered**

This allows shop staff to easily determine the current status of every repair job.

---

## 4. Spare Parts Management

Spare parts used during repairs are connected with the inventory system.

Whenever a technician records a part as being used for a repair, the corresponding quantity can be deducted from available stock.

This helps the shop maintain better control over spare-part inventory.

---

## 5. Customer Management

The system maintains basic customer information and provides access to customer history.

Staff can use the system to view:

* Previous purchases
* Previous repair jobs
* Device information
* Repair history

This makes it easier to handle returning customers.

---

## 6. Reports

The reporting module allows the Admin to view business information for a selected period.

Reports may include:

* Sales summary
* Repair income
* Inventory status
* Stock value
* Pending repairs
* Pending dues

These reports can help the shop owner monitor daily business activities.

---

# 👥 User Roles

The system provides role-based access for different users.

### Admin

The Admin has the highest level of access and can:

* Manage inventory
* Manage users
* View reports
* Monitor sales
* Monitor repairs
* View business information

### Sales Staff

Sales Staff can:

* Manage permitted inventory operations
* Generate customer bills
* Create repair tickets
* Handle customer information
* Process sales transactions

### Technician

The Technician mainly handles repair-related operations.

The Technician can:

* View assigned repair tickets
* Update repair status
* Record parts used
* Update repair progress

### Customer

The Customer is considered a secondary actor. The customer interacts with the shop by purchasing products or submitting a device for repair.

---

# ⚙️ Functional Requirements

| ID   | Requirement                       | Main Actor         |
| ---- | --------------------------------- | ------------------ |
| FR-1 | Add/Manage Inventory Item         | Admin, Sales Staff |
| FR-2 | Sales Billing (POS)               | Sales Staff        |
| FR-3 | Create Repair Ticket              | Sales Staff        |
| FR-4 | Update Repair Status / Parts Used | Technician         |
| FR-5 | Generate Reports                  | Admin              |

### FR-1: Add/Manage Inventory Item

Allows authorized users to add, edit, or remove phones, accessories, and spare parts.

### FR-2: Sales Billing

Allows Sales Staff to generate bills for customer purchases and automatically update stock.

### FR-3: Create Repair Ticket

Allows Sales Staff to register a customer's repair request and create a repair ticket.

### FR-4: Update Repair Status / Parts Used

Allows Technicians to update repair progress and record spare parts consumed during repair.

### FR-5: Generate Reports

Allows Admin to generate summaries related to sales, repairs, inventory, and other business information.

---

# 🔐 Authentication & Authorization

The system uses user authentication to ensure that only authorized users can access the application.

Different users receive different permissions according to their roles.

For example:

* Admin → Administrative and reporting operations
* Sales Staff → Sales and permitted inventory operations
* Technician → Repair-related operations

This prevents users from accessing functions outside their assigned responsibilities.

---

# 🔄 Repair Workflow

The general repair workflow is:

```text
Customer brings device
        ↓
Repair Ticket Created
        ↓
Device Received
        ↓
Diagnosis
        ↓
Repair In Progress
        ↓
Parts Used / Repair Updated
        ↓
Device Ready
        ↓
Device Delivered
```

The repair ticket maintains the current status of the device throughout this process.

---

# 🏗️ System Modules

The project is divided into the following major modules:

```text
Mobile Shop & Repair Management System
│
├── User Authentication
│
├── Inventory Management
│
├── Sales & Billing
│
├── Repair Management
│
├── Customer Management
│
└── Reports
```

The modules are connected through a shared database so that changes in one module can be reflected in other relevant modules.

---

# 🔄 Software Development Model

The project follows the **Agile Development Model**.

Agile was selected because the system contains clearly separable modules that can be developed and tested incrementally.

The development can be divided into multiple sprints, for example:

### Sprint 1

* Inventory Management
* Basic Billing

### Sprint 2

* Repair Management
* Repair Status Tracking

### Sprint 3

* Reports
* Additional improvements

Each sprint produces a working part of the system that can be reviewed and improved.

This approach also allows unnecessary or complex features to be simplified or removed without affecting the core system.

---

# 📊 System Modeling

The project uses different UML diagrams to represent the system structure and behavior.

The following diagrams are included:

### Use Case Diagram

Shows the interaction between system actors and major system functions.

### Class Diagram

Represents the main classes, their attributes, operations, and relationships.

### Activity Diagram

Represents the flow of activities within important system processes.

### Sequence Diagram

Shows the sequence of interactions between users and system components.

### State Diagram

Represents different states of a repair ticket and transitions between those states.

### Deployment Diagram

Represents the deployment structure of the application and its major components.

---

# 🧪 Testing Approach

Each major component of the system should be tested independently before complete system integration.

Important test areas include:

* Inventory quantity updates
* Billing calculations
* Tax and discount calculations
* Stock deduction after sales
* Spare-part deduction during repairs
* Repair status transitions
* User role permissions
* Report generation

For example, when a product is sold, the system should correctly reduce its available quantity. Similarly, when a technician records a spare part as used, the inventory should reflect the updated quantity.

---

# 📋 Example Use Cases

## User Registration & Login

**Actors:** Admin, Sales Staff, Technician

**Goal:**
To create a system account and securely log in using role-based access.

**Precondition:**
The user has valid credentials provided or approved by the Admin.

**Trigger:**
A new user requires system access or an existing user wants to log in.

---

## Add/Manage Inventory Item

**Actors:** Admin, Sales Staff

**Goal:**
To keep stock records of phones, accessories, and spare parts accurate and updated.

**Precondition:**
The user is logged in and has permission to manage inventory.

**Trigger:**
New stock arrives or an existing stock record needs to be corrected or removed.

---

## Sales Billing

**Actor:** Sales Staff

**Goal:**
To generate an accurate bill for a customer purchase and update stock automatically.

**Precondition:**
The Sales Staff is logged in and the selected items are available in stock.

**Trigger:**
A customer selects products for purchase.

---

## Create Repair Ticket

**Actor:** Sales Staff

**Goal:**
To register a new repair request and begin tracking the repair process.

**Precondition:**
The Sales Staff is logged in and customer/device details are available.

**Trigger:**
A customer brings a device to the shop for repair.

---

## Generate Reports

**Actor:** Admin

**Goal:**
To view sales, repair, and inventory summaries for business monitoring.

**Precondition:**
The Admin is logged in.

**Trigger:**
The Admin requests a report by selecting the required report type and date range.

---

# 📁 Project Structure

A possible project structure is:

```text
Mobile-Shop-Repair-Management/
│
├── README.md
├── src/
│   ├── authentication/
│   ├── inventory/
│   ├── billing/
│   ├── repair/
│   ├── customer/
│   └── reports/
│
├── database/
│   └── database.sql
│
├── documentation/
│   └── UML-Diagrams/
│
└── screenshots/
```

The exact implementation structure may change according to the technologies used during development.

---

# 🚀 Future Scope

The current system focuses on the core requirements of a mobile shop and repair business.

Possible future improvements include:

* Online customer portal
* SMS/WhatsApp repair notifications
* Automated invoice sharing
* Advanced sales analytics
* Supplier management
* Warranty tracking
* Customer loyalty features
* Mobile application
* Online appointment booking
* Cloud-based deployment
* Automated backup system

These features can be considered after the core inventory, billing, and repair modules are completed.

---

# 🎓 Project Information

**Project:** Mobile Shop & Repair Management System

**Institute:**
Asha M. Tarsadia Institute of Computer Science and Technology

**Department:**
Computer Science and Engineering

**Prepared By:**
Pandey Saurabh Kumar Yogendra

**Enrollment No.:**
202503103510238

**Guided By:**
Professor Halak Patel

---

# 📌 Conclusion

The Mobile Shop & Repair Management System provides a centralized approach to managing the major operations of a mobile shop.

By combining inventory, billing, repair management, customer records, and reporting into one system, the project aims to reduce manual work and improve the accuracy and traceability of shop operations.

The modular structure and Agile development approach allow the system to be developed incrementally, tested module by module, and refined according to practical business requirements.
