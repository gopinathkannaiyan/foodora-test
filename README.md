# foodora-test

## 1 - Scenario

Imagine that you work in a delivering food company. When a restaurant is added to your backend system, one of the input informations you need to set is the regular opening hours for this restaurant in a week. For example, restaurant FooBar is opened from 19:00 to 22:00 from Tuesday to Friday, from 11:00 to 14:00 and 19:00 to 23:59:59 on Saturday and 24-hours opened on sundays. On Monday it is closed.

Also, imagine that a new feature was launched and this feature is called SpecialDays. This feature allows the restaurants to be opened or closed in special days such as Christmas. If a special day is created, the regular day has no effect for that day.

So imagine that the Restaurant FooBar has to be closed on Dec 24th, Dec 25th and opened from from 19:00 to 22:00 on Dec 26th and Dec 27th of this year.

### - Database model

![alt tag](https://www.dropbox.com/s/c8r0e41zjxwtnnu/db.png?raw=1)

Below a snapshot of the restaurant FooBar rows.

INSERT  INTO `vendor`(`id`,`name`) VALUES (1,'FooBar');

INSERT  INTO `vendor_schedule` VALUES (1,1,2,0,'19:00:00','22:00:00');

INSERT  INTO `vendor_schedule` VALUES (2,1,3,0,'19:00:00','22:00:00');

INSERT  INTO `vendor_schedule` VALUES (3,1,4,0,'19:00:00','22:00:00');

INSERT  INTO `vendor_schedule` VALUES (4,1,5,0,'19:00:00','22:00:00');

INSERT  INTO `vendor_schedule` VALUES (5,1,6,0,'11:00:00','14:00:00');

INSERT  INTO `vendor_schedule` VALUES (6,1,6,0,'19:00:00','22:00:00');

INSERT  INTO `vendor_schedule` VALUES (7,1,7,1,NULL,NULL);

INSERT  INTO `vendor_special_day` VALUES (1,1,'2015-12-24','closed',1,NULL,NULL);

INSERT  INTO `vendor_special_day` VALUES (2,1,'2015-12-25','closed',1,NULL,NULL);

INSERT  INTO `vendor_special_day` VALUES (3,1,'2015-12-26','opened',0,'19:00:00','23:59:59');

INSERT  INTO `vendor_special_day` VALUES (4,1,'2015-12-27','opened',1,NULL,NULL);

## Problem description

Imagine that a bug was reported to the team on Dec 17th and you have 5678 restaurants in the database and all of them added special days for the week from Dec 21th, 2015 to Dec 27th, 2015.

So your boss ordered to you to run a script on Dec 20th at 23:00 to fix the problem (update all regular days with special days) and another one Dec 28th 01:00 to restore everything again to the normal state.

## Some considerations

- Weekday: 1-Monday, 2-Tuesday, ..., 7-Sunday.
- The team did a rollback in the software. So the current version doesn't know anything about the SpecialDays feature.
- The solution in this case is to use temporarily the regular days as the SpecialDays in this week (Dec 21-27) and after that restore the database and feature.
- Assume that the team is correcting the feature during this week and on Monday 28th everything will be normal.
- Nobody will create/update special dates and schedules from Dec 21st and Dec 27th.
- Please, fork this project, create both scripts and send a pull request for me.
