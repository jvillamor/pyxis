# PawTalaan — Athena UI/UX Implementation Lock

Status: LOCKED / APPROVED
Branch: `Pawtalaan`

## Authority
The approved PawTalaan mockup layouts stored in `pawtalaan_docs/mockup/` and the locked palette in `pawtalaan_docs/color-palette.md` are the primary visual references for implementation.

**MANDATORY IMPLEMENTATION SET — Athena must read ALL THREE before coding:**
1. `pawtalaan_docs/ATHENA-UI-UX-LOCK.md` — visual/layout authority
2. `pawtalaan_docs/PAWTALAAN-FUNCTIONAL-DATA-LOCK.md` — functional behavior, lifecycle, module sequence, testing/sign-off authority
3. `pawtalaan_docs/PAWTALAAN-ENTITY-FIELD-LOCK.md` — **exact entity/field, optionality, relationship, superseded-field authority**
4. `pawtalaan_docs/PAWTALAAN-ADMIN-SETTINGS-LOCK.md` — administrator access, desktop-only admin UI, site settings and retention-protection authority

The UI/UX lock alone is NOT a complete implementation handoff. Athena must not invent, rename, reintroduce, or omit business fields contrary to the Entity & Field Lock.

When an older written UI description conflicts with a newer approved mockup or signed-off decision, use the latest approved mockup together with the latest signed-off functional decision. Exact database/model fields must follow `PAWTALAAN-ENTITY-FIELD-LOCK.md`.

Athena must NOT redesign an approved screen, change the visual language, replace the navigation pattern, invent alternate layouts, invent missing fields, or invent workflows without explicit approval.

## Product access — LOCKED
- PawTalaan is FREE to use.
- There is NO subscription, paid plan, premium tier, or recurring access fee.
- Donation is voluntary support only and must never gate ordinary PawTalaan functionality.

## Global UI shell — LOCKED
- Mobile-first website. Phone is the expected primary device.
- Approved palette: warm cream + teal + soft gold; use `pawtalaan_docs/color-palette.md`.
- Header pattern: hamburger menu | Pets | Search | Updates | user/profile name.
- Hamburger opens the hidden navigation as an overlay; on mobile it may occupy the full device width. It must not permanently consume page width.
- Updates is the notification center, not a duplicate Timeline.
- User/profile control opens a floating dropdown OVER page content. Opening it must not push, resize, or reserve a side column in the page.
- Account dropdown: Profile; Change Password; Caretakers; Data & Privacy; Donation; Activity Log; Help & Support; Log Out.
- Caretakers are account-level; do not create per-pet caretaker assignment in the standard pet profile.
- Footer visual reference: approved PawTalaan footer composition with bowl + yarn on the left, Support Us/campaign message in the center, and the approved right-side decorative asset(s) from the mockups/assets. Keep footer treatment consistent with the approved screen reference.

## Home — LOCKED
- Landing page; NO analytics dashboard.
- My Pets | Foster Pets.
- Pet photo/cards.
- Small attention indicator only when needed.
- Archived Foster Records and Memorial are subtly accessible below.
- Archive/Memorial must never be mixed with active pets.

## Expanded navigation — LOCKED
1. Paw Calendar
2. Timeline
3. Expenses
4. Health
5. Care
6. Memorial
7. Foster & Adoption
8. Archive

Foster & Adoption is optional/deferred. Hide the menu item entirely when the module has not been implemented.

Use the approved card-style menu direction rather than unnecessary dropdown arrows on every menu item.

## Pet Profile — LOCKED
- Pet photo + basic identity.
- Tabs: Overview | Health | Care | Expenses | Things | Timeline.
- Do not show current owner/caretaker details on the normal pet profile.
- Latest/current weight and its measurement date appear in the profile identity area and are derived from Weight Measurement history.
- If no weight exists, show `No weight recorded`.
- Compact pet rating appears after weight and is collapsible; visual rating uses hearts and slippers (approved example: 3 hearts + 3 slippers).
- Rating meaning is computed from approved Good/Bad trait/behavior data; the older manually stored `Rating Position` model is superseded.
- Do not add a separate large Rating section.
- Do not add the removed Skills & Traits dropdown to the profile shell. Skills/Traits remain structured data as defined in the Entity & Field Lock.
- Overview content sits with/under the pet profile information; do not repeat an unnecessary Overview heading/message.

