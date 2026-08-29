# PawTalaan — Functional, Data & Implementation Lock

Status: LOCKED / APPROVED
Branch: `Pawtalaan`

## Purpose and authority
This document carries the functional/data/implementation decisions that must accompany `ATHENA-UI-UX-LOCK.md`. Athena must treat the approved mockups as the visual authority and this document as the functional/data/build-order authority. Do not invent missing fields, workflows, relationships, screens, or alternate behavior. Raise a gap for approval instead.

## Mobile-first foundation
PawTalaan is a mobile-first website; the phone is the expected primary device. Development therefore starts with the account/access foundation before pet modules.

### Required development sequence and release gates
1. Login / authentication foundation
2. Account / Profile foundation
3. Subscription foundation
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
- Subscription belongs to the account/access foundation and must be established before pet feature development proceeds.

## Pet — locked data direction
Pet is the central entity. Preserve, at minimum, the approved identity/lifecycle information required by the product:
- pet id
- account/owner reference
- pet name
- pet photo
- species
- breed
- sex
- birth date / known age information as applicable
- color/markings as applicable
- latest/current weight (displayed in profile; history belongs to Health)
- status/lifecycle state
- deceased date when deceased
- memorial eligibility/state when applicable
- archive state when applicable
- created/updated audit timestamps

`deceased_date` is required in the model for a deceased pet; do not infer it solely from archive/memorial state.

Archive, Memorial, active My Pets, and active Foster Pets are distinct lifecycle/display contexts. Archived or memorialized pets must not be mixed into active pets.

## Skills, traits and pet rating
Skills and Traits are data concepts; the removed Skills & Traits profile dropdown must NOT be restored.

### Skills
Skills represent learned/trained abilities or things the pet can do. Store skills as pet-linked records so the list is extensible rather than hard-coded into the pet table. A skill record should support:
- pet reference
- skill name
- optional description/context
- active/inactive state if needed for history
- audit timestamps

### Traits / behavior classification
Traits describe temperament/behavior (for example, `malambing`). Each trait/behavior must be classifiable as **Good** or **Bad**. Keep the classification simple; do not create an invented scoring taxonomy.

Trait records should support:
- pet reference
- trait/behavior name
- classification: Good | Bad
- optional description/context
- active/inactive state if needed for history
- audit timestamps

### Rating rule
The profile rating is computed from the pet's approved good/bad behavior/trait data; it is not a manually positioned decorative value. The compact visual uses hearts for good and slippers for bad. If an active bad behavior/trait exists, the slipper side must be represented. The UI remains compact/collapsible after current weight; do not create a large standalone Rating section.

Do not invent a separate `rating_position` business field as the source of truth for rating. Display position is UI; rating meaning comes from good/bad behavior data.

## Health — locked data boundary
Health contains medical/health records only. Routine feeding, grooming, litter, hygiene, and ordinary care do not belong here.

### Health Record
Health Record is separate from Vet/Clinic Reference and Medical Attachment.
- No `Title` field.
- Use `Short Description`.
- `Notes` is removed.
- Support health categories such as vaccination, vet visit/checkup, condition/diagnosis, medication/treatment, allergy, procedure/surgery, lab/test result, and weight/health measurement.
- Record relevant date/date range, status/result/value where appropriate to the selected record type, and audit timestamps.
- Latest weight may be derived from weight/health measurement history for display on Pet Profile.

### Vet / Clinic Reference
Keep Vet/Clinic Reference separate from Health Record so health events can reference a provider without duplicating provider details. Do not build a global veterinarian directory and do not require/store a veterinarian license number as part of the baseline.

### Medical Attachment
Medical attachments/documents are separate linked records associated with the relevant pet/health record. Preserve file metadata/reference and audit information; do not overload Health Record with file columns.

## Care
Care is non-medical routine care. It includes feeding, litter box, grooming, hygiene, routines/care activities, care notes, and upcoming care/checklist information as applicable. Scheduled/upcoming care can feed Paw Calendar and Updates. Do not duplicate medical records here.

