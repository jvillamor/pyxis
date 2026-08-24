# Hybrid Project Management System - Master Specification

_Consolidated implementation draft for review. Version 1 working specification._

## 1. Purpose and Product Direction

The system is a multi-company hybrid Project Management System designed for ordinary business users, managers, executives, administrators, employees, and external contractor representatives. It supports Scrum, Kanban, and Simple Tasks while keeping the user interface understandable to people who are not project-management specialists.

Core design principles:
- Keep business language simple. Technical relationship terms may exist internally but should not burden ordinary users.
- Access is determined by role, company, department/team, project tagging, and actual activity participation.
- Nanny AI assists, summarizes, warns, and guides but must not gossip, speculate, assign blame without evidence, or bypass permissions.
- The standard project workspace is desktop/laptop-first.
- Executive access is a separate mobile-only experience focused on overview and action.
- Contractor Feedback is intentionally supported on desktop and mobile.
- Important actions are traceable through lightweight audit logs.
- Architecture must remain compatible with future cloud-hosting migration.

## 2. Supported Work Methodologies

The system shall support three work modes:

Scrum
- Projects may use sprints, backlog/work items, sprint activities, milestones, completion metrics, blockers, dependencies, baseline comparison, and change-history comparison.
- Change History Comparison is available for Scrum.

Kanban
- Kanban boards support configurable workflow columns/statuses, work items, assignments, deadlines, blockers, dependencies, completion metrics, baseline/closure behavior where applicable, and change-history comparison.
- Change History Comparison is available for Kanban.

Simple Task
- A lightweight single-task workflow for work that does not require Scrum or Kanban.
- Change History Comparison is not required.
- Project/Kanban abandonment and closure-summary rules do not apply.

Recurring Task
- A normal task generated repeatedly from a recurrence rule.
- Each generated occurrence is an independent task instance with its own updates, completion, files, blockers, and audit history.
- Change History Comparison is not required.

## 3. Roles, Companies, Teams and Access Control

System roles:
1. Administrator
2. Executive
3. Senior Manager
4. Manager
5. Team Lead / Supervisor
6. Staff

Multi-company rules:
- Employee records include Company.
- Executives, Senior Managers, and Managers may have authorized scope across multiple companies.
- Staff are end users and normally see only activities in which they participate.
- Projects are organized and visible by company, department, team, and authorized project participation.
- Staff who are not part of an activity must not see its details.
- Selected Managers and Senior Managers may see multiple projects only when explicitly tagged/authorized.
- Executives may see all projects within their authorized company scope.
- Administrator system access does not automatically mean unrestricted confidential project-content access unless the applicable permission grants it.

Every task/project navigation request must re-check authorization on the server. Visibility in a calendar, notification, saved view, or possession of a URL never grants access.

## 4. Employee Accounts and Employee Master Data

Employee records shall include appropriate identity and organizational fields, including:
- Company
- Full name
- Nickname / display name
- Employee identifier, where used
- Position/designation
- Role
- Department
- Team
- Work email
- Alternative work email
- Personal email
- Contact number
- Flag: Allow notification to personal email
- Account status (Active/Inactive)
- Avatar/profile image, where provided
- Other HR/account fields required by implementation

HR employee records do not require a project Start Date field.

Employee creation:
- Administrators may create employees within their authorized administrative scope.
- Managers may create employees who are their staff, subject to explicit employee-creation permission and organizational scope.
- A Manager cannot create/assign a role above the Manager's permitted level.
- A Manager normally may create Team Lead/Supervisor and Staff records, but not Manager, Senior Manager, Executive, or Administrator roles.
- Higher-role creation attempts must be blocked, audited, and trigger an in-app notification and email to Administrator.
- Where implemented, the blocked creator may submit the proposed higher-role record for Administrator approval instead of activating it.

Duplicate/inactive-account validation occurs before creating a new employee. If a matching account is inactive, suggest reactivation instead of creating a duplicate. Reactivation does not restore access to closed/completed/archived projects previously handled by the employee; current access must be recalculated from present assignments and permissions.

## 5. Login and Session Management

Employee login follows standard role-based authentication.

Executive login:
- A special Executive Login exists only on mobile devices.
- It must not appear in desktop view.
- For the current version, the Executive answers one randomly selected knowledge question configured for the executive.
- The Executive experience is intentionally overview-focused.

Standard users logging in from a phone/small screen should be advised to use a desktop/laptop because detailed project boards, calendars, dependencies, reports, and files may cause information overload on a small screen. They may continue anyway, but full mobile layout parity is not required.