## Health — LOCKED DIRECTION
Health records only: vaccinations, vet visits/checkups, lab/tests, prescriptions, procedures and other approved medical records. Do not mix routine grooming/feeding care into Health. Exact Health Record/Vet-Clinic/Attachment fields and later field corrections are mandatory from `pawtalaan_docs/PAWTALAAN-ENTITY-FIELD-LOCK.md`.

## Care — LOCKED DIRECTION
Use the approved Care mockup structure and visual shell. Exact Care Item and Care Completion/Medication Administration fields come from the Entity & Field Lock.

## Expenses — LOCKED DIRECTION
Use the approved Expenses mockup and exact Expense fields from the Entity & Field Lock. Do NOT add the removed graph or percentage visualization.

## Things — LOCKED DIRECTION
Pet belongings/items. Exact Pet Thing fields come from the Entity & Field Lock. Item photo is optional; if no photo exists, use a restrained category icon/default placeholder. Avoid an e-commerce/product-catalog appearance.

## Search — LOCKED DIRECTION
- Simple global keyword text box and search action.
- Placeholder: `Search PawTalaan…`
- Blank input does not run.
- Results appear below, grouped by relevant record type, and open canonical authorized records.
- Clearly label active, Memorial and archived results.
- Friendly empty state: `No matching PawTalaan records found`.
- No separate Search mockup is required; use the global PawTalaan shell.

## Timeline — LOCKED DIRECTION
- Permanent chronological pet history.
- Mostly system-generated from structured canonical records.
- No Export Timeline action.
- Filter belongs in the former export-action area, not as a side filter panel.
- Event Type is a dropdown.
- Exact Timeline Event fields and source references come from the Entity & Field Lock.

## Updates — LOCKED DIRECTION
Updates is a global notification/inbox page across pets. It may contain due soon, overdue/attention, health reminders, care reminders, calendar reminders, pet-related system updates, and applicable foster/adoption notifications. Support relevant navigation. Do not render it as a duplicate Timeline or require a full individual pet-profile header. Exact Reminder/Notification and Reminder Pet Status fields come from the Entity & Field Lock. All Pets opens an eligible-pet selection with active pets preselected; the user confirms the snapshot before saving. Show progress such as `3 of 5 completed`.

## Paw Calendar — LOCKED DIRECTION
- Global calendar across pets.
- Mobile-first compact month calendar.
- Paw/event indicators on dates; identify pets through the approved legend/visual treatment.
- Upcoming section can show pet, date/range, caretaker when applicable, and View Care Checklist.
- No permanent side menu on phone.
- Use the approved header and footer shell.
- Calendar uses canonical reminder/source relationships; do not create disconnected duplicate business records.

## My Account — LOCKED DIRECTION
Use the approved My Account mockup and global shell. Profile dropdown must overlay content. Account dropdown contents are exactly the approved list in the Global UI shell section unless explicitly changed later. Exact User and Device fields come from the Entity & Field Lock.

## Memorial — LOCKED DIRECTION
- Dedicated peaceful section.
- Main memorial pet photo stays.
- Pet name + life dates.
- Tabs: Life Story | Memories | Timeline.
- NO Photos tab between Life Story and Memories.
- NO Favorites section.
- Do not duplicate basic pet details inside Life Story when already displayed in the memorial profile area.
- Life Story should focus on the story/tribute and have a calm, spacious presentation.
- Exact Memorial fields and reuse of canonical Pet/Timeline/Skills-Traits history come from the Entity & Field Lock.
- The canonical Pet Deceased Date is displayed only for Memorial pets and is always labeled `Memorial Date` in UI; living pets show no empty placeholder.
- Optional annual remembrance appears as a gentle, non-urgent notification using Pet Calls Owner (fallback: Hooman).

