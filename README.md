 ```
██████╗ ██╗   ██╗██╗     ██████╗  ██████╗ ████████╗
██╔══██╗██║   ██║██║     ██╔══██╗██╔═══██╗╚══██╔══╝
██████╔╝██║   ██║██║     ██████╔╝██║   ██║   ██║   
██╔═══╝ ██║   ██║██║     ██╔══██╗██║   ██║   ██║   
██║     ╚██████╔╝███████╗██████╔╝╚██████╔╝   ██║   
╚═╝      ╚═════╝ ╚══════╝╚═════╝  ╚═════╝    ╚═╝   
```

# ENTERPRISE RESOURCE PLANNING & WAREHOUSE MANAGEMENT SYSTEM

> Multi-Tenant Manufacturing Control Platform | Telegram-Integrated Workflow Engine

---

## SYSTEM CLASSIFICATION

**PROJECT:** PulBot ERP/CRM  
**VERSION:** 1.0.0  
**LICENSE:** Proprietary  
**PLATFORM:** Docker-Containerized Laravel Stack  
**DATABASE:** PostgreSQL 17 (ACID-Compliant)  
**RUNTIME:** PHP 8.1+ with FPM Process Manager

---

## TABLE OF CONTENTS

```
[01] OVERVIEW ........................... System Architecture & Purpose
[02] TECHNICAL STACK .................... Core Technologies & Dependencies
[03] DEPLOYMENT ......................... Installation & Configuration
[04] AUTHENTICATION ..................... Access Control & Security
[05] TELEGRAM INTEGRATION ............... Bot Interface & Handlers
[06] MODULE DOCUMENTATION ............... Feature Set & Capabilities
[07] OPERATIONS ......................... Maintenance & Monitoring
[08] SECURITY PROTOCOLS ................. Hardening & Best Practices
[09] TROUBLESHOOTING .................... Common Issues & Resolution
[10] DEVELOPMENT ........................ Contributing & Standards
```

---

## [01] OVERVIEW

### SYSTEM ARCHITECTURE

PulBot represents a sophisticated multi-tenant ERP/CRM platform engineered specifically for manufacturing operations, warehouse management, and supply chain coordination. The system implements a containerized microservices architecture with PostgreSQL as the primary data store and Redis for session/cache management.

**ARCHITECTURAL PATTERN:** Model-View-Controller (MVC)  
**DEPLOYMENT MODEL:** Docker Compose Orchestration  
**DATA PERSISTENCE:** PostgreSQL with Eloquent ORM  
**FRONTEND FRAMEWORK:** Livewire (TALL Stack)  
**ADMIN INTERFACE:** Filament 3.x

### CORE CAPABILITIES

```
INVENTORY MANAGEMENT
├── Multi-warehouse stock tracking
├── Real-time transaction processing
├── Granular storage location mapping
└── Automated reorder point alerts

PRODUCTION CONTROL
├── Template-based production workflows
├── Multi-step execution tracking
├── Work station performance metrics
└── Quality control approval chains

SUPPLY CHAIN OPERATIONS
├── Supplier relationship management
├── Purchase order lifecycle
├── Multi-step receiving workflows
└── Price history & currency tracking

TELEGRAM BOT INTERFACE
├── Role-based command handlers
├── Real-time notification system
├── Mobile workflow execution
└── Auth code authentication
```

### DEPLOYMENT TOPOLOGY

```
┌─────────────────────────────────────────────────────────────┐
│                    LOAD BALANCER / PROXY                     │
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌─────────────────────────────────────────────────────────────┐
│                      NGINX (Port 8080)                       │
└─────────────────────────────────────────────────────────────┘
                              │
                              ▼
┌──────────────────────┬──────────────────────┬───────────────┐
│   Laravel App        │   Telegram Bot       │  AI Service   │
│   (PHP-FPM)          │   (Long Polling)     │  (FastAPI)    │
└──────────────────────┴──────────────────────┴───────────────┘
                              │
                    ┌─────────┴─────────┐
                    ▼                   ▼
          ┌──────────────────┐  ┌──────────────┐
          │   PostgreSQL 17  │  │  Redis 7.0   │
          └──────────────────┘  └──────────────┘
```

