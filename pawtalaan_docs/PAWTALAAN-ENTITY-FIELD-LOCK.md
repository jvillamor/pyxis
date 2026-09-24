# PawTalaan — Entity & Field Lock

Status: LOCKED / RECONCILED
Branch: `Pawtalaan`

Documentation reconciliation: 2026-09-24. See the [decision reconciliation register](PAWTALAAN-DECISION-RECONCILIATION.md) for recovered agreements and unresolved field/workflow gaps. No new business fields are approved by this reconciliation.

This is the field-level implementation authority. It reconciles the detailed PawTalaan entity list with later signed-off adjustments. Athena must not restore superseded fields or invent additional business fields without approval.

## 1. User / Account

### User
- User ID
- Full Name
- Phone Number
- Phone Verified
- Password
- Backup Email — optional
- Email Verified
- Language — Taglish / English
- Gender — Female / Male / Custom / Prefer not to say — optional; used only to suggest how a pet may address the owner
- Fun Pet Effects — On / Off
- Account Status
- Data Retention Mode — Standard / Protected; default Standard
- Retention Protection Source — Administrator / System / Future Subscription
- Retention Protection Started At — optional
- Retention Protection Ends At — optional
- Retention Grace Period Ends At — optional
- Retention Protection Reason — required when set by an Administrator
- Retention Protection Set By — optional Administrator User ID
- Created At
- Updated At

### Device
- Device ID
- User ID
- Device Name / Type
- Authorized At
- Last Active
- Current / Trusted Status
- Removed At

PawTalaan is free. There is NO Subscription entity or subscription field in the initial release. Donation is voluntary support only and is not an access entitlement. Future Subscription is reserved retention-protection vocabulary only and must not be implemented as billing or an access gate until separately approved.

### Administrator Access
- Administrator Access ID
- User ID
- Role — Super Administrator / Administrator
- Status — Active / Suspended
- Granted By
- Granted At
- Revoked At — optional
- Last Admin Login
- Created At
- Updated At

Administrator is an additional permission on a normal User account. Administrators may own pets and use normal PawTalaan features. The full authority is `pawtalaan_docs/PAWTALAAN-ADMIN-SETTINGS-LOCK.md`.

### Site Setting
- Setting ID
- Setting Key
- Setting Value
- Value Type — Text / Number / Boolean / Date / File / JSON
- Setting Group
- Description
- Is Sensitive
- Updated By
- Updated At

Site Setting stores approved operational configuration, not application secrets. Passwords, OTP secrets, encryption keys and database credentials must never be stored here.

## 2. Pet

### Pet
- Pet ID
- Pet Name
- Profile Photo
- Species
- Breed — optional
- Sex
- Birth Date / Estimated Birth Date
- Deceased Date — nullable while living; required when Current Status = Memorial/deceased
- Color / Markings — optional
- Latest Weight — optional/current display value in kilograms; automatically derived from the newest valid Weight Measurement
- Latest Weight Date — optional; automatically derived from the newest valid Weight Measurement
- Microchip / Identification — optional
- Pet Calls Owner — optional, user-editable; suggested during pet creation and used for personalized Memorial messages
- Current Classification — My Pet / Foster Pet
- Current Status — Active / Memorial
- Notes — optional
- Created At
- Updated At

### Account Caretaker Relationship
- Caretaker Relationship ID
- Account Owner User ID
- Caretaker User ID
- Start Date
- End Date — optional
- Active
- Permissions
- Created By
- Created At

A caretaker is linked to the pet owner's account, not assigned separately to each pet. An active account caretaker may look after all pets owned by that account, subject to the relationship permissions. Do not create duplicate per-pet caretaker assignments.

A caretaker may also own pets independently. Their own pets use the normal Pet Relationship with Relationship Type = Owner; being a caretaker for another account does not change or conflict with ownership of their own pets.

