# PawTalaan — Athena UI/UX Implementation Lock

Status: LOCKED / APPROVED
Branch: `Pawtalaan`

## Authority
The approved PawTalaan mockup layouts stored in `docs/` and the locked palette in `docs/color-palette.md` are the primary visual references for implementation.

Athena must NOT redesign an approved screen, change the visual language, replace the navigation pattern, or invent alternate layouts without explicit approval.

When an older written UI description conflicts with a newer approved mockup or signed-off decision, use the latest approved mockup together with the latest signed-off functional decision.

Mockups define visual/layout direction. Dynamic values, records, validation, permissions, and behavior must still follow the approved functional/database specifications.

## Global UI shell — LOCKED
- Mobile-first website. Phone is the expected primary device.
- Approved palette: warm cream + teal + soft gold; use `docs/color-palette.md`.
- Header pattern: hamburger menu | Pets | Search | Updates | user/profile name.
- Hamburger opens the hidden navigation as an overlay; on mobile it may occupy the full device width. It must not permanently consume page width.
- Updates is the notification center, not a duplicate Timeline.
- User/profile control opens a floating dropdown OVER page content. Opening it must not push, resize, or reserve a side column in the page.
- Account dropdown: Profile; Change Password; Caretakers; Data & Privacy; Donation; Activity Log; Help & Support; Log Out.
- Caretakers are account-level; do not create per-pet caretaker assignment in the standard pet profile.
- Footer visual reference: approved PawTalaan footer composition with bowl + yarn on the left, Support Us/campaign message in the center, and the approved right-side decorative asset(s) from the mockups/assets. Keep footer treatment consistent with the approved screen reference.

## Home — LOCKED
- Landing page; NO dashboard.
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

Use the approved card-style menu direction rather than unnecessary dropdown arrows on every menu item.

## Pet Profile — LOCKED
- Pet photo + basic identity.
- Tabs: Overview | Health | Care | Expenses | Things | Timeline.
- Do not show current owner/caretaker details on the normal pet profile.
- Latest/current weight appears in the profile identity area.
- Compact pet rating appears after weight and is collapsible; visual rating uses hearts and slippers (approved example: 3 hearts + 3 slippers).
- Do not add a separate large Rating section.
- Do not add the removed Skills & Traits dropdown to the profile shell.
- Overview content sits with/under the pet profile information; do not repeat an unnecessary Overview heading/message.

## Health — LOCKED DIRECTION
Health records only: vaccinations, vet visits/checkups, conditions/diagnoses, medications/treatments, allergies, procedures/surgery, lab/test results, weight/health measurements, and medical attachments/documents. Weight history may be stored here; latest weight is shown in Pet Profile. Do not mix routine grooming/feeding care into Health.

## Care — LOCKED DIRECTION
Use the approved Care mockup structure and visual shell. Care includes feeding, litter box, grooming, hygiene, routines/care activities, care notes, and upcoming care as applicable.

## Expenses — LOCKED DIRECTION
Use the approved Expenses mockup. Do NOT add the removed graph or percentage visualization.

## Things — LOCKED DIRECTION
Pet belongings/items. Item photo is optional; if no photo exists, use a restrained category icon/default placeholder. Avoid an e-commerce/product-catalog appearance.

## Timeline — LOCKED DIRECTION
- Permanent chronological pet history.
- No Export Timeline action.
- Filter belongs in the former export-action area, not as a side filter panel.
- Event Type is a dropdown.

## Updates — LOCKED DIRECTION
Updates is a global notification/inbox page across pets. It may contain due soon, overdue/attention, health reminders, care reminders, calendar reminders, pet-related system updates, and applicable foster/adoption notifications. Support read/unread state and relevant navigation. Do not render it as a duplicate Timeline or require a full individual pet-profile header.

## Paw Calendar — LOCKED DIRECTION
- Global calendar across pets.
- Mobile-first compact month calendar.
- Paw/event indicators on dates; identify pets through the approved legend/visual treatment.
- Upcoming section can show pet, date/range, caretaker when applicable, and View Care Checklist.
- No permanent side menu on phone.
- Use the approved header and footer shell.

## My Account — LOCKED DIRECTION
Use the approved My Account mockup and global shell. Profile dropdown must overlay content. Account dropdown contents are exactly the approved list in the Global UI shell section unless explicitly changed later.

## Memorial — LOCKED DIRECTION
- Dedicated peaceful section.
- Main memorial pet photo stays.
- Pet name + life dates.
- Tabs: Life Story | Memories | Timeline.
- NO Photos tab between Life Story and Memories.
- NO Favorites section.
- Do not duplicate basic pet details inside Life Story when already displayed in the memorial profile area.
- Life Story should focus on the story/tribute and have a calm, spacious presentation.

## Repository references
Use the mockup image files in `docs/` as screen references (including current calendar, memorial, account, things, timeline, updates, and other approved mockups present there), `docs/color-palette.md` for palette, and `docs/img/` for approved visual assets.

## Development rule
Implement basic-to-complicated by module. After each feature/module is completed, run testing and obtain sign-off before proceeding to the next module. Do not silently alter a locked UI/UX decision during implementation; raise any technical conflict for approval first.