---

## [02] TECHNICAL STACK

### CORE DEPENDENCIES

```yaml
Backend Runtime:
  - PHP: ^8.1
  - Laravel Framework: ^10.0
  - Filament Admin: ^3.2
  - Livewire: ^3.0

Database Layer:
  - PostgreSQL: 17.2-alpine
  - Eloquent ORM: Native Laravel
  - Predis: ^2.0 (Redis Client)

Frontend:
  - Tailwind CSS: ^3.0
  - Alpine.js: ^3.0
  - Blade Templates: Native Laravel

API Integration:
  - Guzzle HTTP: ^7.2
  - Telegram Bot API: Native Implementation
  - Laravel Sanctum: ^3.3 (API Authentication)

Development Tools:
  - Laravel Debugbar: ^3.14
  - Laravel Pint: ^1.0 (Code Style)
  - PHPUnit: ^10.1 (Testing)
```

### CONTAINERIZATION

```dockerfile
Service Matrix:
├── nginx:1.26.0-alpine ............ Reverse Proxy & Static Assets
├── php:8.2-fpm .................... Application Runtime
├── postgres:17.2-alpine ........... Primary Database
├── redis:7.0-alpine ............... Cache & Session Store
├── dpage/pgadmin4 ................. Database Administration
└── python:3.11-slim ............... AI Service Runtime
```

### DATABASE SCHEMA

```
Total Migrations: 95
Total Tables: 40+
Key Entities:
  - organizations ................ Tenant isolation
  - users ........................ RBAC implementation
  - products ..................... Inventory items
  - work_stations ................ Production facilities
  - prod_orders .................. Manufacturing orders
  - supply_orders ................ Procurement
  - inventories .................. Stock levels
  - inventory_transactions ....... Movement history
```

---

## [03] DEPLOYMENT

### PREREQUISITE ENVIRONMENT

```bash
System Requirements:
  - OS: Linux 4.x+ (Ubuntu 20.04 LTS recommended)
  - Docker: 20.10+
  - Docker Compose: 2.0+
  - Make: GNU Make 4.0+
  - Available RAM: 4GB minimum (8GB recommended)
  - Storage: 20GB+ available space
```

### RAPID DEPLOYMENT PROTOCOL

```bash
# Clone repository
git clone https://github.com/WIKKIwk/Custom_erp-crm.git
cd Custom_erp-crm

# Execute full deployment sequence
make full
```

**DEPLOYMENT SEQUENCE EXECUTED:**
1. Environment configuration preparation
2. Docker image build (production)
3. Container orchestration startup
4. Composer dependency installation
5. Application key generation
6. Database migration execution
7. Initial data seeding
8. Codex agent initialization

### MANUAL DEPLOYMENT SEQUENCE

```bash
# Step 1: Environment Configuration
cp .env.example .env
nano .env  # Configure required variables

# Step 2: Build Production Images
make compose-build-prod

# Step 3: Initialize Services
make compose-up-prod

# Step 4: Application Bootstrap
docker exec pulbot-php composer install --no-interaction --prefer-dist
docker exec pulbot-php php artisan key:generate --force
docker exec pulbot-php php artisan migrate --force
docker exec pulbot-php php artisan db:seed --force

# Step 5: Verify Deployment
docker ps
curl -I http://localhost:8080
```

### CONFIGURATION MATRIX

```env
# CRITICAL ENVIRONMENT VARIABLES

APP_NAME=PulBot
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com
APP_KEY=                              # Auto-generated

DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=pulbot_db
DB_USERNAME=pulbot_user
DB_PASSWORD=                          # REQUIRED: Strong password

TELEGRAM_BOT_TOKEN=                   # REQUIRED: From @BotFather
TELEGRAM_WEBHOOK_SECRET=              # REQUIRED: Random string

CACHE_DRIVER=file                     # Options: file, redis
REDIS_HOST=redis
REDIS_PORT=6379

ADMIN_EMAIL=admin@yourdomain.com
ADMIN_PASSWORD=                       # REQUIRED: Change default
```