Session management:
- Session timeout is based on inactivity, not simply elapsed time.
- Do not log out an active user every 30 minutes.
- Warn before an idle session expires and provide Stay Logged In.
- Support logout from other sessions, session/device history, and appropriate forced logout after account deactivation, significant permission removal, security reset, or Administrator action.

## 6. Nanny AI

Nanny AI is the system's supportive project assistant. Nanny is not a gossip mechanism and must respect all project permissions.

Official Nanny emotional states:
1. Disappointed
2. Worried
3. Angry
4. Smiling
5. Happy
6. Accommodating

Nanny images are static. Nanny, her cane, facial expression, body, and gestures must not be animated.

Deadline/risk behavior:
- Worried and Disappointed are appropriate when work may miss a deadline, including halfway-progress concerns.
- Angry may be used for serious deadline/critical conditions, but messages remain professional and non-degrading.
- A saved Blocker may cause Disappointed Nanny to appear.
- Nanny should explain project/task status from recorded evidence and must not invent blame.

Login Nanny:
- The cane-holding Accommodating Nanny may appear after login with a gentle grandma-style thought such as reminders to eat, drink coffee/tea, stay comfortable, or take work one activity at a time.
- Nanny then summarizes activities lined up for the user: due today, approaching deadline, continuing work, blockers, pending reviews/approvals, mentions, and other relevant authorized items.
- Full welcome may be disabled by the user.

Logout Nanny:
- Before logout, Nanny may remind the employee about personal belongings such as keys, umbrella, jacket, ID/access card, phone/charger, and bag, plus project housekeeping such as missing updates or pending feedback.
- Logout must never be blocked.
- Logout reminder may be disabled by the user.

Eye-in-the-sky rule:
- Users may turn off only casual Welcome and Logout Nanny.
- Nanny's background monitoring of deadlines, blockers, critical-path risk, idle tasks, significant issues, approvals, and project health cannot be disabled.

Nanny Silence/Snooze:
- Non-critical Nanny prompts may be dismissed or snoozed (e.g. 1 hour, 2 hours, later today, tomorrow).
- Snooze hides the prompt only; it does not pause deadlines, tasks, escalations, notifications, or monitoring.
- The same prompt must not regenerate during its snooze period.
- Critical/security/required-action conditions use acknowledgement rather than indefinite snooze.
- Snoozing/dismissing Nanny must not affect employee performance metrics.

## 7. Dashboards and Project Metrics

Dashboards shall adapt to methodology and role and show completion metrics per relevant entry.

Role-based default dashboard examples:
- Staff: My Activities, Due Today, Needs Attention, My Calendar.
- Team Lead/Supervisor: Team Activities, Blockers, Due This Week, Pending Reviews, Team Calendar.
- Manager/Senior Manager: Project Health, Critical Path Risks, Revised Deadlines, Contractor Activities, Pending Approvals.
- Executive: Portfolio Health, Significant Delivery Issues, Critical Projects, Executive Updates, Pending Escalations.
- Administrator: System Alerts, Audit Anomalies, Failed Logins, Deletion Requests, Bulk Actions, File Security Events, Integration Health, Backup Health.

Executive mobile cards are intentionally concise. Example:
Project: ABS
Status: In Progress
Expected Completion by Today: 50%
Actual Completion: 37%
Variance: -13 percentage points
Indicator: Needs Attention

Expected Completion means where the project should be today according to the approved baseline/target schedule. Actual Completion is verified work completed. Variance = Actual - Expected.

Project-performance visual language:
- $ = On Track
- lightning = Needs Attention
- red apple = Significant Delivery Issues / Critical Condition
Do not use skull imagery.

## 8. Executive Quick Inquiry

Executives may trigger a quick email/in-app inquiry directly from the mobile project overview when a project shows concern.

Action: Ask for Update
Suggested short message: "What is going on with this project? Please provide an update."

The Executive may edit the message before sending. The system proposes appropriate recipients based on the assigned Manager, relevant Senior Manager, and Team Lead/Supervisor for the affected work. Recipient list is shown before send.

The inquiry includes project context such as expected progress, actual progress, and variance. Recipients receive email and in-app notification. Their response should be entered back into the project update history where possible, allowing Nanny to summarize the response for the Executive.

The dashboard should indicate Awaiting Response / Update Received. Inquiry actions are audited.

## 9. Task Updates, Mentions and Blockers

Tasks must support narrative updates in addition to status changes.

Task Update:
- Users may enter progress/update text.
- Employees may be @tagged in the update.
- Tagged employees receive email and in-app notification for awareness.
- If a tagged employee is not part of the activity, clicking the notification must not open the task. Instead show a large closable context bubble explaining why the employee was tagged, limited to information they are permitted to see.
- If the tagged user is an authorized participant, clicking the notification re-checks access and opens the task.

