# PawTalaan — Functional, Data & Implementation Lock

Status: LOCKED / APPROVED
Branch: `Pawtalaan`

## Purpose and authority
This document carries PawTalaan's functional behavior, lifecycle rules, module boundaries, testing gates, and exact development order. It must be read together with:

- `pawtalaan_docs/ATHENA-UI-UX-LOCK.md` — visual/layout authority
- `pawtalaan_docs/PAWTALAAN-ENTITY-FIELD-LOCK.md` — **mandatory field-level/entity authority**

Athena must read ALL THREE lock documents before implementation. This document is not permission to invent or rename fields. Exact entity/field definitions, nullable/optional rules, superseded fields, and field-specific conditions come from `PAWTALAAN-ENTITY-FIELD-LOCK.md`.

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
4. TEST + USER SIGN-OFF — foundation gate
5. My Pets / Pet Profile foundation
6. TEST + USER SIGN-OFF
7. Health
8. TEST + USER SIGN-OFF
9. Care
10. TEST + USER SIGN-OFF
11. Expenses
12. TEST + USER SIGN-OFF
13. Things / Pet Belongings
14. TEST + USER SIGN-OFF
15. Updates / Paw Calendar
16. TEST + USER SIGN-OFF
17. Timeline
18. TEST + USER SIGN-OFF
19. Search
20. TEST + USER SIGN-OFF
21. Memorial
22. TEST + USER SIGN-OFF
23. Archive
24. TEST + USER SIGN-OFF
25. Foster & Adoption
26. TEST + USER SIGN-OFF
27. Final cleanup, integration, regression, responsive/mobile testing and release validation

A later module must not be started merely because coding is automated. Finish, test, review, and obtain sign-off for the current module first. If implementation exposes a technical conflict with a locked decision, stop that affected change and raise it; do not silently redesign or reinterpret the product.

## Account and ownership rules
- Account/user is the ownership boundary for PawTalaan data.
- Caretakers are account-level, not standard per-pet assignments.
- Normal Pet Profile must not expose owner/caretaker details.
- Account menu remains: Profile; Change Password; Caretakers; Data & Privacy; Donation; Activity Log; Help & Support; Log Out.
- There is NO subscription or paid-access dependency on the account.
- Donation is voluntary support and is not an entitlement/access model.
- Exact User, Device, and Pet Relationship fields are defined in `PAWTALAAN-ENTITY-FIELD-LOCK.md`.

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

## Health — locked data boundary
Health contains medical/health records only. Routine feeding, grooming, litter, hygiene, and ordinary care do not belong here.

Exact Health Record, Vet/Clinic Reference, and Medical Attachment fields are defined in `PAWTALAAN-ENTITY-FIELD-LOCK.md`. Later approved corrections control:
- No general `Title/Description` source field in Health Record; use `Short Description`.
- General Health Record `Notes` is removed.
- Vet/Clinic is separate from Health Record.
- No veterinarian license number and no global vet directory.
- Health attachments remain separate linked records.

## Care
Care is non-medical routine/follow-through care. Exact Care Item and Care Completion/Medication Administration fields are defined in the Entity & Field Lock. Scheduled/upcoming care can feed Paw Calendar and Updates. Do not duplicate medical records here; where Care produces/relates to a medical event, preserve the relationship.

## Expenses
Expenses are pet-related spending records. Exact Expense fields and temporary receipt-file behavior are defined in the Entity & Field Lock. Keep the approved simple record/list direction; the removed graph and percentage visualization must not return.

## Things / Pet Belongings
Exact Pet Thing fields are defined in the Entity & Field Lock. Item photo is optional; absence of a photo must not block creation. Avoid an e-commerce/product-catalog appearance.

## Updates
Updates is a global account-level notification/inbox across pets, not Timeline. Exact Reminder/Notification fields are defined in the Entity & Field Lock. It can surface due soon, overdue/attention, health reminders, care reminders, calendar reminders, pet system updates, and foster/adoption notifications.

For All Pets completion, one shared schedule entry remains shared; individual pet Health/Care records are generated only after the user confirms affected pets.

## Paw Calendar
Paw Calendar is global across pets. Calendar entries may originate from health, care, reminders, and other approved pet events. Preserve source references rather than creating disconnected duplicate data.

## Timeline
Timeline is the permanent chronological pet history. Exact Timeline Event fields are defined in the Entity & Field Lock. It is mostly system-generated from canonical structured records and retains source record type/ID traceability. There is no Export Timeline action.

## Search
Search is a global access feature and is developed after Timeline in the locked build order. Search has no separate business entity. Results must respect account ownership/access and route to canonical source records.

## Memorial
Exact Memorial fields are defined in the Entity & Field Lock. Memorial is a dedicated deceased-pet context, not a normal active Pet Profile. It uses Pet identity/history canonically rather than copying it. Tabs remain Life Story | Memories | Timeline. No Photos tab and no Favorites section.

## Archive
Do not create a duplicate archived-pet entity by default. Archive/historical access is derived from canonical relationships/status/access records as defined in the Entity & Field Lock. Archive is not deletion and is not interchangeable with Memorial.

## Foster & Adoption
Exact Rescue Record and Placement fields are defined in the Entity & Field Lock. Foster pets remain distinct from My Pets. Historical foster/adoption custody must remain traceable and must not overwrite permanent Pet history. Phone matching is restricted to the authorized placement workflow and is never a public user search.

## Files
Exact File fields and retention rules are defined in the Entity & Field Lock. Temporary-file cleanup must not delete the structured business record referencing the file. Pet profile photos and Skills/Traits thumbnails are permanent exceptions under the approved retention rule.

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
4. latest approved mockup + `ATHENA-UI-UX-LOCK.md` control visual/layout direction;
5. do not invent a compromise — raise the conflict for approval.