### PORT BINDING SCHEME

```
Service Mapping:
  8080 → nginx:80         (HTTP Interface)
  5432 → postgres:5432    (Database - Internal)
  5050 → pgadmin:80       (DB Admin Interface)
  6379 → redis:6379       (Cache - Internal)
  8000 → ai:8000          (AI Service - Internal)
```

---

## [04] AUTHENTICATION

### AUTHENTICATION MECHANISMS

```
Web Interface:
  - Method: Session-based authentication
  - Session Driver: File / Redis (configurable)
  - Password Hashing: Bcrypt (cost factor: 10)
  - CSRF Protection: Token-based (automatic)

API Access:
  - Method: Laravel Sanctum tokens
  - Token Type: Personal Access Tokens
  - Token Lifecycle: Configurable expiration
  - Rate Limiting: Implemented per-route

Telegram Bot:
  - Method: Auth Code verification
  - Code Format: 6-digit alphanumeric
  - Code Lifecycle: Single-use with TTL
  - State Management: File-based cache
```

### ROLE-BASED ACCESS CONTROL

```
Role Hierarchy:
├── SENIOR_PRODUCTION_MANAGER ........ Full production oversight
├── PRODUCTION_MANAGER ............... Production floor control
├── SENIOR_SUPPLY_MANAGER ............ Supply chain leadership
├── SUPPLY_MANAGER ................... Procurement operations
├── SENIOR_STOCK_MANAGER ............. Inventory oversight
├── STOCK_MANAGER .................... Warehouse operations
├── PLANNING_MANAGER ................. Production planning
├── ALLOCATION_MANAGER ............... Resource allocation
├── WORK_STATION_WORKER .............. Production execution
├── AI_ASSISTANT ..................... Automated assistance
└── CODEX ............................ Self-improving agent
```

### INITIAL ACCESS PROCEDURE

```bash
# Step 1: Navigate to web interface
http://localhost:8080

# Step 2: Authenticate with default credentials
Email: admin@pulbot.local
Password: admin123

# Step 3: IMMEDIATELY change password
Profile → Security → Change Password

# Step 4: Generate auth code for Telegram
Profile → Telegram Integration → Generate Code
```

---

## [05] TELEGRAM INTEGRATION

### BOT INITIALIZATION SEQUENCE

```bash
# Step 1: Register bot with BotFather
# Open Telegram, message @BotFather
/newbot
# Follow prompts, receive token format: 123456789:ABCdefGHI...

# Step 2: Configure environment
echo "TELEGRAM_BOT_TOKEN=YOUR_TOKEN_HERE" >> .env

# Step 3: Restart application stack
make restart

# Step 4: Initialize bot process
make bot
# Or for background execution:
docker exec -d pulbot-php php artisan bot:run
```

### AUTHENTICATION PROTOCOL

```
Bot Authentication Flow:
┌──────────────────────────────────────────────┐
│  User sends /login to bot                    │
└────────────┬─────────────────────────────────┘
             │
             ▼
┌──────────────────────────────────────────────┐
│  System creates 5-minute auth window         │
│  Cache key: login_{chat_id} → TTL: 300s      │
└────────────┬─────────────────────────────────┘
             │
             ▼
┌──────────────────────────────────────────────┐
│  User obtains 6-digit code from web UI       │
│  Location: Profile → Auth Code               │
└────────────┬─────────────────────────────────┘
             │
             ▼
┌──────────────────────────────────────────────┐
│  User sends auth code to bot                 │
└────────────┬─────────────────────────────────┘
             │
             ▼
┌──────────────────────────────────────────────┐
│  System validates code & binds chat_id       │
│  User authenticated, cache cleared           │
└────────────┬─────────────────────────────────┘
             │
             ▼
┌──────────────────────────────────────────────┐
│  Bot instantiates role-specific handler      │
│  User presented with role-appropriate menu   │
└──────────────────────────────────────────────┘
```

### HANDLER ARCHITECTURE