Blocker:
- Blocker is part of task/activity input, not merely a status category.
- Saving a blocker may display Disappointed Nanny.
- Dependencies and performance calculations must recognize when an assignee cannot progress because of a predecessor/blocker outside their control.

## 10. Notifications

In-app notifications use an animated bell/notification indicator. Nanny remains static.

Notification display:
- New notification activates the bell/indicator.
- Wait 10 seconds, then automatically display the in-app notification as a large closable message bubble/panel.
- If the user opens the bell during the 10-second delay, show the notification immediately.
- A visible Close button is mandatory.
- Reduced-motion mode may suppress animation while preserving unread badge/icon/text.

Deduplication:
- Same task + same unchanged condition: maximum 2 notifications under normal conditions.
- Near deadline: maximum 5 notifications with at least a 1-hour gap.
- If status changes into a critical situation: use the critical escalation interval of every 2 hours, maximum 5 notifications for that critical-condition episode, until resolved or materially changed.
- Use only the highest applicable severity schedule; do not run normal, near-deadline, and critical schedules simultaneously.
- A materially different condition has its own counter.
- Resolving/updating the condition stops the current sequence.

Idle task:
- A newly created/assigned task with no meaningful activity after 2 calendar days triggers a notification to the assignee.
- Meaningful activity includes progress/status update, task update, file submission, blocker, or other recognized work action.
- Merely viewing/opening the task does not reset the idle counter.
- Idle is not the same as overdue.

## 11. Team Calendar

Each Team shall have a calendar that consolidates authorized scheduled activities, including Simple Tasks, Scrum/Sprint activities, Kanban items with dates, recurring tasks, milestones, reviews/approvals, contractor work, and project target dates.

Views: Month, Week, Day, Agenda.
Filters may include Project, Employee, Activity Type, Methodology, Status, Priority, Recurring Tasks, Milestones, Contractor Work.

Calendar access never expands project permissions.

Task detail popover:
- Desktop hover opens details.
- Mobile/tablet tap may open the preview where supported.
- Show task/activity, project, methodology, status, completion %, priority, Start Date, Target Completion, Actual Completion if completed, assignee avatar, nickname/display name, team, latest authorized update summary, and blocker indicator.
- Contractor assignment may show contractor plus representative.

Date/status markers:
- Start marker
- Target completion marker
- Actual completion marker
- Blocked marker
- One horse/jockey marker for In Progress

Single horse/jockey rule:
For every In Progress task, render exactly ONE horse/jockey marker representing the task's current position in time. Never repeat the horse across every date between Start and Target.

Example: Start Aug 24, Target Aug 28, current date Aug 26. Show Start on Aug 24, exactly one horse on Aug 26, Target on Aug 28. When the task remains in progress on Aug 27, the horse moves to Aug 27 and leaves no horse behind. When completed, the horse disappears and Actual Completion marks the completion date.

Hovering the horse shows the complete task context beginning from the original Start Date; the horse date must not be misinterpreted as the task Start Date.

Clicking a task/action icon performs a fresh permission check before opening details.

## 12. Business Days and Holidays

Business days, holidays, weekends, company shutdowns, and special non-working days are part of the Team/Company Calendar.

When a user selects a Start, Due, Target, recurring, or milestone date that falls on a holiday/non-working day, show a warning but allow the user to continue. Do not automatically reject or move the date.

This is necessary because some work is intentionally performed when ordinary employees are absent, such as office painting, truck repair, equipment installation, server maintenance, electrical work, cleaning, or renovation.

Recurring tasks may optionally support a future Working Days Only rule, but ordinary holiday detection is advisory.

## 13. Task Dependencies and Critical Path

Dependencies must be well plotted visually and logically, but the ordinary user interface must avoid technical parent/child terminology.

Preferred UI language:
- Depends On: what must happen before this task can proceed.
- Affects: activities that may be affected if this task is delayed.

Example:
Requirements -> Development -> QA Testing -> UAT -> Deployment

The system may internally support standard dependency logic, but ordinary forms should use simple prompts such as:
- Does this task depend on another activity?
- Depends On: [activity]
- This task can start when: another task is completed / starts / reaches a milestone.

Dedicated Timeline/Gantt/Critical Path views should plot directional dependency connector lines, relationship condition, lag/waiting period where applicable, critical-path status, and downstream delay impact.

To avoid visual spaghetti, provide Show All Dependencies, Critical Path Only, and Selected Task Dependencies.

Critical-path warnings must identify affected downstream activities/milestones. Deadline changes on critical-path work should warn the user, require the existing deadline-change reason, recalculate impact, notify assigned Managers/Executives as applicable, and audit the change.

