# PawTalaan — Entity & Field Lock

Status: LOCKED / RECONCILED
Branch: `Pawtalaan`

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
- Pet Calls Me — Meowmy / Pawmy / Mom / Dad / custom
- Fun Pet Effects — On / Off
- Account Status
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

PawTalaan is free. There is NO Subscription entity or subscription field. Donation is voluntary support only and is not an access entitlement.

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
- Weight — optional/current display value; measurement history belongs to Health
- Microchip / Identification — optional
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

### Vet / Clinic Reference
- Reference ID
- Owner / User ID
- Vet Name / Alias
- Clinic Name
- Contact Number — optional
- General Location — optional
- Created At

No veterinarian license number. No global vet directory. Do not store unnecessarily exact/private location data as a requirement.

### Medical Attachment
- File ID
- Health Record ID
- File Type
- File Reference / Path
- Original Filename
- Uploaded By
- Upload Date
- Expiry / Delete Date

Health attachments remain separate from Health Record.

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

Care is non-medical/routine or follow-through care; medical history remains in Health. Where a Care action produces a medical record, preserve the relationship instead of duplicating unrelated data.

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
- Status — Upcoming / Completed / Dismissed
- Created By
- Created At

For All Pets completion, the shared event remains one schedule entry. Individual Pet Health/Care records are generated only after the user confirms which pets were affected/completed.

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
- Receipt File — optional
- Created At

Receipt attachment metadata:
- Upload Date
- Expiry / Delete Date

The structured Expense remains after a temporary receipt file is deleted. Do not restore the removed graph/percentage visualization.

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

SUPERSEDED: `Rating Position` is NOT a manually stored business source of truth.

Later rating rule:
- Skills and Traits remain structured pet-linked records.
- Trait/behavior entries are classified Good or Bad. A trait may be something like `malambing`; it is not automatically a trained skill.
- Heart/Slipper UI is computed from the approved Good/Bad data.
- If at least one active Bad trait/behavior exists, the Slipper side is active/represented.
- Do not recreate a standalone large Rating section or the removed Skills & Traits profile dropdown.
- Skills/Traits records may surface as Memories in Memorial rather than being copied into a second contradictory dataset.

The older derived labels such as `My Baby` / `Pet Suspect` must not override the later Good/Bad computation rule. Treat them as UI wording only if separately approved, not stored rating logic.

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

## 12. Archived Records

Do NOT create a duplicate archived-pet business entity by default. Archive/historical access is derived from canonical records including:
- Pet Relationship
- relationship End Date
- adoption/Placement status
- post-adoption follow-up/access state where applicable
- access permissions

Former foster/custodian users may retain authorized historical records without copying the Pet. Archive is not deletion and does not replace Memorial.

## 13. Memorial

### Memorial
- Memorial ID
- Pet ID
- Date of Death
- Life Story — optional
- Remembrance Reminder Enabled
- Remembrance Date / Rule — optional
- Memorialized At
- Memorialized By

Pet name, profile photo, Timeline, Skills/Traits-derived Memories and other history continue from canonical Pet/related records instead of being duplicated. Pet `Deceased Date` and Memorial `Date of Death` must represent the same death date; implementation should maintain one canonical value/consistency rather than allow contradictory dates.

Memorial UI tabs remain Life Story | Memories | Timeline. No Photos tab and no Favorites section.

## 14. Files

### File
- File ID
- User ID
- Pet ID
- Related Record Type
- Related Record ID
- File Category
- File Path / Reference
- Original Filename
- Upload Date
- Retention Type — Permanent / 3 Months
- Expiry Date
- Deleted At

Permanent exceptions include:
- Pet profile photo
- Skills/Traits small thumbnails

Temporary-file deletion must not delete the structured business record that referenced the file.

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
