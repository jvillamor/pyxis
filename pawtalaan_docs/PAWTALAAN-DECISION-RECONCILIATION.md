# PawTalaan — Decision Reconciliation

Updated: 2026-09-24
Branch: `Pawtalaan`
Status: Documentation reconciliation of existing agreements; open items are NOT approved requirements.

## Scope and authority

This update carries previously recorded agreements into the current handoff. It does not adopt reviewer recommendations as user decisions, approve new fields, enable deferred modules or alter the existing authority order. The four lock documents remain the implementation authorities. An open item blocks the affected implementation decision, not unrelated approved work.

Sources reviewed:
- [September 5 continuity backup](baby-3-system-backup.md): historical decision evidence, not a blanket replacement for newer locks.
- [Functional/Data Lock](PAWTALAAN-FUNCTIONAL-DATA-LOCK.md): behavior, build order and sign-off gates.
- [Entity/Field Lock](PAWTALAAN-ENTITY-FIELD-LOCK.md): exact fields and later corrections.
- [Administrator Settings Lock](PAWTALAAN-ADMIN-SETTINGS-LOCK.md): settings, authorization and retention protection.
- [UI/UX Lock](ATHENA-UI-UX-LOCK.md): visual decisions, including September 7 Login approvals recovered from local commits `7f020b9`, `baec7e6` and `3670661`. Only documentation is included in this update.

## Agreements recovered or clarified

| Topic | Existing agreement | Canonical destination |
| --- | --- | --- |
| Authentication | Phone/password, trusted devices, OTP for new device/change limited to once daily, optional recovery email. Detailed mechanics are incomplete. | Functional/Data: Account and ownership rules |
| Owner/caretaker capabilities | Owner identity editing; no owner editing of locked prescriptions; dose observations allowed. Caretaker checklist, running-low reports and owner-set reminders; no editing locked schedules. Later account-level relationships control. | Functional/Data: Account and ownership rules |
| Adoption | Authorized existing-phone match leads to pending adopter confirmation; completed adoption archives foster history and removes rescuer access to the transferred pet. Only authorized archived details remain searchable. Module stays deferred. | Functional/Data: Foster & Adoption |
| Care/Health | Care includes routines and follow-through tasks; Health holds medical history. Related records stay linked. | Functional/Data: Care; Entity/Field: Care |
| Expense Restore | Restore does not reset the original Month 5 deadline; protection rules remain applicable. | Entity/Field: Expenses and Administrator and retention authority |
| Administrator security | Active server-side authorization and password reconfirmation for sensitive changes already exist. | Administrator Settings: Access and Setting behavior |
| Personalization | Gender stays optional and suggestion-only; final Pet Calls Owner is user-selected/customizable, with the existing messaging fallback. Removing Gender is not approved. | Entity/Field: User and Reconciled personalization vocabulary |
| Things | Supply and Accessory status values are already enumerated; conditional field behavior is still incomplete. | Entity/Field: Things |

## Rating history requiring reconciliation

The September 5 backup says five icons, at least one slipper for a bad trait, five paw prints when there is no rating data, and grayscale suspect imagery for all slippers. The later UI lock gives a three-heart plus three-slipper example. Later entity rules establish Active, non-deleted Good/Bad entries as the source, remove manually stored Rating Position, and restrict older labels to separately approved UI wording.

The current computable agreement is limited to eligible Good/Bad entries and representation of the slipper side when an active Bad trait/behavior exists. Neither source supplies the exact count formula. Do not automatically restore the older fixed count, empty state, tooltip or suspect-photo behavior. Resolve the discrepancy explicitly before implementing those details.

## Remaining decisions — not approved by this update

| Area | What still needs a decision |
| --- | --- |
| Archive state | Fields or derivation for archive date/reason/state, replacement timing and restoration. File Expiry Date already exists but does not settle the complete lifecycle. |
| Expense Restore/export | What restoring changes, how to prevent immediate re-archiving, and whether/how users export expenses before deletion. |
| Retention | Fixed rules versus configurable defaults, exact min/max values and current-release grace duration. The future 30-day suggestion is only a recommendation. |
| Audit | Representation of old/new values and effects, Activity Log mapping, and any separate administrator/security retention policy. |
| Care sources | Canonical ownership of Care Reminder Schedule versus Reminder Repeat Rule; completion Supply Status versus Thing Supply Status and any synchronization/history behavior. |
| Authentication | Meaning/scope of new device/change and once-daily OTP, delivery/cost, expiry/retry rules, sessions, reset/recovery, credential-storage field terminology and stronger administrator authentication. |
| Site assets | File category, ownership, parent linkage and authorization for global GCash QR/footer assets. |
| Potential field overlap | Doctor details versus Vet/Clinic reference, Source values, Profile Photo versus File reference and classification versus custody relationships. Do not remove fields merely because they might be references, snapshots or derived displays. |
| Caretakers and transfers | Invitation/acceptance, exhaustive permissions, lock ownership/release and a complete general transfer workflow; deferred adoption exceptions and retained-history access. |
| Data & Privacy | Export and account-deletion workflow, third-party contact-data handling and applicable privacy review. Earlier minimization choices do not constitute a completed legal assessment. |
| Administrator access | User pet/health-data visibility, last Super Administrator protection and self-granted retention protection. |
| Updates | Read/unread state independent of reminder completion/dismissal. |
| Timeline | Surviving event content, source-reference integrity and click behavior after source deletion. |
| Field definitions | Care Status, Locked By / At semantics, Species/Sex choices, Thing timestamps and status-field requirements by Type. |
| Operations and accessibility | Contrast, tap targets, reduced motion, actual service backup/restore and retention preview dependencies before the later Archive module. The continuity backup is a documentation backup, not a service recovery plan. |

## Preserved decisions

PawTalaan remains free with voluntary donations. Foster & Adoption stays deferred. Existing field names, retention numbers, optional Gender, canonical File and derived-weight models, account-level caretakers, the approved module order and user sign-off gates remain in force subject to the explicitly recorded unresolved conflicts. No reviewer proposal has been silently converted into an agreement.
