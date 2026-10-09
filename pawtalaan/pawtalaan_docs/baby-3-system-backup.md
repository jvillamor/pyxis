# Baby #3 — PawTalaan System Details Backup

Backup date: 2026-09-05
Status: MANUAL BACKUP / LOCKED DECISIONS
Repository: jvillamor/pyxis
Branch: Pawtalaan

## Product
PawTalaan is a phone-first mobile web pet-care system for pet owners, rescuers, and fosters. It is designed for non-technical pet parents. Default language is Taglish with English optional. It is free to use; support is donation-based via GCash QR, with no subscription.

## Locked UI Theme
Warm cream + teal + soft gold. Exact palette is maintained separately in `pawtalaan_docs/color-palette.md`. Cream and teal dominate; gold is accent only. Beige paw watermarks stay subtle. Approved login design is the visual reference.

## Login / Account
- Phone number + password
- Trusted device list
- OTP for new device/change, limited to once per day
- Backup email optional for recovery
- My Account: language, Fun Pet Effects, backup email, device list, change password, donation link/QR, storage explanation
- Pet Calls Me: Meowmy / Pawmy / Mom / Dad / custom

## Post-login Home — My Pets
No dashboard. User lands on My Pets with pet cards for My Pets and Foster Pets. Cards show small attention indicators. Examples used in design: Oreo — 1 medication due; Aliyah — All good; Luna · Foster — vaccination due. Bottom shortcuts: Archived Foster Records and Memorial.

## Global Navigation
Order is locked:
1. Updates
2. Paw Calendar
3. Timeline
4. Expenses
5. Health
6. Care
7. Memorial
8. Foster & Adoption
9. Archive

Mobile header uses an expandable sidebar/menu. Footer uses the approved bowl/plant visual assets.

## Pet Profile
Sections: Overview | Health | Care | Expenses | Things | Timeline

### Overview
Photo + identity; current owner/caretakers; upcoming care; quick actions.

### Health
Medical Timeline; Vaccinations; Lab & Tests; Vet Visits; Prescriptions; Procedures; Medical Documents. Add Health Record supports source Vet/Clinic, Owner-recorded, or Clinic-administered. Attachments optional.

### Care
Routines; caretaker checklist; owner reminders; caretaker running-low flags.

### Expenses
Prompt after health save. No graphs. Receipts are automatically deleted after 3 months.

### Things
Supplies: Enough / Running Low / Out. Accessories: collar, harness, carrier, bed, toys. History supported. Destroyed allowed. Optional module data.

### Timeline
Per-pet activity. One thumbnail per entry. Optional Quirks/Traits freeform.

## Ratings / Personality Display
Five icons. Hearts represent good traits and slippers represent bad traits. Any bad trait means at least one slipper. All slippers triggers grayscale suspect photo. Tooltip: “click to see pet skill or quirks.” No rating data displays five paw prints. Rating appears near weight and is collapsible.

## Roles and Access
### Owner
Full identity edit; cannot edit locked prescriptions; may add observation notes on doses.

### Caretaker
Checklist; running-low meds/food; owner-set reminders; cannot edit locked schedule.

### Rescuer / Foster
Can create foster pet. Adoption later transfers ownership. Rescuer sees only authorized history.

## Foster & Adoption
Rescue Details records how/where found. Placement/Adopter is disabled until ready. Adopter stores name + phone; placement location is city only. If adopter phone already exists, the new pet appears pending and adopter confirms. After adoption, foster record is archived and rescuer loses access. Archived Foster Records remains searchable with authorized details only.

## Memorial
Pet photo + name + life dates; Life Story; Memories. Memories replaces Skills. One photo retained.

## Updates
Upcoming care reminders, low meds, low supplies, caretaker reports, adoption/follow-up. Filter by pet or all pets.

## Paw Calendar
Monthly calendar + pet list for selected dates, with upcoming list on top. Barangay anti-rabies bulk-complete action creates per-pet entries.

## Search
Natural-language-style examples: “Last CBC ni Oreo,” “Food expenses this year,” “When did Luna get her rabies vaccine?”

## Core Data Entities
### User
User ID; Full Name; Phone Number; Phone Verified; Password; Backup Email optional; Email Verified; Language; Pet Calls Me; Fun Pet Effects; Account Status; Created At; Updated At.

### Device
Device ID; User ID; Device Name/Type; Authorized At; Last Active; Current/Trusted Status; Removed At.

### Pet
Pet ID; Pet Name; Profile Photo; Species; Breed optional; Sex; Birth/Estimated Birth; Color/Markings optional; Weight optional/current; Microchip/ID optional; Current Classification My/Foster; Current Status Active/Memorial; Notes optional; Created At; Updated At. Deceased/life-date information is required for Memorial state.

### Health Record
Health Record ID; Pet ID; Record Type (Vaccination/Lab/Test/Vet Visit/Prescription/Procedure/Other); Date; Title/Short Description; Findings/Results optional; Instructions optional; Source; Vet/Clinic Ref optional; Notes; Recorded By; Created At; Updated At.

### Vet / Clinic Ref
ID; Owner/User ID; Vet Name/Alias; Clinic Name; Contact Number optional; General Location optional; Created At. No vet license number and no exact owner address.

### Medical Attachment
File ID; Health Record ID; File Type; File Path; Original Filename; Uploaded By; Upload Date; Expiry/Delete Date.

## Privacy / Retention
- No exact owner address
- No vet license numbers
- Vet/clinic stores alias/contact/city/general location only
- Medical attachments/receipts auto-delete after 3 months; user is informed
- Pet profile photo retained
- Audit trail retained 1 month
- Images are not encrypted
- Compress uploaded images
- Warn when notes appear to contain phone numbers (for example GCash numbers)

## Technical Direction
Laravel + PHP + SQL. Athena handles JavaScript/build assistance. Notifications are database-based; email is not required. Phone-first mobile web; not a PWA.

## Locked Build Order
Updates / Paw Calendar → Timeline → Search → Memorial → Archive → Foster & Adoption → Cleanup / Testing.

After My Pets is implemented, test first. After each module, test and sign off before moving to the next module. Development is intended to be automation-assisted, so requirements and locked decisions in docs should be treated as the source of truth.

## Confirmed Visual Assets
Logo; beige paw watermark; bowl/yarn; plant; dog + cat heart; 2560×1440 background; transparent PNG assets where applicable.

## Backup Note
This document is a manual continuity backup of the locked Baby #3 / PawTalaan system decisions available as of the backup date. The exact color palette remains in `pawtalaan_docs/color-palette.md`.