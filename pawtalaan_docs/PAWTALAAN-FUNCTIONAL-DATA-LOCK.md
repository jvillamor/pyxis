# PawTalaan — Functional, Data & Implementation Lock

Status: LOCKED / APPROVED
Branch: `Pawtalaan`

Documentation reconciliation: 2026-09-24. Existing agreements recovered from the September 5 continuity backup are identified below. The [decision reconciliation register](PAWTALAAN-DECISION-RECONCILIATION.md) records provenance and unresolved gaps; it does not approve new behavior or override the authority order.

## Purpose and authority
This document carries PawTalaan's functional behavior, lifecycle rules, module boundaries, testing gates, and exact development order. It must be read together with:

- `pawtalaan_docs/ATHENA-UI-UX-LOCK.md` — visual/layout authority
- `pawtalaan_docs/PAWTALAAN-ENTITY-FIELD-LOCK.md` — **mandatory field-level/entity authority**
- `pawtalaan_docs/PAWTALAAN-ADMIN-SETTINGS-LOCK.md` — administrator access, configurable site settings and user retention-protection authority

Athena must read ALL FOUR lock documents before implementation. This document is not permission to invent or rename fields. Exact entity/field definitions, nullable/optional rules, superseded fields, and field-specific conditions come from `PAWTALAAN-ENTITY-FIELD-LOCK.md`.

If a high-level example in this document is less specific than the Entity & Field Lock, the Entity & Field Lock controls the database/model field definition. Do not invent missing fields, workflows, relationships, screens, or alternate behavior. Raise a gap for approval instead.

## Product access model — LOCKED
PawTalaan is **FREE to use**. There is **NO subscription**, paid plan, premium tier, recurring access fee, or subscription entity required for normal product access.

PawTalaan may ask users/hoomans for **voluntary donations** to help support the service. Donation is support for PawTalaan and must NOT unlock ordinary features, create paid feature tiers, or become a prerequisite for account/pet access.

## Mobile-first foundation
PawTalaan is a mobile-first website; the phone is the expected primary device. Development therefore starts with the account/access foundation before pet modules.

### Required development sequence and release gates
1. Login / authentication foundation
2. Account / Profile foundation
3. Donation/support entry point and messaging as part of the account/site foundation — voluntary only, never an access gate
4. Administrator access and Site Settings foundation
5. TEST + USER SIGN-OFF — foundation gate
6. My Pets / Pet Profile foundation
7. TEST + USER SIGN-OFF
8. Health
9. TEST + USER SIGN-OFF
10. Care
11. TEST + USER SIGN-OFF
12. Expenses
13. TEST + USER SIGN-OFF
14. Things / Pet Belongings
15. TEST + USER SIGN-OFF
16. Updates / Paw Calendar
17. TEST + USER SIGN-OFF
18. Timeline
19. TEST + USER SIGN-OFF
20. Search
21. TEST + USER SIGN-OFF
22. Memorial
23. TEST + USER SIGN-OFF
24. Archive
25. TEST + USER SIGN-OFF
26. Final cleanup, integration, regression, responsive/mobile testing and release validation

Optional later module:
- Foster & Adoption is deferred and may be skipped for the core release.
- If explicitly approved later, implement it as an independent module followed by Archive integration, regression testing and user sign-off.

A later module must not be started merely because coding is automated. Finish, test, review, and obtain sign-off for the current module first. If implementation exposes a technical conflict with a locked decision, stop that affected change and raise it; do not silently redesign or reinterpret the product.

## Account and ownership rules
- Account/user is the ownership boundary for PawTalaan data.
- Caretakers are account-level, not standard per-pet assignments.
- Normal Pet Profile must not expose owner/caretaker details.
- Account menu remains: Profile; Change Password; Caretakers; Data & Privacy; Donation; Activity Log; Help & Support; Log Out.
- There is NO subscription or paid-access dependency on the account.
- Donation is voluntary support and is not an entitlement/access model.
- Exact User, Device, and Pet Relationship fields are defined in `PAWTALAAN-ENTITY-FIELD-LOCK.md`.