Nanny should distinguish between a late non-critical task and a critical-path delay and must account for predecessor-caused delays when evaluating employee performance.

## 14. Project Baseline and Variance

Once an approved plan is baselined, preserve the original approved scope, dates, milestones, planned tasks, and planned completion. Later changes must not overwrite the original baseline.

Primary presentation:
1. Baseline vs Current comparison table
2. Original vs Current visual timeline
3. Planned vs Actual progress graph
4. Nanny factual executive summary
5. Formal Baseline Variance Report

Typical comparison fields include Start, Target Completion, Milestones, Planned Tasks, Scope, Expected Completion by Today, Actual Completion, and Variance.

Approved revised baselines may be created when management legitimately changes the plan, but Baseline 1 must remain preserved. New official baselines require Manager approval and a reason.

Nanny may explain the variance and identify recorded causes/affected activities but must not invent blame.

## 15. Change History Comparison

Change History Comparison applies only to Scrum and Kanban.

Scrum may compare sprint scope, backlog/work items, requirements, assignments, target dates, completion, priorities, blockers, and items added/removed.
Kanban may compare work items, workflow movement, assignments, priority, target dates, requirements, blockers, and completion changes.

Provide an easy Earlier Version vs Later Version comparison and useful presets such as Sprint Start vs Sprint End or Previous Snapshot vs Current.

Use lightweight deltas rather than copying the entire project/board for every small change.

Simple Tasks and Recurring Tasks do not have this user-facing comparison feature, though ordinary audit history remains.

## 16. Recurring Tasks

Authorized users may create recurring tasks with Daily, Weekly, Monthly, Quarterly, Yearly, or Custom recurrence.

Each occurrence is an independent task instance. Recurrence configuration may include frequency, interval, days/date, recurrence start, recurrence end/no end, assignee, generation timing, next occurrence, and status.

Recurring tasks may retain the assignee, but before generating an occurrence the system verifies that the employee is active, authorized, and still valid for the work. If not, generate as Unassigned where allowed and notify the Team Lead/Manager.

Overdue prior occurrences do not automatically prevent future occurrences.

When a project is completed/archived, project-specific recurrence stops after appropriate warning.

Creation warning:
Before the first save/activation, inform the user that terminating the recurring task later requires Administrator or Executive approval. Ask whether the user still wants to proceed.

Termination:
- Terminate Recurrence requires mandatory reason.
- Administrator OR Executive approval is required.
- Until approved, status is Termination Pending Approval and recurrence continues.
- Once approved, future generation stops; historical occurrences remain.
- Permanent termination cannot be performed through an ordinary task edit/status change.

## 17. Project Clone / Reusable Project Structure

Authorized users may retrieve an existing Active, Completed, or Archived project they are allowed to access and clone it into a new independent project.

Clone reusable structure such as methodology, phases/milestones, Scrum/Kanban structure, task labels/titles, descriptions, dependencies, checklists, file categories, and reusable workflow configuration.

Do not copy historical progress, updates, comments, blockers, notifications, contractor feedback, ratings, audit history, or completion records.

The wizard must specifically ask whether to copy task labels. Previous assignees must not be copied. Copied tasks start Unassigned. Old contractor representatives, reviewers, approvers, tagged employees, and historical access permissions must not be blindly inherited.

New dates are established for the new project; old actual dates are not copied as actual dates.

Long-running project rule:
If the source project exceeds an Administrator-configurable duration threshold, require Manager approval before cloning. Requester provides a reason. Nanny may warn that an old/long-running structure may contain outdated processes.

Audit source project, new project, requester, approver if applicable, date, copied elements, and reason.

## 18. Bulk Actions

Bulk business actions such as mass assignment/reassignment, priority changes, Kanban movement, workflow changes, or other supported mass changes require controlled approval.

Flow:
Select records -> choose bulk action -> mandatory reason -> submit -> Manager/Team Lead approval -> preview impact -> execute -> audit -> notify IT and Executives.

Requester cannot approve their own bulk action. Approval must come from an authority with scope over affected records. Cross-project actions require an approver whose scope covers the operation.

Preview must show how many records can change, cannot change, are restricted, or are already completed. Never silently skip failures.

After successful bulk business change, send concise in-app/email notification to IT and Executives.

Exception:
Policy-based archiving and routine log cleanup are exempt from the normal Manager/Team Lead approval and routine Executive/IT notification, but remain auditable and must obey retention rules. Cleanup failure/anomaly notifies IT; suspicious/unusually large cleanup may notify IT + Administrator.

Where practical, preserve lightweight previous-state deltas to support rollback/recovery.

## 19. Project Archiving, Retention and Restore