The recorded checklist, running-low reporting, owner-set reminder and locked-schedule restrictions are specified in [Account and ownership rules](PAWTALAAN-FUNCTIONAL-DATA-LOCK.md#account-and-ownership-rules). `Permissions` is not yet an exhaustive enumerated permission model; invitation/acceptance remains unresolved.

### Pet Relationship
- Relationship ID
- Pet ID
- User ID
- Relationship Type — Owner / Foster-Custodian
- Start Date
- End Date — optional
- Active
- Permissions
- Created By
- Created At

Pet Relationship preserves pet-specific ownership and foster custody history instead of overwriting it. Standard caretaker access comes from Account Caretaker Relationship and must not be represented through a separate Caretaker relationship for every pet. Owner/caretaker details remain hidden from the normal Pet Profile as required by the UI/UX Lock.

## 3. Health

### Health Record
- Health Record ID
- Pet ID
- Care ID — optional link when the health record originated from/relates to Care
- Record Type
  - Vaccination
  - Lab / Test
  - Vet Visit
  - Prescription
  - Procedure
  - Other Medical Record
- Date
- Short Description
- Findings / Results — optional
- Instructions — optional
- Source — Vet/Clinic / Owner-recorded / Clinic-administered
- Vet / Clinic Reference — optional
- Doctor Name — optional
- Doctor Contact — optional
- Recorded By
- Created At
- Updated At

Later adjustment controls: do NOT use the older `Title/Description` field here; use `Short Description`. The older general `Notes` field is removed from Health Record.

### Weight Measurement
- Weight Measurement ID
- Pet ID
- Measurement Date
- Weight Value — kilograms; decimal allowed and must be greater than zero
- Source — Home / Vet-Clinic / Other
- Vet / Clinic Reference — optional
- Related Health Record ID — optional
- Recorded By
- Created At
- Updated At

Each weight update creates a Weight Measurement history record. Pet Latest Weight and Latest Weight Date are derived from the newest valid measurement and are not independently editable. Future measurement dates are rejected. Editing or deleting the latest measurement recalculates the Pet placeholders from the next-newest valid record. If no measurement exists, UI displays `No weight recorded`.

### Vet / Clinic Reference
- Reference ID
- Owner / User ID
- Vet Name / Alias
- Clinic Name
- Contact Number — optional
- General Location — optional
- Created At

No veterinarian license number. No global vet directory. Do not store unnecessarily exact/private location data as a requirement.

## 4. Care

### Care Item
- Care ID
- Pet ID
- Care Type
  - Medication
  - Vet Return
  - Vaccination / Deworming
  - Preventive Treatment
  - Temporary / Special Care
  - Other
- Title
- Instructions
- Start Date
- End Date — optional
- Assigned To — optional
- Reminder Enabled
- Reminder Schedule — required when reminder is enabled
- Status
- Created By
- Locked By / At — where applicable
- Created At
- Updated At

Medication-specific fields when Care Type = Medication:
- Medication Name
- Dose / Instructions
- Frequency
- Vet / Clinic Reference — optional

### Care Completion / Medication Administration
- Completion ID
- Care ID
- Pet ID
- Date / Time Given or Completed
- Completed / Given By
- Observation — optional
- Supply Status — Enough / Running Low / Out
- Logged At

Care covers non-medical routines and follow-through care, including the medication administration and medical follow-up tasks listed above; medical history remains in Health. Where a Care action produces a medical record, preserve the relationship instead of duplicating unrelated data. The reminder and supply-status ownership questions remain open in the decision reconciliation register.

## 5. Updates / Paw Calendar

### Reminder / Notification
- Notification ID
- User ID
- Pet ID — nullable for All Pets
- Related Record ID / Type
- Scope — This Pet / All Pets
- Title
- Description
- Due Date
- Due Time — optional
- Repeat Rule — optional
- Recipient — Owner / Caretaker
- Status — Upcoming / Partially Completed / Completed / Dismissed
- Created By
- Created At

### Reminder Pet Status
- Reminder Pet Status ID
- Notification ID
- Pet ID
- Status — Pending / Completed / Skipped
- Completed At — optional
- Completed By — optional
- Generated Record Type — Health Record / Care Completion / none
- Generated Record ID — optional
- Created At
- Updated At

When Scope = All Pets, PawTalaan shows all eligible active pets preselected and requires the user to confirm which pets are included before saving. Memorialized and archived pets are excluded; authorized foster pets may be included. The confirmed selection becomes a snapshot, so pets added later are not silently added to an existing schedule. Each pet can be completed or skipped separately. The shared Reminder remains one schedule entry and displays progress such as `3 of 5 completed`. Individual Health/Care records are generated only for pets marked Completed. Overall status is derived: all pending = Upcoming; a mix with pending = Partially Completed; no pending = Completed. Editing a recurring schedule changes future occurrences only.


Updates is the global notification/inbox view; Paw Calendar is the global schedule view. They may use the same structured source/reminder relationships but are not duplicate Timeline pages.

## 6. Timeline

### Timeline Event
- Timeline Event ID
- Pet ID
- Event Type
- Source Record Type
- Source Record ID
- Event Date / Time
- Title
- Summary
- Recorded By

Timeline is mostly system-generated from existing structured records. Do not require users to manually duplicate Health/Care/Expense/Thing/etc. information into Timeline. Source references must remain traceable.

## 7. Expenses

### Expense
- Expense ID
- Pet ID — optional when shared supply
- Expense Type / Category
- Item
- Purchase Date
- Amount
- Quantity — optional
- Purchased By
- Shared Supply — Yes / No
- Notes — optional
- Related Health Record ID — optional; links a cost to a specific medical event
- Created At

Expense receipts use the canonical File entity with File Category = Expense Receipt and Linked Record ID = Expense ID.

Expense lifecycle is based on Created At:
- Month 0 (current month), Month 1, Month 2 and Month 3 — Active
- Beginning of Month 4 — automatically moved to Archive
- Beginning of Month 5 — permanently deleted

Each Expense moves independently. Archive displays the scheduled deletion date and gives notice before permanent deletion. Restoring during Month 4 does not reset the original Month 5 deletion date. An associated receipt may already have expired under its separate three-month file-retention rule. Do not restore the removed graph/percentage visualization.

The unchanged deletion date is an existing agreement. The state/display effect of Restore, prevention of immediate re-archiving and expense export availability remain unspecified; do not infer that Restore grants a new retention period. User retention protection still applies under section 17.

## 8. Things

### Pet Thing
- Thing ID
- Pet ID — optional/shared
- Type — Supply / Accessory
- Item Name
- Quantity — optional
- Supply Status — Enough / Running Low / Out
- Accessory Status — In Use / Spare / Replaced / Lost / Retired / Destroyed
- Date Added
- Notes
- Recorded By

Item photo is optional where supported by the File relationship/UI. No photo must not block creation; use a restrained category/default icon in UI.

Supply Status and Accessory Status already have the allowed values above. Required/empty-field behavior by Type and any additional Created/Updated At fields are not yet approved.

## 9. Skills & Traits / Memories

### Skill Trait
- Entry ID
- Pet ID
- Type — Skill / Trait
- Title
- Description
- Classification — Good / Bad
- Thumbnail — optional
- Created By
- Created At
- Updated At
- Status — Active / Inactive
- Inactive At — optional; required when Status = Inactive
- Inactive Reason — optional
- Deleted At — optional

User-facing wording for Inactive is `Historical`. Only Active, non-deleted Good/Bad entries participate in the computed Heart/Slipper display. Historical entries remain viewable but do not affect the current rating. Deleting is a separate action from marking an entry Historical.

SUPERSEDED: `Rating Position` is NOT a manually stored business source of truth.

Later rating rule:
- Skills and Traits remain structured pet-linked records.
- Trait/behavior entries are classified Good or Bad. A trait may be something like `malambing`; it is not automatically a trained skill.
- Heart/Slipper UI is computed from the approved Good/Bad data.
- If at least one active Bad trait/behavior exists, the Slipper side is active/represented.
- Do not recreate a standalone large Rating section or the removed Skills & Traits profile dropdown.
- Skills/Traits records may surface as Memories in Memorial rather than being copied into a second contradictory dataset.

The older derived labels such as `My Baby` / `Pet Suspect` must not override the later Good/Bad computation rule. Treat them as UI wording only if separately approved, not stored rating logic.

The exact heart/slipper count formula is still unresolved. Earlier icon-count, empty-state and suspect-photo directions are preserved as historical context in the decision reconciliation register, not reinstated as current implementation rules.

## 10. Rescue / Foster

### Rescue Record
- Rescue ID
- Pet ID
- Date Rescued / Found
- General Location Found
- How Rescued / Found
- Condition When Found — optional
- Rescue Notes — optional
- Recorded By
- Foster Status
  - Under Care
  - For Adoption
  - Placement Started
  - Adopted

No exact found address/location is required.

## 11. Placement / Adoption

### Placement
- Placement ID
- Pet ID
- Rescuer / Foster User ID
- Adopter Name
- Adopter Phone
- Linked Adopter User ID — only if an authorized match exists
- General Placement Location
- Placement Date
- Intended Relationship — My Pet / Foster Pet
- Status
- Locked At
- Confirmed At
- Completed At

Phone matching is permitted only inside this authorized placement workflow. Never expose a public user search by phone number.

The recovered pending-adopter confirmation and post-adoption access direction is in [Foster & Adoption](PAWTALAAN-FUNCTIONAL-DATA-LOCK.md#foster--adoption). It does not add placement statuses/fields or enable this deferred module.

## 12. Archived Records

Archive is a system-managed holding area for aging or replaced operational records. It is not Trash because the user does not manually initiate the move, and it is not Memorial.

Core automatic rules:
- Expenses remain Active through Month 0, Month 1, Month 2 and Month 3; move individually to Archive at the beginning of Month 4; and are permanently deleted at the beginning of Month 5.
- Only one Pet profile photo is active. Replacing it moves the previous photo to Archive for one month before permanent deletion.
- An archived profile photo may be restored during its one-month window; restoring it makes it current and moves the previously current photo into Archive with a new one-month window.
- Medical attachments and Expense receipts use their approved three-month file retention.
- Archive shows record name/type, reason archived, archived date, scheduled removal date, View, Restore when allowed, and Remove Now with confirmation.
- Moving a File to Archive must not delete its structured parent record unless that parent has its own approved deletion lifecycle.
- Active pets and Memorial pets are never mixed into this operational Archive.

Foster & Adoption is optional and deferred. If implemented later, authorized foster/adoption history may be integrated into Archive through its own test and sign-off cycle; core Archive must not depend on that module.

Do NOT create a duplicate archived-pet business entity or duplicate Pet table.

## 13. Memorial

### Memorial
- Memorial ID
- Pet ID
- Life Story — optional
- Remembrance Reminder Enabled
- Remembrance Date / Rule — optional
- Memorialized At
- Memorialized By

Pet name, profile photo, Timeline, Skills/Traits-derived Memories and other history continue from canonical Pet/related records instead of being duplicated. Pet `Deceased Date` is the sole canonical death-date value; Memorial must not store a second death-date field. In UI, the date is always labeled `Memorial Date` and is displayed only when Pet Current Status = Memorial.

When Remembrance Reminder Enabled is on, PawTalaan creates a gentle annual notification on the canonical Memorial Date, links to the Memorial page, and uses Pet Calls Owner (fallback: Hooman). It must not appear as an overdue or urgent alert. For February 29, use February 28 in non-leap years.

Memorial UI tabs remain Life Story | Memories | Timeline. No Photos tab and no Favorites section.

## 14. Files

### File
- File ID
- User ID
- File Category — Pet Profile Photo / Medical Attachment / Expense Receipt / Pet Thing Photo / Skill Trait Thumbnail / Account-Privacy File / Donation File / Other
- Linked Record ID
- File Type / MIME Type
- File Path / Reference
- Original Filename
- Upload Date
- Retention Type — Permanent / Three Months / One Month After Replacement
- Expiry Date — required for temporary files
- Deleted At — optional

File Category identifies both the file purpose and the kind of business record referenced by Linked Record ID; there is no separate Related Record Type field. File Pet ID is removed. Any pet association is derived from the linked business record: Pet for profile photos, Health Record for medical attachments, Expense for receipts, Pet Thing for item photos, and Skill Trait for thumbnails. Shared Expense/Thing records and account/privacy/donation files may have no pet association.

There is one canonical File entity. Medical Attachment and Expense Receipt remain user-facing categories/views, not separate attachment tables. A Health Record or Expense may have multiple related File rows. Authorization follows User ID and the linked business record. Temporary-file deletion must not delete the structured business record unless that record has its own approved deletion lifecycle.

Permanent exceptions:
- Current Pet profile photo
- Skill Trait thumbnail

Temporary rules:
- Medical attachments and Expense receipts — three months
- Replaced Pet profile photo — one month in Archive

## 15. Audit Log

### Audit Log
- Audit ID
- User ID
- Pet ID — where applicable
- Action
- Entity Type
- Entity ID
- Date / Time
- Relevant Change Summary

Retention: 1 month, then cleanup according to the approved cleanup rule. Audit should remain lightweight; do not store file contents or unnecessary duplicate business-record payloads in the log.

Administrator setting changes must also capture the previous and new non-sensitive values and the effect, as required by the Administrator Settings Lock. The representation within `Relevant Change Summary` versus additional structured fields remains unresolved; no additional audit fields or longer retention period are approved here.

## Global relationship/data rules
- Account/User is the ownership/access boundary.
- Account-level caretaker access is represented through Account Caretaker Relationship and applies to all pets owned by that account, subject to permissions; do not create per-pet caretaker assignments.
- A caretaker may independently own pets through ordinary Pet Relationship records with Relationship Type = Owner.
- Use stable primary keys and explicit foreign keys.
- Historical pet ownership and foster custody are represented through Pet Relationship; do not overwrite prior custody.
- Search uses canonical records; there is no Search business entity.
- Timeline references source records; it is not a duplicate data-entry store.
- Archive uses canonical historical relationships; it is not a duplicate Pet table.
- Memorial reuses canonical Pet/history data.
- File retention/deletion must not erase the underlying structured record.
- Donation is voluntary support; there is no Subscription entity.
- Do not invent fields to fill perceived gaps. Raise unresolved technical needs for approval.


## 16. Reconciled personalization vocabulary — LOCKED 2026-09-07
- Awmy — mommy of a dog
- Awdy — daddy of a dog
- Meowmy — mommy of a cat
- Meowdy — daddy of a cat
- Other species may use Mommy, Daddy, Hooman, or any custom value.
- Suggestions use Pet species and optional User Gender, but the user always chooses or enters the final Pet Calls Owner value.
- After ownership transfer, the new owner is prompted to review Pet Calls Owner.


## 17. Administrator and retention authority — LOCKED 2026-09-07
- Exact Administrator access, desktop-only UI, settings scope, retention-change safeguards and future subscription boundaries are defined in `pawtalaan_docs/PAWTALAAN-ADMIN-SETTINGS-LOCK.md`.
- Protected user records may enter Archive but cannot be automatically deleted while protection is active.
- Expiring/removing protection starts recalculation plus notice/grace; never immediate deletion.
- Archive/deletion reads User retention protection, not billing records.
