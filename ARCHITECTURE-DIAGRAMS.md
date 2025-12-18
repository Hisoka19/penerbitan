# Platform Architecture & Flow Diagrams

## 🏗️ System Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                     PLATFORM PENERBITAN BUKU                     │
│                    (Book Publishing Platform)                    │
└─────────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────────┐
│                          USERS LAYER                             │
├──────────────┬──────────────┬──────────────┬──────────────────┤
│   PENULIS    │    EDITOR    │   PENERBIT   │     PEMBACA      │
│  (Authors)   │  (Editors)   │ (Publishers) │    (Readers)     │
│              │              │              │                  │
│ • Submit     │ • Review     │ • Manage     │ • Browse         │
│ • Track      │ • Feedback   │ • Assign     │ • Purchase       │
│ • Revise     │ • Approve    │ • Monitor    │ • Review         │
│ • Publish    │ • Payment    │ • Analytics  │ • Rate           │
└──────┬───────┴──────┬───────┴──────┬───────┴────────┬─────────┘
       │              │              │                │
┌──────▼──────────────▼──────────────▼────────────────▼─────────┐
│                    WEB APPLICATION LAYER                        │
│  ┌───────────────┐  ┌───────────────┐  ┌───────────────┐     │
│  │  Auth System  │  │  Dashboard    │  │   API Layer   │     │
│  │  (Breeze)     │  │  (Multi-role) │  │  (RESTful)    │     │
│  └───────────────┘  └───────────────┘  └───────────────┘     │
└────────────────────────────┬───────────────────────────────────┘
                             │
┌────────────────────────────▼───────────────────────────────────┐
│                    APPLICATION LAYER                            │
│  ┌─────────────────────────────────────────────────────────┐   │
│  │              LARAVEL FRAMEWORK (PHP 8.2+)               │   │
│  │  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌────────┐ │   │
│  │  │Controllers│ │ Services  │ │  Models  │  │ Events │ │   │
│  │  └──────────┘  └──────────┘  └──────────┘  └────────┘ │   │
│  │  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌────────┐ │   │
│  │  │Validation│ │Middleware │ │  Queues  │  │ Jobs   │ │   │
│  │  └──────────┘  └──────────┘  └──────────┘  └────────┘ │   │
│  └─────────────────────────────────────────────────────────┘   │
└────────────────────────────┬───────────────────────────────────┘
                             │
┌────────────────────────────▼───────────────────────────────────┐
│                       DATA LAYER                                │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │            PostgreSQL Database (v15+)                    │  │
│  │  ┌─────────┐  ┌─────────┐  ┌─────────┐  ┌──────────┐  │  │
│  │  │  Users  │  │ Profiles│  │  Books  │  │ Reviews  │  │  │
│  │  └─────────┘  └─────────┘  └─────────┘  └──────────┘  │  │
│  │  ┌─────────┐  ┌─────────┐  ┌─────────┐  ┌──────────┐  │  │
│  │  │ Status  │  │StatusLog│  │  Bank   │  │Categories│  │  │
│  │  └─────────┘  └─────────┘  └─────────┘  └──────────┘  │  │
│  │                                                          │  │
│  │  Features: UUID, JSONB, Full-text Search, Foreign Keys  │  │
│  └──────────────────────────────────────────────────────────┘  │
└────────────────────────────┬───────────────────────────────────┘
                             │
┌────────────────────────────▼───────────────────────────────────┐
│                   EXTERNAL SERVICES LAYER                       │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐         │
│  │  File Storage│  │Payment Gateway│ │Email Service │         │
│  │  (S3/Local)  │  │ (Bank APIs)   │ │   (SMTP)     │         │
│  └──────────────┘  └──────────────┘  └──────────────┘         │
└─────────────────────────────────────────────────────────────────┘
```

---

## 📊 User Flow Diagrams

### Flow 1: Author Submission Journey

```
START (New Author)
     │
     ▼