```php
Handler Factory Pattern:
HandlerFactory::make(User $user): HandlerInterface

Role Mapping:
  RoleType::PRODUCTION_MANAGER → ProductionManagerHandler
    - View active production orders
    - Approve/reject production steps
    - Monitor work station metrics
    - Assign worker tasks
    
  RoleType::SUPPLY_MANAGER → SupplyManagerHandler
    - Create purchase orders
    - Track supplier deliveries
    - Approve procurement requests
    - Monitor inventory levels
    
  RoleType::STOCK_MANAGER → StockManagerHandler
    - Process receiving operations
    - Assign storage locations
    - View real-time inventory
    - Generate stock reports
    
  RoleType::WORK_STATION_WORKER → WorkerHandler
    - View assigned production tasks
    - Report production quantities
    - Request material replenishment
    - Access work instructions
```

### BOT COMMAND REFERENCE

```
Available Commands:
/start ............... Initialize bot interface (role-specific menu)
/login ............... Begin authentication sequence
/help ................ Display command reference
/status .............. Query current tasks/orders
/profile ............. Display user profile information

Note: Additional commands available based on user role.
All commands require prior authentication except /login.
```

---

## [06] MODULE DOCUMENTATION

### INVENTORY MANAGEMENT SUBSYSTEM

```
Database Schema:
├── inventories
│   ├── product_id (FK → products)
│   ├── warehouse_id (FK → warehouses)
│   ├── quantity (decimal)
│   └── status (enum)
│
├── inventory_transactions
│   ├── product_id (FK → products)
│   ├── warehouse_id (FK → warehouses)
│   ├── work_station_id (FK → work_stations, nullable)
│   ├── supplier_id (FK → suppliers, nullable)
│   ├── quantity (decimal)
│   ├── cost (decimal)
│   └── type (enum: in/out/transfer)
│
└── storage_locations
    ├── warehouse_id (FK → warehouses)
    ├── floor (string)
    ├── row (string)
    ├── column (string)
    └── shelf (string)

Capabilities:
- Real-time stock level tracking across multiple warehouses
- Atomic transaction processing with full audit trail
- Granular location management (floor/row/column/shelf)
- Automated low-stock threshold monitoring
- Multi-warehouse transfer operations
```

### PRODUCTION MANAGEMENT SUBSYSTEM

```
Database Schema:
├── prod_templates
│   ├── name (string)
│   ├── organization_id (FK → organizations)
│   ├── created_by (FK → users)
│   └── deleted_at (soft delete)
│
├── prod_template_steps
│   ├── prod_template_id (FK → prod_templates)
│   ├── work_station_id (FK → work_stations)
│   ├── output_product_id (FK → products)
│   ├── step_order (integer)
│   ├── measure_unit (enum)
│   └── is_last (boolean)
│
├── prod_orders
│   ├── number (generated)
│   ├── prod_template_id (FK → prod_templates)
│   ├── quantity_required (decimal)
│   ├── quantity_produced (decimal)
│   ├── agent_id (FK → agents)
│   ├── warehouse_id (FK → warehouses)
│   ├── status (enum)
│   ├── started_at (timestamp)
│   ├── confirmed_at (timestamp)
│   └── completed_at (timestamp)
│
└── prod_order_step_executions
    ├── prod_order_step_id (FK → prod_order_steps)
    ├── worker_id (FK → users)
    ├── quantity_produced (decimal)
    ├── approved_by (FK → users, nullable)
    ├── rejected_by (FK → users, nullable)
    ├── approved_at (timestamp, nullable)
    └── declined_at (timestamp, nullable)

Production Workflow:
[Template Creation] → [Order Generation] → [Step Assignment]
        ↓
[Worker Execution] → [Manager Approval] → [Inventory Update]
        ↓
[Quality Control] → [Order Completion] → [Metrics Recording]
```

### SUPPLY CHAIN SUBSYSTEM