Completed projects should be archived, not deleted. Archiving preserves tasks, updates, files, contractors, ratings, deadline history, notifications where retained, and audit history.

Archived projects are read-only by default, excluded from active dashboards and routine Nanny deadline monitoring, but remain available to authorized historical users.

Restore is limited to authorized project Managers/Senior Managers and Administrators with appropriate project permission. Restoration requires a reason and is audited.

Archive does not erase historical reporting, employee project-performance history, contractor performance, baseline analysis, or cloning eligibility.

Retention is integrated into Data Archiving:
- Retention periods are Administrator-configurable by category.
- Important archived data is never automatically deleted merely because retention is reached.
- Items that reach their retention threshold are marked RED / Action Required for Administrator review.
- Admin may Keep Archived, Extend Retention, Move to Long-Term Archive, or initiate controlled permanent deletion.
- Support Retention Hold / Do Not Purge.
- Auto-Archive may exist; Auto-Archive is never Auto-Delete.
- Routine notifications/application logs may follow automated cleanup rules according to policy.
- Backup is disaster recovery, not the primary long-term archive.

## 20. Soft Delete / Recycle Bin

Managers and other business users must not directly delete project records. They may submit a Deletion Request with record/item, project, reason, requester, and timestamp.

Administrator reviews and approves/rejects the request. Administrator receives in-app and email notification.

Soft-deleted records move to a Recycle Bin and preserve original record ID/type, original project/activity, reason, requester, deleting Administrator, deletion date/time, restore status, and retention expiry.

Restore should return the item to its original relationship where possible. If a parent relationship is unavailable, flag for Administrator review instead of restoring into the wrong place.

Permanent deletion is separate and highly restricted. It requires Administrator permission, mandatory reason, applicable retention/recovery checks, audit trail, and additional confirmation for sensitive records.

Before destructive permanent deletion, create or verify a recoverable backup/snapshot where policy requires it. File contents must not be stored in audit logs.

Deletion never removes the audit event showing that deletion occurred.

## 21. Project/Kanban Closure and Abandonment

Completed Project/Kanban:
Before marking Completed, run a closure checklist covering required deliverables, activities/milestones, blockers/open issues, required files, final updates, contractor feedback/ratings, approvals, and critical dependencies.

Abandonment:
Abandonment applies only to Project and Kanban, not Simple Task or Recurring Task.
- Request Abandonment
- Mandatory reason
- Capture current state
- Executive OR Administrator approval
- Until approved: Abandonment Pending Approval
- If approved: status becomes Abandoned; preserve all unfinished work/history; stop applicable routine future monitoring/generation; notify relevant parties; make eligible for normal archiving/retention.
- If rejected: continue normally and preserve rejection history.

Abandoned work must not count as successfully completed, and employees/contractors must not automatically receive negative performance impact simply because management/client abandoned the work.

## 22. Closed-Entry Nanny Summary

This conditional section is visible inside Project entries and Kanban entries only.

If status = Completed:
Show Nanny Final Summary & Lessons Learned after the normal project/board details. It may summarize baseline vs actual, deadline changes, blockers, critical-path effects, contractor performance, major changes, outcomes, and evidence-based lessons for future work.

If status = Abandoned:
Show the Approved Reason for Abandonment prominently after the normal details, plus a factual Nanny condition summary such as completion at abandonment and remaining open items.

The approved abandonment reason is authoritative. Nanny must not replace, alter, reinterpret, speculate about, or assign blame beyond that approved reason.

Do not show this closure section while the item is Planning, Active, In Progress, On Hold, or another ongoing state. It does not apply to Simple Tasks or Recurring Tasks.

## 23. Escalation Matrix

Escalation originates from an actual task/incident update.

Update form:
- Escalate this issue: Yes/No
- If Yes: Escalated To [authorized recipient]

The update itself supplies the context; no separate escalation comment is required.

Normal organizational path:
Staff -> Team Lead/Supervisor -> Manager -> Senior Manager -> Executive
Use actual company/project hierarchy and permissions; do not expose unrelated recipients.

On save:
Save update -> mark escalation -> in-app notification -> email -> audit.

Preserve the complete escalation chain and timestamps. Do not overwrite earlier escalation recipients.

An authorized Manager may:
- Escalate further, or
- Clear Escalation (Yes -> No)

Clearing escalation requires a mandatory Reason for Removing Escalation. The original update, escalation, recipient, clearing Manager, reason, and timestamps remain permanently traceable. The employee who raised the escalation receives an in-app notification that it was cleared and the reason.

Escalating an issue legitimately must not itself reduce employee performance.

## 24. Contractors and Contractor Feedback

