# forms-app

```
services:
  app:
    image: ghcr.io/CabotScouts/forms-app:latest
    container_name: forms-app
    volumes:
      - '.env:/data/.env:rw'
      - 'storage:/data/storage/app/'
    networks:
      - mariadb
    ports:
      - 80:8080

volumes:
  storage:
networks:
  mariadb:
    external: true
```

## Improvements to add
### User Experience
* Fix the form modified flag not preventing data loss when returned to invalid fields
* Select Group from dropdown -> get GLV/TL email from this

### Administration
* Login with District workspace accounts
* List of upcoming adventurous activities
* General stats about activities (which Groups etc.)
* Groups list + workflow to add/update/delete
* Contact emails - for Groups and also for programme team/DLV
* Approvals workflow
* Permissions to cover all the above