```
Database Schema:
├── organization_partners (suppliers)
│   ├── name (string)
│   ├── organization_id (FK → organizations)
│   └── deleted_at (soft delete)
│
├── organization_partner_products
│   ├── partner_id (FK → organization_partners)
│   ├── product_id (FK → products)
│   ├── price (decimal)
│   └── currency (enum)
│
├── supply_orders
│   ├── number (generated)
│   ├── supplier_id (FK → organization_partners)
│   ├── warehouse_id (FK → warehouses)
│   ├── prod_order_id (FK → prod_orders, nullable)
│   ├── state (enum: draft/submitted/delivered/closed)
│   └── processed (boolean)
│
└── supply_order_products
    ├── supply_order_id (FK → supply_orders)
    ├── product_id (FK → products)
    ├── expected_quantity (decimal)
    ├── actual_quantity (decimal, nullable)
    └── price (decimal)

Procurement Workflow:
[Supplier Selection] → [Order Creation] → [Approval Chain]
        ↓
[Supplier Notification] → [Delivery Tracking] → [Receipt Processing]
        ↓
[Quantity Verification] → [Location Assignment] → [Inventory Update]
```

---

## [07] OPERATIONS

### MONITORING PROTOCOLS

```bash
# Container Health Check
docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"

# Resource Utilization
docker stats --no-stream

# Application Logs
tail -f storage/logs/laravel.log

# Database Connection Pool
docker exec pulbot-db psql -U pulbot_user -d pulbot_db -c "SELECT * FROM pg_stat_activity;"

# Cache Hit Rate (if using Redis)
docker exec pulbot-redis redis-cli INFO stats | grep hit_rate
```

### BACKUP PROCEDURES

```bash
# Database Backup
docker exec pulbot-db pg_dump -U pulbot_user pulbot_db > backup_$(date +%Y%m%d_%H%M%S).sql

# Automated Backup (crontab)
0 2 * * * /path/to/pulbot && make backup

# Storage Backup
tar -czf storage_backup_$(date +%Y%m%d).tar.gz storage/

# Configuration Backup
cp .env .env.backup_$(date +%Y%m%d)
```

### UPDATE PROCEDURES

```bash
# Application Update Sequence
git pull origin main
make composer update
make artisan migrate --force
make artisan cache:clear
make artisan config:clear
make artisan view:clear
make restart

# Docker Image Rebuild
make build
make compose-down
make compose-up-prod
```

---

## [08] SECURITY PROTOCOLS

### HARDENING CHECKLIST

```
[X] Change all default credentials
[X] Generate strong APP_KEY (32-character minimum)
[X] Use HTTPS in production (TLS 1.2+)
[X] Configure firewall rules (restrict port access)
[X] Enable PostgreSQL SSL connections
[X] Implement rate limiting on API routes
[X] Regular dependency updates (composer update)
[X] Database connection encryption
[X] Secure Telegram webhook endpoint
[X] Implement CSP headers
[X] Regular security audits
```

### ENCRYPTION STANDARDS

```
Application Level:
  - Session Data: AES-256-CBC
  - Passwords: Bcrypt (cost: 10)
  - API Tokens: SHA-256 hashed
  - Database Connections: TLS 1.2+

Transport Layer:
  - HTTPS: TLS 1.2+ (production mandatory)
  - Certificate: Let's Encrypt / Commercial CA
  - HSTS: Enabled with preload
```

### VULNERABILITY DISCLOSURE

```
Security Contact: security@yourorganization.com
PGP Key: [Insert PGP Public Key ID]
Response Time: 48 hours maximum
Disclosure Policy: Responsible disclosure (90-day window)

DO NOT create public issues for security vulnerabilities.
```

---

## [09] TROUBLESHOOTING

### COMMON ISSUES & RESOLUTION