The system shall maintain a Contractor table.

When assigning a task/project activity to a contractor:
- Select contractor.
- Enter/select representative name.
- Enter representative contact number.
- Previously used representatives should be recallable.
- If the representative is not in the previous list, allow new name and contact number entry.

Contractor Feedback:
- Available on desktop and mobile.
- Contractor login is not required.
- The contractor must identify themselves as a representative and provide representative name and contact number.
- Nanny may assist the representative in submitting feedback by asking for project reference/context and who they are in contact with.
- The system uses available identifiers to determine the relevant project.
- If the system cannot confidently determine the project, trigger an email to the Project Management Administrator instead of exposing unrelated project information.

Security:
- Treat all contractor inputs as untrusted.
- Use parameterized queries/prepared statements, server-side validation, output encoding, CSRF/session protections where applicable, rate limiting, secure upload handling, and other standard protections against SQL injection and web penetration.
- Contractor feedback must never become a permission bypass.

Contractor ratings:
Rate 1 to 5 for:
- Service
- Accuracy in following instructions
- Commitment to deadline
Use project evidence and fair evaluation principles.

## 25. Employee Project Performance

Employee project performance may be derived from project-management handling, but ratings must remain evidence-based and fair.

Consider factors such as timely delivery, quality/accuracy, updates, handling of blockers, appropriate escalation, responsibility for delays, dependency-caused delays, and project context.

Do not penalize an employee for delays caused by predecessor dependencies or approved abandonment outside their control.

Visual summary:
- $ On Track
- lightning Needs Attention
- red apple Significant Delivery Issues

These indicators are project-performance summaries, not disciplinary labels. Detailed evidence should remain available to authorized reviewers.

## 26. Files and Categories

Projects/tasks may accept file uploads.

File security validation is mandatory:
- Validate file type and extension against allowed formats.
- Validate MIME/content signature where practical.
- Enforce size limits.
- Scan/quarantine files using available malware/virus scanning capability.
- Reject executable/destructive or otherwise prohibited content.
- Store safely outside directly executable paths.
- Log upload result/security status without storing file contents in logs.

Every uploaded file must have a mandatory File Category.

File categories are reusable. If no existing category matches, an authorized user may enter a new category. Duplicate/similar category validation should suggest an existing category where appropriate but allow a genuinely distinct category.

File events such as upload, quarantine, rejection, download, deletion, and restore are auditable according to lightweight logging rules.

## 27. Saved Filters / Views and Personalized Dashboard

Managers and Administrators may save frequently used filtered views such as:
- Blocked Activities
- Projects with Revised Deadlines
- Overdue Contractor Activities
- Pending Bulk Action Requests
- Critical Path at Risk

Saved views may optionally be added to the user's dashboard as widgets. Users may add/remove/reorder/rename saved dashboard views and choose a preferred default dashboard view.

Saved views never expand permissions; they query only currently authorized records.

Optional alert-enabled saved views may notify the user when new matching items appear, but this is opt-in to avoid notification overload.

Nanny may summarize authorized saved dashboard views when answering "what needs my attention?"

## 28. Global Search with Permissions

Global Search is privileged.

Available to:
- Administrator
- Executive
- Authorized Manager/Senior Manager

Managers/Senior Managers search only explicitly permitted Project/Kanban scope. Team Leads/Supervisors and Staff do not receive Global Search; they may use ordinary search/filter inside their own authorized activities.

Global Search may find authorized Projects, Kanban Boards, Tasks/Activities, Task Updates, Files/Categories, Contractors/Representatives, Milestones, and Blockers.

Security rule:
Unauthorized records must be excluded by the server-side search query itself, not fetched then hidden in the UI. Do not leak restricted information through titles, snippets, filenames, autocomplete, counts, or "result exists but no permission" messages.

Clicking a result performs a fresh authorization check.

## 29. Data Export and Backup Permissions

View permission does not automatically grant export permission.

Administrator:
- Authorized system/company exports
- Backup and restore management

Executive:
- Authorized project/portfolio and management-report exports within company scope
- Not necessarily raw database backups

Senior Manager/Manager:
- Export only from explicitly authorized projects and where the specific Export permission is granted.

Team Lead/Supervisor:
- Export authorized activities within permitted team/project scope, subject to configured permissions.

Staff/End User:
- Export only activities/tasks directly assigned to them and permitted fields/updates related to their own work.
- Must not export other employees' tasks, restricted management notes, contractor evaluations, or project-wide restricted data merely because they share a project.

Every export re-checks permission server-side at generation time and is lightly audited with user, scope, export type, timestamp, record count, and result.

## 30. Data Import and Field Mapping

