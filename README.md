# playground-yii2-post-tasks-manager

Basic implementation:
 - adds tasks of different types
 - tasks queueing
 - doesn't reload page
 - utilizes PJax
 - no actual emails sending (just to save time)
 - no queue processor (according to the requirements - just a matter of setting up a cron job, with email notification to specific address in case of erros)
 - no datapickers (as Yii/ui datapicker doesn't seems to support time part) and looking for external and installing them is just time consuming
 
Build:
 - use docker-compose in .build/ 
 
 Diagram:
 
 ![UML diagram](Diagram.svg)