### Authentication agreements recovered from the continuity backup
Source: [September 5 backup, Login / Account](baby-3-system-backup.md#login--account).
- Sign in with phone number and password.
- Maintain a trusted-device list.
- OTP is required for a new device/change, with the recorded limit of once per day.
- Backup email is optional and supports recovery.

These agreements are not a complete authentication specification. The scope of "new device/change" and the once-per-day limit, OTP delivery and expiry, retries, reset/recovery steps and session rules still require definition. Do not infer them from the brief backup wording. Administrator-specific safeguards remain in the Administrator Settings Lock.

### Recorded owner and caretaker capabilities
Source: [September 5 backup, Roles and Access](baby-3-system-backup.md#roles-and-access), reconciled with the later account-level caretaker model.
- Owners may edit pet identity, cannot edit locked prescriptions, and may add observation notes on doses.
- Caretakers use the care checklist, report running-low medication/food and use owner-set reminders; they cannot edit locked schedules.
- These capabilities apply through Account Caretaker Relationship, subject to permissions; they do not restore per-pet caretaker assignments or owner/caretaker details on Pet Profile.
- Invitation/acceptance, the exhaustive permissions list and who may create/release a prescription or schedule lock remain unresolved.

## Donation — locked functional direction
Donation is a support feature, not a subscription.
- Donation/support messaging should explain that PawTalaan is free and invite hoomans who wish to help sustain/support the service.
- A user must be able to use ordinary PawTalaan functionality without donating.
- Do not create premium-only pet features based on donation status.
- Do not label Donation as Subscription in UI, code, database, documentation, or navigation.
- If donation transaction/history data is implemented later, keep it separate from authentication/access entitlement logic.

## Pet — locked data direction
Pet is the central entity. Exact Pet and Pet Relationship fields are locked in `PAWTALAAN-ENTITY-FIELD-LOCK.md`. Key functional rules include:
- preserve identity and lifecycle information;
- `Deceased Date` exists on Pet and is nullable while living;
- when the pet is memorialized/deceased, death-date consistency must be maintained with Memorial;
- current weight may be displayed on Pet Profile while measurement history belongs to Health;
- historical custody must be preserved through Pet Relationship rather than overwritten.

Archive, Memorial, active My Pets, and active Foster Pets are distinct lifecycle/display contexts. Archived or memorialized pets must not be mixed into active pets.

## Skills, traits and pet rating
Skills and Traits are data concepts; the removed Skills & Traits profile dropdown must NOT be restored. Exact fields are defined in the Entity & Field Lock.

### Rating rule
The later approved rule supersedes the older manually stored `Rating Position` model. Rating is computed from the approved Good/Bad classification data. The compact visual uses hearts for good and slippers for bad. If at least one active Bad trait/behavior exists, the Slipper side must be represented. Do not create a separate `rating_position` source-of-truth field.

Only Active, non-deleted entries contribute. The exact icon-count calculation is not recorded. The earlier five-icon display and later six-icon example are documented as an unresolved discrepancy in the decision reconciliation register; neither supplies an approved formula.

## Health — locked data boundary
Health contains medical/health records only. Routine feeding, grooming, litter, hygiene, and ordinary care do not belong here.

Exact Health Record, Vet/Clinic Reference, and Medical Attachment fields are defined in `PAWTALAAN-ENTITY-FIELD-LOCK.md`. Later approved corrections control:
- No general `Title/Description` source field in Health Record; use `Short Description`.
- General Health Record `Notes` is removed.
- Vet/Clinic is separate from Health Record.
- No veterinarian license number and no global vet directory.
- Health attachments remain separate linked records.

## Care
Care covers non-medical routines and follow-through care, including the already-listed medication administration and medical follow-up tasks. Health holds the medical history. Exact Care Item and Care Completion/Medication Administration fields are defined in the Entity & Field Lock. Scheduled/upcoming care can feed Paw Calendar and Updates. Do not duplicate medical records here; where Care produces/relates to a medical event, preserve the relationship. Reminder Schedule versus Repeat Rule, and completion-level versus Thing-level Supply Status, still need canonical ownership/synchronization rules.

## Expenses
Expenses are pet-related spending records. Exact Expense fields and temporary receipt-file behavior are defined in the Entity & Field Lock. Keep the approved simple record/list direction; the removed graph and percentage visualization must not return.

## Things / Pet Belongings
Exact Pet Thing fields are defined in the Entity & Field Lock. Item photo is optional; absence of a photo must not block creation. Avoid an e-commerce/product-catalog appearance.

## Updates
Updates is a global account-level notification/inbox across pets, not Timeline. Exact Reminder/Notification fields are defined in the Entity & Field Lock. It can surface due soon, overdue/attention, health reminders, care reminders, calendar reminders, pet system updates, and foster/adoption notifications.

For All Pets schedules, show eligible active pets preselected and require confirmation of the included pets. The confirmed selection is a per-occurrence snapshot. Track Pending, Completed or Skipped per pet, show partial progress, and derive the shared Reminder status. Individual Health/Care records are generated only for pets marked Completed. Recurring-schedule membership changes affect future occurrences only.

## Paw Calendar
Paw Calendar is global across pets. Calendar entries may originate from health, care, reminders, and other approved pet events. Preserve source references rather than creating disconnected duplicate data.

## Timeline
Timeline is the permanent chronological pet history. Exact Timeline Event fields are defined in the Entity & Field Lock. It is mostly system-generated from canonical structured records and retains source record type/ID traceability. There is no Export Timeline action.

## Search
Search is a simple global keyword search for the first version, not an AI/natural-language interpretation feature. It uses one text box and search action; blank input does not run. Search is case-insensitive, trims surrounding spaces, searches only authorized canonical records, groups results by relevant record type, and routes each result to its canonical source. Active, Memorial and archived contexts must be clearly labeled. No separate custom mockup is required; use the approved global shell.

## Memorial
Exact Memorial fields are defined in the Entity & Field Lock. Memorial is a dedicated deceased-pet context, not a normal active Pet Profile. It uses Pet identity/history canonically rather than copying it. Tabs remain Life Story | Memories | Timeline. No Photos tab and no Favorites section.

## Archive
Archive is a system-managed holding area for aging or replaced operational records; it is not user-initiated Trash, deletion, or Memorial. Core Archive covers Expense retention, expiring attachments/receipts, and replaced Pet profile photos. Expenses remain active through Month 3, move individually to Archive at Month 4, and are deleted at Month 5 using Created At. Replaced profile photos remain in Archive for one month. Medical attachments and Expense receipts retain their approved three-month file lifetime. Archive must show why an item moved and its scheduled removal date, and must support View, Restore when allowed, and confirmed Remove Now. Core Archive must not depend on Foster & Adoption.

## Foster & Adoption
Foster & Adoption is optional and deferred. It must remain hidden when not developed, rather than showing an empty or Coming Soon page. If approved later, implement and test it independently, integrate authorized foster/adoption history into Archive, and regression-test Archive before sign-off.
Exact Rescue Record and Placement fields are defined in the Entity & Field Lock. Foster pets remain distinct from My Pets. Historical foster/adoption custody must remain traceable and must not overwrite permanent Pet history. Phone matching is restricted to the authorized placement workflow and is never a public user search.

Recorded adoption direction from the [September 5 backup](baby-3-system-backup.md#foster--adoption), retained for this deferred module:
- Placement/adopter entry stays disabled until ready for placement.
- An authorized match to an existing adopter phone makes the pet pending for the adopter to confirm.
- After adoption, the foster record is archived and the rescuer loses access to the transferred pet; searchable archived foster details remain limited to authorized history.
- The new owner reviews Pet Calls Owner, as already required by the Entity & Field Lock.

This is a partial adoption workflow, not a complete general ownership-transfer specification. Rejection, cancellation, unmatched adopters and precise retained-history access remain unresolved. This reconciliation does not enable the deferred module.

## Files
Use one canonical File entity. File Category identifies purpose/parent kind and Linked Record ID identifies the parent record. Do not add File Pet ID or Related Record Type. Pet association is derived from the linked record. Medical attachments and receipts are categories/views, not separate tables. Temporary-file cleanup must not delete the structured parent unless that parent has its own approved deletion lifecycle. Current Pet profile photos and Skill Trait thumbnails are permanent; replaced profile photos are archived for one month.

## Audit Log
Exact Audit Log fields are defined in the Entity & Field Lock. Retention is 1 month followed by cleanup under the approved rule. Keep logs lightweight; do not store file contents or unnecessary duplicate payloads.

## Data integrity and implementation conditions
- Use stable primary keys and explicit foreign keys/relationships.
- Preserve created/updated audit timestamps where defined by the Entity & Field Lock; do not add generic timestamp fields to an entity merely by assumption.
- Preserve historical custody via Pet Relationship.
- Prefer normalized linked records for repeatable history rather than repeated numbered columns.
- Do not hard-delete historical business records as a normal workflow when archive/lifecycle behavior is intended.
- Enforce account-level authorization on every pet-linked query/action.
- Validate required/optional fields exactly as locked in `PAWTALAAN-ENTITY-FIELD-LOCK.md`.
- Avoid uncontrolled raw/heavy SQL and scattered database calls. Use a controlled service/data-access approach, pagination for large lists, indexes for common joins/filters, prevent N+1 queries, and avoid DB calls inside loops unless intentionally batched.
- Dynamic UI must consume canonical data; do not maintain separate contradictory copies solely for individual screens.

## Testing/sign-off expectations at every gate
At each module gate validate at least:
- happy path and validation/error path
- account authorization/data isolation
- create/read/update/lifecycle behavior relevant to the module
- exact field presence, optionality, and superseded-field exclusions against `PAWTALAAN-ENTITY-FIELD-LOCK.md`
- relationship integrity and timeline/update/calendar side effects where applicable
- mobile/responsive behavior against approved mockup/layout direction
- regression of already signed-off modules

Only after the user signs off should Athena proceed to the next module.

## Conflict and authority order
If the lock documents or an approved mockup appear to conflict:
1. latest explicit signed-off decision controls;
2. `PAWTALAAN-ENTITY-FIELD-LOCK.md` controls exact entity/field definitions and superseded fields;
3. this Functional/Data/Implementation Lock controls behavior, lifecycle, module boundaries, development sequence, and testing gates;
4. `PAWTALAAN-ADMIN-SETTINGS-LOCK.md` controls administrator access, configurable settings and retention-protection behavior;
5. latest approved mockup + `ATHENA-UI-UX-LOCK.md` control visual/layout direction;
6. do not invent a compromise — raise the conflict for approval.


## Reconciled decisions — LOCKED 2026-09-07
- Weight updates create Weight Measurement history in kilograms; Pet exposes derived Latest Weight and Latest Weight Date.
- User Gender is optional and suggestion-only. Pet Calls Owner is stored on Pet, supports custom values, and defaults to Hooman only for messaging when blank.
- Memorial uses Pet Deceased Date as its only canonical date; UI calls it Memorial Date and hides it for living pets.
- Annual Memorial remembrance notifications are optional, gentle, non-urgent, and use Pet Calls Owner.
- Skill Trait current rating uses only Active, non-deleted entries; Inactive is shown as Historical.
- One canonical File model replaces Medical Attachment and Receipt file tables.


## Administrator access and Site Settings — LOCKED
- Administrator is an additional permission on a normal User; administrators may own pets and use My PawTalaan.
- Administrator Settings is available only on supported laptop/desktop layouts at a recommended minimum width of 1024 px, but security always uses server-side role authorization.
- Administrators sign in normally and access protected `/admin`; ordinary users never see admin navigation or settings data.
- Site name/content, donation presentation, support contact, maintenance/registration controls, upload constraints, notification templates, feature toggles and retention policies come from validated Site Settings rather than scattered hardcoded values.
- Changes apply globally, including to the administrator's own user experience, and are audited.
- Retention changes preview affected records. Shortening a policy never triggers immediate deletion.
- User Data Retention Mode is Standard or Protected. Protected data may Archive but is not auto-deleted while protection is active.
- Full rules are in `pawtalaan_docs/PAWTALAAN-ADMIN-SETTINGS-LOCK.md`.

## Future retention protection — NOT IN INITIAL RELEASE
- PawTalaan remains free; do not create Subscription, billing, paid tiers or access gates now.
- Future Subscription is reserved as a possible protection source only.
- A future billing module may update user retention protection, but Archive/deletion must read retention status rather than payment records.