## Expenses
Expenses are pet-related spending records. Keep the approved simple record/list direction; the removed graph and percentage visualization must not return. Expense data must remain linkable to the relevant pet and, where applicable, related health/care/activity context without forcing every expense into those modules.

## Things / Pet Belongings
Things are belongings/items associated with a pet. Support a pet reference, item name/description, category/type, optional item photo, relevant acquisition/status information where applicable, and audit timestamps. Photo is optional; absence of a photo must not block creation. Do not model/display this as an e-commerce catalog.

## Updates
Updates is a global account-level notification/inbox across pets, not Timeline. Support source pet when applicable, update/notification type, message/context, due/event reference when applicable, read/unread state, created time, and navigation to the relevant record. It can surface due soon, overdue/attention, health reminders, care reminders, calendar reminders, pet system updates, and foster/adoption notifications.

## Paw Calendar
Paw Calendar is global across pets. Calendar entries may originate from health, care, reminders, and other approved pet events. Preserve the source record/reference rather than creating disconnected duplicate data. Calendar must support pet identity, date/date range/time where applicable, event type/context, and caretaker display only where applicable to that calendar/care context.

## Timeline
Timeline is the permanent chronological pet history. It should be generated/maintained from meaningful pet lifecycle and module events with source references so records remain traceable. Event Type is filterable/dropdown-based. There is no Export Timeline action.

## Search
Search is a global access feature and is developed after Timeline in the locked build order. Results must respect account ownership/access and lifecycle context. Do not leak another account's pet/data. Search should route to the canonical source record rather than create a duplicate record view.

## Memorial
Memorial is a dedicated deceased-pet context, not a normal active Pet Profile. It uses pet name + life dates and the approved tabs Life Story | Memories | Timeline. Main memorial photo remains. No Photos tab and no Favorites section. Life Story stores tribute/story content rather than duplicating already-visible identity data. Memories are pet-linked memorial records/content. Memorial Timeline reuses the pet's permanent history in the memorial context.

## Archive
Archive is for inactive/historical records that should no longer appear among active pets. Archive does not mean deletion. Preserve relationships, history, and auditability. Memorial and Archive are not interchangeable states; deceased date and memorial state remain explicit where applicable.

## Foster & Adoption
Foster pets remain distinct from My Pets in the home experience. Foster/adoption records must preserve the pet reference and the foster/adoption lifecycle/history rather than overwriting permanent pet history. Archived Foster Records remain separately accessible. Foster/adoption events may feed Updates, Calendar, and Timeline where applicable.

## Data integrity and implementation conditions
- Use stable primary keys and explicit foreign keys/relationships.
- Preserve created/updated audit timestamps on persistent business records; preserve actor/history where changes are audit-sensitive.
- Prefer normalized linked records for repeatable history (health, measurements, skills, traits, attachments, events) rather than repeating numbered columns on Pet.
- Do not hard-delete historical health/timeline/memorial/foster records as a normal user workflow; use appropriate lifecycle/archive state where required.
- Enforce account-level authorization on every pet-linked query/action.
- Validate required fields according to record type; do not make optional fields mandatory merely for UI convenience.
- Avoid uncontrolled raw/heavy SQL and scattered database calls. Use a controlled service/data-access approach, pagination for large lists, indexes for common joins/filters, prevent N+1 queries, and avoid DB calls inside loops unless intentionally batched.
- Dynamic UI must consume canonical data; do not maintain separate contradictory copies solely for individual screens.

## Testing/sign-off expectations at every gate
At each module gate validate at least:
- happy path and validation/error path
- account authorization/data isolation
- create/read/update/lifecycle behavior relevant to the module
- relationship integrity and timeline/update/calendar side effects where applicable
- mobile/responsive behavior against approved mockup/layout direction
- regression of already signed-off modules

Only after the user signs off should Athena proceed to the next module.

## Conflict rule
If this document, `ATHENA-UI-UX-LOCK.md`, and an approved mockup appear to conflict:
1. latest explicit signed-off functional decision controls behavior/data;
2. latest approved mockup controls visual/layout direction;
3. do not invent a compromise — raise the conflict for approval.