[Register Account] ──────────► Verify Email
     │
     ▼
[Complete Profile] ──────────► Add Bank Info, Bio, Photo
     │
     ▼
[Upload Manuscript]
     │
     ├─► Upload File (PDF/DOCX)
     ├─► Add Cover Images (Front/Back)
     ├─► Fill Metadata (Title, Synopsis, ISBN, etc)
     └─► Select Categories & Language
     │
     ▼
[Submit for Review] ──────────► Status: "Submitted"
     │
     ▼
[Auto-assign Editor] ──────────► Notification sent
     │
     ▼
[Editor Reviews] ──────────────► Status: "Under Review"
     │
     ├─► [Approved] ─────────────► Status: "Approved" ──► GO TO PUBLISH
     │
     └─► [Need Revision] ────────► Status: "Revision Required"
               │
               ▼
          [Author Updates] ──────► Resubmit ──► LOOP BACK
               │
               ▼
[Ready to Publish] ────────────► Status: "Publishing"
     │
     ▼
[Published] ───────────────────► Status: "Published"
     │                            Book live in catalog
     ▼
[Monitor Performance]
     │
     ├─► Track Sales
     ├─► View Reviews
     ├─► Check Royalties
     └─► Receive Payments (Auto)
     │
     ▼
END (Successful Publication)

⏱️ Timeline: ~30 days (vs 12 months traditional)
```

---

### Flow 2: Editor Workflow

```
START (Editor User)
     │
     ▼
[Login to Dashboard]
     │
     ▼
[View Assigned Manuscripts] OR [Browse Available Projects]
     │                              │
     ▼                              ▼
[Select Manuscript]            [Apply to Project]
     │                              │
     │                              ▼
     │                         [Wait for Approval]
     │                              │
     └──────────────┬───────────────┘
                    ▼
          [Start Editorial Review]
                    │
                    ├─► Read manuscript
                    ├─► Check quality
                    ├─► Provide feedback
                    └─► Add comments
                    │
                    ▼
          [Make Decision]
                    │
                    ├─► [Approve] ─────────► Update status ──► Notify author
                    │                         Calculate payment
                    │
                    └─► [Request Revision] ► Update status ──► Notify author
                              │               Add detailed feedback
                              │
                              ▼
                         [Wait for Resubmission]
                              │
                              ▼
                         [Review Again] ──► LOOP BACK
                              │
                              ▼
          [Complete Project]
                    │
                    ├─► Receive payment (auto)
                    ├─► Rate author
                    └─► Build portfolio
                    │
                    ▼
END (Project Complete) ──────► Available for new projects

⏱️ Average editorial time: 7-14 days per manuscript
```

---

### Flow 3: Reader Discovery & Engagement

```
START (Reader)
     │
     ▼
[Browse Platform] ────────────► No login required for browsing
     │
     ├─► Search by keyword
     ├─► Filter by category
     ├─► Sort by rating/popularity
     └─► View featured books
     │
     ▼
[Discover Book]
     │
     ├─► View cover & title
     ├─► Read synopsis
     ├─► Check ratings & reviews
     ├─► Preview sample chapters
     └─► View author profile
     │
     ▼
[Decision Point]
     │
     ├─► [Not Interested] ──────► Continue browsing
     │
     └─► [Interested] ──────────► [Add to wishlist] OR [Purchase]
                                           │
                                           ▼
                                    [Login/Register Required]
                                           │
                                           ▼
                                    [Complete Payment]
                                           │
                                           ▼
                                    [Access Book]
                                           │
                                           ├─► Read online
                                           └─► Download (if allowed)
                                           │
                                           ▼
                                    [After Reading]
                                           │
                                           ├─► Give rating (1-5 stars)
                                           ├─► Write review
                                           ├─► Follow author
                                           └─► Recommend to friends
                                           │
                                           ▼
                                    [Get Recommendations]
                                           │
                                           └─► Based on reading history
                                                & preferences
                                           │
                                           ▼
