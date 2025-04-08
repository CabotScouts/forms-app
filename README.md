# notify

## MVP tasks
* ~~file uploads working from filepond component~~
* ~~uploaded files related to notification being submitted~~
* ~~fix upload size limits in PHP (and nginx?)~~
* get form data sent out as email to DLV, Programme Team Lead(?), LIC, submitter, permit holder, GLV/TL (so many emails...) -> this will need sendgrid? SMTP relay might see this as spam...
* setup hCaptcha properly

## Improvements to add
### User Experience
* fix the form modified flag not preventing data loss when returned to invalid fields
* show form data after submission + printable view
* select Group from dropdown -> get GLV/TL email from this

### Uploads
* garbage collection job on temp file uploads
* ~~job to prune notifications older than three months (and delete uploaded files)~~ **TODO: confirm how long we need to keep notifications for after the event**

### Administration
* login with District workspace accounts
* list of upcoming adventurous activities
* general stats about activities (which Groups etc.)
* Groups list + workflow to add/update/delete
* Contact emails - for Groups and also for programme team/DLV
* approvals workflow
* permissions to cover all the above

### Tests
* add some I suppose