# PawTalaan — Administrator Access & Site Settings Lock

Status: LOCKED / APPROVED
Branch: `Pawtalaan`

Documentation reconciliation: 2026-09-24. See the [decision reconciliation register](PAWTALAAN-DECISION-RECONCILIATION.md). Existing safeguards remain approved; open policy choices below are not new permissions or defaults.

## Scope
Administrator access is an additional permission on a normal PawTalaan User account. An administrator may own pets and use all ordinary furparent features. Administration does not require a separate account type.

PawTalaan remains free in the initial release. Subscription/billing is a FUTURE feature and must not be implemented until separately approved.

## Access
- Administrators sign in through the normal PawTalaan login.
- Authorized users can switch between My PawTalaan and Administrator Settings.
- Administrator Settings uses the protected `/admin` area.
- Ordinary users never see administrator navigation or settings data.
- Administrator access is supported only on laptop/desktop layouts with a recommended minimum viewport width of 1024 px.
- Phone and tablet navigation must not show the administrator entry.
- Opening an admin URL below the supported width shows: `Administrator settings are available on a laptop or desktop computer.`
- Viewport restrictions are usability controls only. Every administrator request must enforce active server-side authorization.
- Resizing below the supported width blocks administrative forms and warns about unsaved changes.
- The initial Super Administrator is created securely during deployment, never through public registration.

## Administrator roles
### Super Administrator
- Manage site settings
- Grant, suspend and revoke administrator access
- Manage user retention protection
- View administrator audit history

### Administrator
- Manage approved ordinary site settings
- View the effect of saved settings
- Manage user retention protection when permitted
- Cannot grant Super Administrator access

## Administrator Access fields
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

## Site Setting fields
- Setting ID
- Setting Key
- Setting Value
- Value Type — Text / Number / Boolean / Date / File / JSON
- Setting Group
- Description
- Is Sensitive
- Updated By
- Updated At

## Configurable settings
- Site name, slogan and support message
- Donation instructions and GCash QR image
- Help/support contact details
- Registration enabled/disabled
- Maintenance mode and maintenance message
- Default language
- Upload size and allowed file types
- Expense, attachment, receipt, replaced-photo and Audit Log retention rules
- Memorial-reminder message template
- General notification templates
- Optional feature toggles, including Foster & Adoption
- Footer campaign/message and approved decorative assets

Passwords, OTP secrets, encryption keys, database credentials and other application secrets must never be stored as Site Settings.

## Setting behavior
- Site settings have safe application defaults.
- Saved changes apply globally, including to the administrator's own My PawTalaan experience.
- The Administrator screen shows the current value and proposed value.
- A retention-policy change previews the number and kinds of affected records before confirmation.
- Shortening a retention rule must not instantly delete existing data; affected records receive Archive/grace-period notice.
- Extending a rule affects eligible records not yet permanently deleted.
- Deleted records cannot be restored through a later setting change.
- The effective policy shown to users comes from Site Settings, not hardcoded UI text.
- Every settings change records the administrator, previous non-sensitive value, new non-sensitive value, timestamp and effect in Audit Log.
- Sensitive changes require password reconfirmation.

The fixed retention numbers in the other locks and the configurable-policy direction above still require explicit reconciliation. Do not silently relabel the fixed numbers as defaults. Exact minimum/maximum values and the current-release notice/grace duration are not recorded. The future 30-day recommendation below is not an approved current-release duration.

Password reconfirmation is an existing safeguard, not a complete administrator authentication policy. Stronger authentication, user pet/health-data visibility, last Super Administrator protection and whether an administrator may grant themselves retention protection remain unresolved. "Own records follow the same rules" does not settle permission to self-grant protection.

## User retention protection — current release
User-level retention protection is independent of billing.

Fields on User:
- Data Retention Mode — Standard / Protected
- Retention Protection Source — Administrator / System / Future Subscription
- Retention Protection Started At — optional
- Retention Protection Ends At — optional
- Retention Grace Period Ends At — optional
- Retention Protection Reason — required for an Administrator-set protection
- Retention Protection Set By — optional Administrator User ID

Rules:
- New users default to Standard.
- Only an authorized Administrator can apply or remove protection in the initial release.
- Protected records may move to Archive but are not permanently deleted while protection is active.
- Archive displays `Protected from automatic deletion` instead of a deletion date.
- Users can see their protection status but cannot change it.
- Removing or expiring protection recalculates retention and starts a notice/grace period; it must not trigger immediate deletion.
- Protection does not restore previously deleted data.
- All changes are audited.
- The administrator's own records follow the same rules as every other user's records.

## Future subscription readiness — DO NOT IMPLEMENT YET
- There is no Subscription entity, payment screen, paid tier or access gate in the initial release.
- `Future Subscription` is reserved design vocabulary and is not selectable in the initial Administrator UI.
- If separately approved later, billing will update Data Retention Mode and Protection Source.
- Archive/deletion logic reads retention protection; it must not query payment records directly.
- Ending future paid protection should start a separately approved grace period; recommended default is 30 days.
- Core PawTalaan pet-care functionality remains free regardless of future retention protection.

## Security and testing
- Enforce authorization on every administrator page, API request and setting mutation.
- Prevent privilege escalation and access through guessed URLs.
- Validate setting type, range and allowed values server-side.
- Retention settings require safe minimum/maximum boundaries.
- Test the administrator's normal pet-owner experience after every administrator change.
- Test settings changes against impacted users, Archive scheduling, notices and Audit Log.
- Obtain user sign-off before enabling Administrator Settings in production.