## Archive — LOCKED DIRECTION
- System-managed holding area, not Trash and not Memorial.
- Show record/type, archive reason/date, scheduled removal date, View, Restore when allowed, and confirmed Remove Now.
- Expenses: active Month 0 through Month 3; archived Month 4; permanently deleted at Month 5.
- Replaced Pet profile photos: one month in Archive.
- Medical attachments and Expense receipts: approved three-month file retention.
- Core Archive must work without Foster & Adoption.

## Responsive mockup authority — LOCKED
- `pawtalaan_docs/mockup/calendar.png` is the approved mobile Paw Calendar layout.
- `pawtalaan_docs/mockup/website_calendar.png` is the approved larger-tablet, laptop and desktop Paw Calendar layout.
- These are responsive variants of the same module; neither supersedes the other.
- Approved module mockups live in `pawtalaan_docs/mockup/`.
- Search needs no separate mockup.
- Foster & Adoption needs no mockup while deferred.

## Repository references
Mandatory references:
- `pawtalaan_docs/ATHENA-UI-UX-LOCK.md`
- `pawtalaan_docs/PAWTALAAN-FUNCTIONAL-DATA-LOCK.md`
- `pawtalaan_docs/PAWTALAAN-ENTITY-FIELD-LOCK.md`
- `pawtalaan_docs/color-palette.md`
- `pawtalaan_docs/PAWTALAAN-ADMIN-SETTINGS-LOCK.md`
- approved mockup image files in `pawtalaan_docs/mockup/`
- approved visual assets in `pawtalaan_docs/img/`

## Development rule — LOCKED
Do NOT interpret “basic-to-complicated” freely. Follow the exact module sequence and TEST + USER SIGN-OFF gates in `pawtalaan_docs/PAWTALAAN-FUNCTIONAL-DATA-LOCK.md`. The foundation begins with Login / Account and the voluntary Donation/support entry point because PawTalaan is mobile-first. There is no Subscription phase.

For every module:
1. implement only fields defined/allowed by `PAWTALAAN-ENTITY-FIELD-LOCK.md`;
2. test the module, including field presence/optionality and relationships;
3. obtain user sign-off;
4. only then proceed to the next module.

Do not silently alter a locked UI/UX, data, field, relationship, lifecycle, or workflow decision during implementation; raise any technical conflict for approval first.


## Personalization vocabulary — LOCKED 2026-09-07
- Awmy — mommy of a dog
- Awdy — daddy of a dog
- Meowmy — mommy of a cat
- Meowdy — daddy of a cat
- Other species support Mommy, Daddy, Hooman, or custom.
- Suggestions may use species and optional User Gender, but the final Pet Calls Owner value is user-selected and stored on Pet.


## Administrator Settings — LOCKED DIRECTION
- Administrator is a normal PawTalaan user with additional permission and may own pets.
- On supported laptop/desktop layouts, authorized users may switch between My PawTalaan and Administrator Settings.
- Protected route: `/admin`.
- Recommended minimum viewport width: 1024 px.
- Do not show administrator entry or settings data on phone/tablet layouts. Unsupported widths show: `Administrator settings are available on a laptop or desktop computer.`
- Viewport is not a security control; every action requires active server-side Administrator authorization.
- Ordinary users never see administrator navigation.
- Show current and proposed setting values, affected-record previews for retention changes, explicit confirmation, success/error feedback and Audit Log traceability.
- Saved settings apply globally and are visible when the administrator returns to My PawTalaan.
- User retention protection status is visible to the affected user but editable only by authorized Administrators in the initial release.
- Full behavior and field authority: `pawtalaan_docs/PAWTALAAN-ADMIN-SETTINGS-LOCK.md`.