END (Engaged Reader) ──────────► Repeat cycle

💡 Reader engagement increases platform value
```

---

## 🔄 Status Workflow

```
Book Status Progression:

┌──────────────┐
│    DRAFT     │ ◄─── Author creates & saves (not submitted)
└──────┬───────┘
       │
       │ [Submit]
       ▼
┌──────────────┐
│  SUBMITTED   │ ◄─── Waiting for editor assignment
└──────┬───────┘
       │
       │ [Auto-assign or Manual assign]
       ▼
┌──────────────┐
│UNDER REVIEW  │ ◄─── Editor actively reviewing
└──────┬───────┘
       │
       ├────────────────┐
       │                │
       │ [Needs Work]   │ [Approved]
       ▼                ▼
┌──────────────┐  ┌──────────────┐
│REVISION REQ  │  │   APPROVED   │
└──────┬───────┘  └──────┬───────┘
       │                 │
       │ [Resubmit]      │ [Start Publishing]
       │                 ▼
       │           ┌──────────────┐
       │           │ PUBLISHING   │ ◄─── Format, ISBN, final prep
       │           └──────┬───────┘
       │                  │
       │                  │ [Complete]
       │                  ▼
       │           ┌──────────────┐
       └──────────►│  PUBLISHED   │ ◄─── Live in catalog
                   └──────┬───────┘
                          │
                          │ [Optional: Take down]
                          ▼
                   ┌──────────────┐
                   │   ARCHIVED   │ ◄─── No longer active
                   └──────────────┘

🔍 Status Log: Every transition is logged with:
   - Timestamp
   - Old status → New status
   - User who made the change
   - Optional notes/comments
```

---

## 💰 Payment Flow

```
Revenue Flow & Royalty Distribution:

┌─────────────┐
│   READER    │
│  Purchases  │
│   $10.00    │
└──────┬──────┘
       │
       │ [Payment Gateway]
       ▼
┌──────────────────────┐
│  Platform Account    │
│    (Gross: $10.00)   │
└──────┬───────────────┘
       │
       │ [Take Rate: 20%]
       │
       ├───────────────────────────┐
       │                           │
       ▼                           ▼
┌──────────────┐          ┌────────────────┐
│  Platform    │          │  Creator Pool  │
│  Commission  │          │   (80% = $8)   │
│  ($2.00)     │          └────────┬───────┘
└──────────────┘                   │
       │                           │
       │                           │ [Split if multi-author]
       │                           │
       │                           ├─────────────────┐
       │                           │                 │
       ▼                           ▼                 ▼
┌──────────────┐          ┌────────────┐   ┌────────────┐
│ Operations   │          │  Author 1  │   │  Author 2  │
│ & Marketing  │          │  (60% = $6)│   │(20% = $2.4)│
│              │          └─────┬──────┘   └─────┬──────┘
└──────────────┘                │                │
                                │                │
                                │ [Auto Transfer] │
                                ▼                ▼
                          ┌──────────────────────────┐
                          │   Author Bank Accounts   │
                          │   (Direct Deposit)       │
                          └──────────────────────────┘

Payment Cycle:
• Daily: Accumulate sales
• Weekly: Calculate royalties  
• Monthly: Auto disbursement to bank accounts
• Real-time: Dashboard shows pending & paid amounts

💡 Transparency: Authors see exact breakdown of every sale
```

---

## 🎯 Data Model (Simplified ERD)

```
┌──────────────┐        ┌──────────────┐
│    USERS     │◄───┐   │   PROFILES   │
├──────────────┤    │   ├──────────────┤
│ id (UUID)    │    └───│ user_id (FK) │
│ email        │        │ biografi     │
│ name         │        │ tempat_lahir │
│ password     │        │ bank_id (FK) │
│ role         │        │ no_rekening  │
│ verified_at  │        │ foto_profil  │
└──────┬───────┘        └──────────────┘
       │
       │ (1:N)
       │
       ▼