```
ISSUE: Bot not responding to commands
DIAGNOSIS:
  - Check bot process: docker exec pulbot-php ps aux | grep bot
  - Verify Telegram token: echo $TELEGRAM_BOT_TOKEN
  - Review bot logs: docker logs pulbot-php | grep bot

RESOLUTION:
  docker exec -d pulbot-php php artisan bot:run

---

ISSUE: Database connection refused
DIAGNOSIS:
  - Check PostgreSQL status: docker ps | grep db
  - Test connectivity: docker exec pulbot-php pg_isready -h db -U pulbot_user
  - Review credentials: grep DB_ .env

RESOLUTION:
  docker restart pulbot-db
  docker restart pulbot-php

---

ISSUE: Permission denied errors
DIAGNOSIS:
  - Check file ownership: ls -la storage/
  - Verify permissions: stat storage/

RESOLUTION:
  docker exec -u root pulbot-php chown -R www-data:www-data storage bootstrap/cache

---

ISSUE: Redis connection failures
DIAGNOSIS:
  - Check Redis status: docker ps | grep redis
  - Test connectivity: docker exec pulbot-php redis-cli -h redis ping

RESOLUTION:
  # Fallback to file cache
  sed -i 's/CACHE_DRIVER=redis/CACHE_DRIVER=file/' .env
  make restart
```

---

## [10] DEVELOPMENT

### CONTRIBUTING GUIDELINES

```
Code Standards:
  - PSR-12 compliance (PHP coding standard)
  - Laravel best practices
  - Meaningful variable/function names
  - Comprehensive inline documentation
  - Type hints on all function signatures

Git Workflow:
  1. Fork repository
  2. Create feature branch (feature/description)
  3. Implement changes with atomic commits
  4. Write/update tests (PHPUnit)
  5. Ensure all tests pass
  6. Submit pull request with detailed description

Commit Message Format:
  type(scope): subject
  
  Types: feat, fix, docs, style, refactor, test, chore
  Example: feat(inventory): add multi-warehouse transfer functionality
```

### TESTING PROTOCOL

```bash
# Execute full test suite
docker exec pulbot-php php artisan test

# Run specific test class
docker exec pulbot-php php artisan test --filter=UserTest

# Generate coverage report
docker exec pulbot-php php artisan test --coverage

# Test with specific environment
docker exec pulbot-php php artisan test --env=testing
```

### PROJECT STRUCTURE

```
pulbot-erp/
├── app/
│   ├── Console/Commands/      # Artisan commands (bot:run, etc.)
│   ├── Filament/Resources/    # Admin panel resources (17 modules)
│   ├── Http/Controllers/      # HTTP request handlers
│   ├── Models/                # Eloquent ORM models
│   ├── Services/              # Business logic layer
│   │   ├── Handler/           # Telegram bot handlers (7 roles)
│   │   ├── Cache/             # Cache abstraction
│   │   └── TgBot/             # Telegram bot service
│   └── Providers/             # Service providers
├── database/
│   ├── migrations/            # Schema migrations (95 files)
│   └── seeders/               # Database seeders
├── docker-compose.yml         # Development orchestration
├── docker-compose-prod.yml    # Production orchestration
├── _docker/                   # Docker configurations
│   ├── development/           # Dev environment
│   └── production/            # Prod environment
└── makefile                   # Build automation
```

---

## MAKEFILE REFERENCE

```bash
make full ................... Full production deployment
make start .................. Quick start (development)
make restart ................ Restart all services
make compose-up ............. Start development containers
make compose-down ........... Stop all containers
make bot .................... Start Telegram bot (foreground)
make artisan [cmd] .......... Execute Laravel Artisan command
make composer [cmd] ......... Execute Composer command
make backup ................. Database backup
make codex-loop ............. Start Codex agent (background)
make codex-logs ............. View Codex agent logs
```

---

## SYSTEM INFORMATION

```
Project: PulBot ERP/CRM
Version: 1.0.0
License: Proprietary - All Rights Reserved
Repository: https://github.com/WIKKIwk/Custom_erp-crm
Documentation: Technical documentation included in-repository

Copyright (c) 2025 PulBot Development Team
Unauthorized access, reproduction, or distribution prohibited.
```

---

## TECHNICAL SUPPORT

```
For technical inquiries or support requests:

Primary Contact: support@yourorganization.com
Issue Tracker: https://github.com/WIKKIwk/Custom_erp-crm/issues
Response SLA: 24-48 hours (business days)

Note: Include system logs, error messages, and environment details
      in all support requests for expedited resolution.
```

---

**END OF DOCUMENTATION**

```
Last Updated: 2025-12-25
Revision: 2.0
Maintainer: Systems Engineering Team
```