CSV and Excel (.xlsx) import is highly required for migration and setup.

Supported import domains should include Companies, Employees, Departments, Teams, Contractors, Contractor Representatives, Projects, Scrum/Kanban items, Tasks, and initial task lists.

Import Mapping Wizard:
Upload -> Security Check -> Map Columns -> Validate -> Preview -> Confirm -> Import -> Results

The system suggests likely column mappings but allows correction. Mandatory system fields must be clearly identified. Existing spreadsheets do not have to use system column names.

Before import, show valid rows, rows needing review, rejected rows, duplicates, missing relationships, and other validation issues.

Duplicate handling options may include Skip, Update Existing, Review, or Reactivate where appropriate.

Respect relationship order such as Companies -> Departments/Teams -> Employees -> Contractors/Representatives -> Projects -> Activities.

Provide downloadable import templates for major data types.

Do not execute spreadsheet formulas/macros. Extract validated cell values only. Imported files pass the same upload/security validation rules.

Administrator has full import. Project-level task import for Managers/Senior Managers may be granted through a separate permission. Staff do not have bulk import.

Use lightweight batch-level audit logging and provide an Import Results/Error Report.

## 31. Duplicate Detection and Validation

Duplicate Detection is part of validation for manual entry and import.

Check appropriate identifiers such as normalized name, work/personal email, contact number, company, contractor association, project code, and category name.

Apply to Employees, Contractors, Representatives, Projects, File Categories, and other appropriate masters.

Inactive employee match:
- Suggest Reactivate instead of creating a duplicate.
- Reactivation does not restore closed/completed/archived project access.
- Recalculate current access from current company/team/project assignments.

File-category duplicate detection may be advisory because similar category names can be legitimately distinct.

## 32. Deadline Changes

When a due date/target date is changed, the user changing it must provide a mandatory reason.

After save:
- Record old and new dates and reason.
- Trigger email to the assigned Manager and Executives as defined by project scope.
- Create appropriate in-app notification.
- Audit the change.

If the affected task is on the critical path, warn about downstream impact before save and recalculate affected activities/milestones.

## 33. Audit Trail and Anomaly Review

Maintain a centralized, tamper-resistant lightweight audit trail for significant user, project, security, contractor, file, notification, and administrative actions.

Typical events include login/logout, failed login, Executive login attempts, role/permission/company/project-access changes, task creation/reassignment/status/completion, deadline changes and reasons, blockers, updates/tags, notification/email delivery status, contractor identification/feedback, file security events, project archive/restore/abandonment, approvals, bulk actions, imports/exports, integration changes, suspicious/rejected requests, and rate-limit events.

Record compact metadata such as timestamp, user ID, role, company ID, project/task ID, event type, result, and small before/after deltas or references. Do not dump full request bodies, attachments, or duplicate full task contents into logs.

Separate:
- Operational Audit Log
- Security Log
- Application/Error Log

Administrator Audit & Security Log should support filters such as Date Range, User, Role, Company, Department, Team, Project, Event Type, Success/Failure, Security Severity, IP/Device/Session, Contractor, File Event, Deadline Change, Permission Change, Bulk Operation, Import/Export.

Useful quick filters include Failed Logins, Unauthorized Access Attempts, Repeated Deadline Changes, Permission Changes, Contractor Match Failures, Quarantined/Rejected Files, Suspicious Requests, Unusual Downloads, High Notification/Email Volume, and Rate-Limited activity.

Anomaly flags assist investigation and must not automatically accuse a user of misconduct.

Admin system-log access does not automatically reveal confidential project content beyond necessary authorized metadata.

## 34. Lightweight Logging and Cloud Readiness

Logging must remain light and portable.

- Store IDs/references and meaningful deltas instead of complete record copies where possible.
- Task updates live in the Task Update table; audit records may reference the update ID.
- File contents never go into logs.
- Nanny conversations are not exhaustively logged; only meaningful system actions/events where necessary.
- Use standard timestamps and portable identifiers.
- Avoid server-specific filesystem paths in business data.
- Keep logging independent from presentation.
- Use retention tiers so routine technical logs expire sooner than security/audit records.

Principle: log enough to reconstruct important actions, not everything the application touches.

## 35. API / Integration Layer

Provide a clean integration boundary for Email, Cloud Storage, Calendar, Reporting, Nanny/AI services, and future external/internal systems.

Supported authentication may include OAuth, access token, API key, service account, or another secure mechanism appropriate to the service. Secrets must not be displayed or stored in plain text.

Integration Management shows simple status:
- Connected
- Disconnected
- Needs Reauthorization
- Error

Also show Last Checked and provide Test Connection.