┌──────────────┐        ┌──────────────┐
│    BOOKS     │───────►│DETAIL_KATEGORI│
├──────────────┤  (N:M) ├──────────────┤
│ id (UUID)    │        │ buku_id (FK) │
│ user_id (FK) │◄───┐   │kategori_id FK│
│ editor_id FK │    │   └──────────────┘
│ bahasa_id FK │    │
│ judul        │    │
│ slug         │    │   ┌──────────────┐
│ sinopsis     │    └───│KATEGORI_BUKU │
│ cover_depan  │        ├──────────────┤
│ cover_belakang│       │ id (UUID)    │
│ penulis_buku │        │ nama_kategori│
│ no_isbn      │        └──────────────┘
│ tahun_terbit │
└──────┬───────┘        ┌──────────────┐
       │                │    BAHASA    │
       │ (1:N)          ├──────────────┤
       │                │ id (UUID)    │
       ▼                │ nama_bahasa  │
┌──────────────┐        └──────────────┘
│   REVIEW     │
├──────────────┤        ┌──────────────┐
│ id (UUID)    │        │    BANK      │
│ buku_id (FK) │        ├──────────────┤
│ user_id (FK) │        │ id (UUID)    │
│ rating (1-5) │        │ nama_bank    │
│ review_text  │        │ kode_bank    │
│ created_at   │        └──────────────┘
└──────────────┘
       │
       │ (N:1)          ┌──────────────┐
       │                │   STATUS     │
       ▼                ├──────────────┤
┌──────────────┐        │ id (UUID)    │
│ STATUS_LOG   │───────►│ nama_status  │
├──────────────┤        │ deskripsi    │
│ id (UUID)    │        └──────────────┘
│ buku_id (FK) │
│ status_id FK │
│ user_id (FK) │
│ notes        │
│ timestamp    │
└──────────────┘

Key Relationships:
• User ──► Books (1:N) - One user can have many books
• User ──► Profile (1:1) - One profile per user
• Book ──► Reviews (1:N) - One book can have many reviews
• Book ──► Categories (N:M) - Many-to-many through detail_kategori
• Book ──► Status Log (1:N) - Track all status changes
• Profile ──► Bank (N:1) - Bank account for payments
```

---

## 🔐 Security Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                     SECURITY LAYERS                          │
└─────────────────────────────────────────────────────────────┘

Layer 1: Network Security
┌──────────────────────────────────────┐
│  • HTTPS/TLS encryption              │
│  • Firewall rules                    │
│  • DDoS protection                   │
│  • Rate limiting                     │
└──────────────────────────────────────┘

Layer 2: Application Security
┌──────────────────────────────────────┐
│  • CSRF tokens (Laravel built-in)    │
│  • XSS prevention                    │
│  • SQL injection protection          │
│  • Input validation & sanitization   │
│  • Password hashing (bcrypt)         │
└──────────────────────────────────────┘

Layer 3: Authentication & Authorization
┌──────────────────────────────────────┐
│  • Laravel Breeze authentication     │
│  • Email verification required       │
│  • Role-based access control (RBAC)  │
│  • Session management                │
│  • Remember me tokens                │
└──────────────────────────────────────┘

Layer 4: Data Security
┌──────────────────────────────────────┐
│  • UUID instead of sequential IDs    │
│  • Foreign key constraints           │
│  • Database encryption at rest       │
│  • Backup & disaster recovery        │
│  • Audit logging (status_log)        │
└──────────────────────────────────────┘

Layer 5: File Security
┌──────────────────────────────────────┐
│  • File type validation              │
│  • Virus scanning (planned)          │
│  • Size limits                       │
│  • Secure storage (S3 or encrypted)  │
│  • Access control for downloads      │
└──────────────────────────────────────┘
```

---

## 📈 Scalability Strategy

