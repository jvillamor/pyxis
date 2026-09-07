# Master Specification Update — 2026-08-24

This update is part of the Hybrid Project Management System Master Specification and must be applied together with `docs/hybrid-project-management-system-master-specification.md` until consolidated into the next master revision.

## Login & Session Management — Failed-Login Recovery

- After 3 consecutive failed login attempts, temporarily restrict further login attempts for the current AM or PM period using Philippine Standard Time.
- Example: a third failure at 10:15 AM restricts login until 12:00 PM; a third failure at 3:20 PM restricts login until 12:00 AM.
- Administrator may manually unlock the account when appropriate.
- Login errors must not reveal whether a username/email exists.
- If the user remains unable to successfully log in across 3 separate days with failed-login/restriction activity, make **Request Password Reset** available.
- Password reset instructions are sent to the user's registered email address using a secure, single-use, time-limited reset token/link.
- Successful reset invalidates the token and older reset links.
- Password reset does not reactivate or bypass an inactive, deactivated, or administratively restricted account.
- Failed attempts, restriction periods, reset requests, reset-email issuance, reset success/failure, and relevant device/IP/session data where available are recorded in the Security Log.

## Soft Delete — Empty Record Permanent-Delete Exception

- The creator of a newly created **Project, Kanban, or Task** may permanently delete it without Administrator approval only while it remains an empty shell.
- An empty record has no meaningful business/project data: no assignee/contractor, child task/activity or Kanban item, progress/update/comment, blocker, file, dependency, approval, triggered business notification, or other business transaction tied to it.
- For Project/Kanban, no child activities/items may exist. For Task, a saved update, attachment, blocker, assignment, or other meaningful content makes it non-empty.
- Before deletion, show a confirmation such as **Delete Empty Project/Board/Task?** with **Delete Permanently** and **Cancel**.
- Once meaningful data exists, this shortcut disappears and the normal **Deletion Request -> Administrator -> Recycle Bin** workflow applies.
- No backup is required for an empty shell, but keep a lightweight audit event containing record type/ID, creator, deleting user, and timestamp.

## Product Design Principle — Human Error Tolerance

- Design for accidental clicks, forgotten inputs, incomplete entries, and legitimate changes of mind.
- Where business/security risk is low, recovery should be easy and messages should guide rather than scold.
- Where an action has significant consequences, use confirmation, mandatory reason, approval, recovery controls, and/or audit trail as appropriate.
- System and Nanny messages must be corrective and professional, not accusatory, insulting, or shaming.
- Nanny's Angry state represents urgency/severity of the situation, not hostility toward the employee.

## Athena — High-Risk Interpretation Notes

- Three consecutive failed logins trigger the AM/PM temporary restriction; password-reset request becomes available only after inability to log in across 3 separate days and is sent to the registered email using a secure single-use time-limited token.
- Empty newly created Project/Kanban/Task shells may be permanently deleted by their creator; once meaningful data exists, controlled deletion rules apply.
- User-facing error messages must guide rather than scold or shame.