If a token expires/revokes, change status to Needs Reauthorization and notify Administrator through available channels. If email itself is broken, in-app notification remains.

Grant minimum required integration scope. One integration must not automatically receive unrelated system permissions.

Administrator dashboard includes Integration Health.

## 36. Backup and Disaster Recovery

Automatic backup covers both database/data and uploaded files.

Default schedule: Weekly.
Administrator may configure Frequency, Day, Time, Backup Type, Retention, and Destination.

Backup destinations may include same hosting/server storage, separate storage/server, cloud/object storage, or another supported integration.

If backup is stored on the same hosting and the environment exposes capacity information, monitor:
- Total storage
- Used storage
- Available storage
- Backup storage usage
- Last backup size
- Estimated capacity for next backup

Warn when storage is low or the next backup may not fit. Never automatically delete important project data to make room.

Backup statuses:
Running, Successful, Failed, Partial, Insufficient Storage.

After backup, perform lightweight integrity verification. If database succeeds but files fail, mark Partial rather than Successful.

Administrator Backup History supports controlled restore:
Select backup -> review date/scope -> show impact -> mandatory reason -> confirm -> restore -> audit.
Major restores notify IT/Executives according to restore policy.

Backup destination architecture must be storage-agnostic so same-host storage can later move to cloud/object storage without redesigning the application. External backup is recommended whenever available.

## 37. User Preferences and Accessibility

User-controllable preferences are intentionally limited.

Users may control:
- Nanny Welcome Greeting On/Off
- Nanny Logout Reminder On/Off
- Preferred Dashboard View
- Display/layout preferences where implemented
- Future language/display preferences

Users cannot disable mandatory project monitoring, escalation, security, audit, deadline, or critical notifications through personal preferences.

Accessibility:
- Keyboard-friendly controls where practical
- Screen-reader-friendly labels
- Sufficient contrast
- Reduced-motion support for notification animation
- Nanny is static; only notification bell/app notification indicators may animate.

## 38. Time Standard

Version 1 uses Philippine Standard Time for the entire system.

System Timezone: Asia/Manila (UTC+8)

All task dates, calendar entries, recurring tasks, notifications, emails, Nanny reminders, deadline calculations, updates, contractor feedback, audit trails, file events, approvals, reports, exports, and backups use/display Philippine time.

Store the timezone as system configuration rather than scattering hard-coded UTC+8 assumptions throughout the application, preserving future international expansion capability.

## 39. Core Security Requirements

Security controls must be enforced server-side and not depend only on hidden buttons or client-side checks.

Core requirements:
- Role/company/project/activity authorization on every protected read/write action.
- Fresh authorization checks before opening calendar items, notifications, search results, exports, or direct URLs.
- Parameterized queries/prepared statements.
- Input validation and output encoding.
- Secure session handling and CSRF protection where applicable.
- Rate limiting for exposed/public-facing endpoints such as contractor feedback.
- Secure file validation, scanning/quarantine, and non-executable storage.
- Least-privilege integration tokens/scopes.
- Secrets never exposed in UI/logs.
- Audit significant security and permission events.
- Unauthorized search/results must not leak metadata.

## 40. Implementation Notes for Athena

The implementation must preserve the business rules in this specification exactly.

High-risk interpretation rules:
- Executive Login is mobile-only and must not appear on desktop.
- Standard project workspace is desktop/laptop-first; Contractor Feedback is desktop + mobile.
- Nanny is static and never animated.
- Nanny is supportive, evidence-based, permission-aware, and not a gossip mechanism.
- One In-Progress task = exactly one horse/jockey current-position marker. No horse trail.
- Clicking a calendar/search/notification item never bypasses permission checks.
- Project cloning never carries old assignees automatically.
- Managers cannot directly delete records.
- Managers cannot create employee roles above their permitted level.
- Baseline revisions never overwrite the original baseline.
- Change History Comparison applies to Scrum and Kanban only.
- Project/Kanban abandonment requires Executive OR Administrator approval.
- Simple/Recurring Tasks do not use Project/Kanban abandonment workflow.
- Recurring Task termination requires Administrator OR Executive approval, and users are warned before creating the recurrence.
- Completed Project/Kanban shows Nanny Final Summary + Lessons Learned.
- Abandoned Project/Kanban shows the approved abandonment reason as the authoritative explanation.
- Retention-expired important archive items turn RED / Action Required; they are not auto-deleted.
- Red apple is the serious-delivery/critical visual symbol.
- Normal duplicate notifications max at 2; near deadline max at 5 with >=1-hour gaps; critical status-change notifications use 2-hour intervals, max 5.
- Clearing an escalation requires a mandatory reason.
- Philippine Standard Time is the Version 1 system timezone.