```
┌─────────────────────────────────────────────────────────────┐
│                  SCALING ARCHITECTURE                        │
└─────────────────────────────────────────────────────────────┘

Phase 1: Single Server (0-1K users)
┌────────────────────────────────┐
│  Single Server (All-in-One)    │
│  ┌──────────────────────────┐  │
│  │  Web + App + DB + Files  │  │
│  └──────────────────────────┘  │
└────────────────────────────────┘
Cost: $50-100/month
Performance: Adequate for MVP

Phase 2: Separated Services (1K-10K users)
┌──────────────┐  ┌──────────────┐  ┌──────────────┐
│  Web Server  │  │ App Servers  │  │  DB Server   │
│  (Nginx)     │──│  (Laravel)   │──│ (PostgreSQL) │
└──────────────┘  └──────────────┘  └──────────────┘
                                     ┌──────────────┐
                                     │ File Storage │
                                     │    (S3)      │
                                     └──────────────┘
Cost: $200-500/month
Performance: Handle 10K concurrent users

Phase 3: Load Balanced (10K-100K users)
┌──────────────┐
│Load Balancer │
└──────┬───────┘
       │
       ├────────┬────────┬────────┐
       ▼        ▼        ▼        ▼
   ┌─────┐  ┌─────┐  ┌─────┐  ┌─────┐
   │App 1│  │App 2│  │App 3│  │App N│
   └─────┘  └─────┘  └─────┘  └─────┘
       │        │        │        │
       └────────┴────────┴────────┘
                │
       ┌────────┴────────┐
       ▼                 ▼
   ┌─────────┐      ┌──────────┐
   │ DB Read │      │ DB Write │
   │ Replica │      │  Master  │
   └─────────┘      └──────────┘

Cost: $1K-3K/month
Performance: Handle 100K concurrent users

Phase 4: Distributed (100K+ users)
• CDN for static assets
• Redis for caching & sessions
• Queue workers for background jobs
• Elasticsearch for search
• Microservices architecture (if needed)
• Multi-region deployment

Cost: $5K+/month
Performance: Unlimited scalability
```

---

## 🔄 Integration Points

```
┌─────────────────────────────────────────────────────────────┐
│              EXTERNAL INTEGRATIONS                           │
└─────────────────────────────────────────────────────────────┘

Payment Gateways:
┌──────────────┐  ┌──────────────┐  ┌──────────────┐
│   Midtrans   │  │   Xendit     │  │  Stripe/PP   │
│  (Priority)  │  │ (Alternative)│  │  (Global)    │
└──────────────┘  └──────────────┘  └──────────────┘

Bank APIs:
┌──────────────┐  ┌──────────────┐  ┌──────────────┐
│     BCA      │  │   Mandiri    │  │     BNI      │
│   (Direct)   │  │   (Direct)   │  │   (Direct)   │
└──────────────┘  └──────────────┘  └──────────────┘

Email Service:
┌──────────────┐  ┌──────────────┐
│   SendGrid   │  │   Mailgun    │
│  (Primary)   │  │  (Backup)    │
└──────────────┘  └──────────────┘

Storage:
┌──────────────┐  ┌──────────────┐
│   AWS S3     │  │  Local/Disk  │
│ (Production) │  │  (Dev/Backup)│
└──────────────┘  └──────────────┘

Analytics:
┌──────────────┐  ┌──────────────┐
│Google Analyt.│  │  Mixpanel    │
│  (Web)       │  │  (Product)   │
└──────────────┘  └──────────────┘

Social Integration:
┌──────────────┐  ┌──────────────┐  ┌──────────────┐
│   Facebook   │  │   Twitter    │  │  Instagram   │
│   (Share)    │  │   (Share)    │  │   (Share)    │
└──────────────┘  └──────────────┘  └──────────────┘
```

---

*Dokumentasi arsitektur ini dapat digunakan untuk technical presentation dan development planning.*
